<?php

namespace App\Http\Controllers;

use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class NBCController extends Controller
{
    /**
     * Data class or target.
     *
     * @var array
     */
    public $class;

    /**
     * Data training.
     * 
     * @var array
     */
    public $data;

    /**
     * Stemmed data training.
     * 
     * @var array
     */
    public $stemmedData;

    /**
     * All words.
     *
     * @var array
     */
    public $words;

    /**
     * Group of words each class or target.
     *
     * @var array
     */
    public $wordsClass;

    public $dwordclass;

    /**
     * Set available class or target.
     * 
     * @param array $class
     * @return void
     */
    public function setClass(array $class)
    {
        $this->class = $class;
        $this->setWordsClass($class);
    }


    /**
     * Set words and computing data for each class.
     *
     * @param string $class
     * @return void
     */
    protected function setWordsClass($class)
    {
        $this->wordsClass = [];
        foreach ($class as $item) {
            $this->wordsClass[] = [
                'class' => $item,
                'words' => [],
                'pData' => 0,
                'computed' => []
            ];
        }
    }

    /**
     * Filter data by class or target.
     *
     * @param string $class
     * @return array
     */
    public function getDataByClass(string $class)
    {
        return array_filter($this->data, function ($item) use ($class) {
            return ($item['class'] === $class);
        });
    }

    /**
     * Set stemmed data.
     *
     * @param array $data
     * @return void
     */
    public function setStemmedData(array $data)
    {
        $this->stemmedData = $data;
    }

    /**
     * Set stemmed words.
     *
     * @param array $words
     * @return void
     */
    public function setWords(array $words)
    {
        $this->words = $words;
    }

    /**
     * Find wordsClass index by class.
     *
     * @param string $class
     * @return int
     */
    public function findWordsClassIndex(string $class)
    {
        foreach ($this->wordsClass as $index => $item) {
            foreach ($item as $key => $value) {
                if ($item['class'] === $class) {
                    return $index;
                }
            }
        }

        return -1;
    }

    /**
     * Training data.
     *
     * @param array $data
     * @return void
     */
    public function training(array $data)
    {
        $this->data = $data;
        $stemmer = new TextProcessingController();
        foreach ($this->data as $index => $item) {
            $stemmed = $stemmer->stemming($item['text']);
            $this->data[$index]['text'] = $stemmed;
        }

        $this->setWords($stemmer->getWords());
        foreach ($this->class as $item) {
            $classData = $this->getDataByClass($item);
            $allClassData[] = $this->getDataByClass($item);
            $index = $this->findWordsClassIndex($item);
            foreach ($this->words as $word) {
                $this->wordsClass[$index]['words'][] = ['word' => $word, 'count' => 0];
            }
            $rawWordClass = $this->wordsClass;

            foreach ($classData as $item) {
                $splits = explode(' ', $item['text']); //tokenizinng
                foreach ($this->wordsClass[$index]['words'] as $key => $word) {
                    foreach ($splits as $split) {
                        if ($word['word'] === $split) {
                            $this->wordsClass[$index]['words'][$key]['count']++;
                        }
                    }
                }
            }

            $this->wordsClass[$index]['pData'] = count($classData) / count($data);
            $wordsCount = count(array_filter($this->wordsClass[$index]['words'], function ($item) {
                return ($item['count'] !== 0);
            }));

            foreach ($this->wordsClass[$index]['words'] as $word) {
                $this->wordsClass[$index]['computed'][] = [
                    'word' => $word['word'],
                    'value' => ($word['count'] + 1) / ($wordsCount + count($this->words))
                ];
            }
        }
        $bagWord = $this->words;
        $countClassData = count($classData);
        $countData = count($data);
    }

    /**
     * Predict data.
     *
     * @param string|array $data
     * @return string
     */
    public function predict($data)
    {
        $stemmer = new TextProcessingController();
        $stemmed = $stemmer->stemming($data);
        $wordsArray = explode(' ', $stemmed);

        // calculate each class
        $testClass = [];
        foreach ($this->class as $class) {
            $index = $this->findWordsClassIndex($class);
            foreach ($wordsArray as $word) {
                $match = array_filter($this->wordsClass[$index]['computed'], function ($item) use ($word) {
                    return ($item['word'] === $word);
                });

                if ($match) {
                    $testClass[$class]['computed'][] = reset($match)['value'];
                }
            }

            $testClass[$class]['result'] = 1; // init the result for the class
        }

        foreach ($testClass as $key => $value) {
            foreach ($value['computed'] as $val) {
                $testClass[$key]['result'] *= $val;
            }
        }

        $result = [];
        foreach ($this->class as $class) {
            $result[] = $testClass[$class]['result'];
        }

        $max = max($result);
        foreach ($testClass as $key => $item) {
            if ($item['result'] === $max) return $key;
        }

        return false;
    }

    public function testing()
    {
        $knowledge = Pertanyaan::all();

        foreach ($knowledge as $kn) {
            $data[] = [
                'text' => $kn['pertanyaan'],
                'class' => $kn['label']
            ];

            $label[] = $kn['label'];
        }
        $nb = new NBCController();

        // mendefinisikan class target sesuai dengan yang ada pada data training.
        $nb->setClass(array_unique($label));
        // proses training
        $nb->training($data);
        dd($nb->displaysetWordsClass());
    }

    public function displaysetClass()
    {
        return $this->class;
    }

    protected function displaysetWordsClass()
    {
        return $this->wordsClass;
    }
}
