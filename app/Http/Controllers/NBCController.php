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

    public $allClassData;
    public $allWordsCount;
    public $testClass;
    public $result;
    public $match;


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

            $this->allWordsCount[] = count(array_filter($this->wordsClass[$index]['words'], function ($item) {
                return ($item['count'] !== 0);
            }));

            foreach ($this->wordsClass[$index]['words'] as $word) {
                $this->wordsClass[$index]['computed'][] = [
                    'word' => $word['word'],
                    'value' => ($word['count'] + 1) / ($wordsCount + count($this->words))
                ];
            }
        }
        $countClassData = count($classData);
        $countData = count($data);
        $this->allClassData = $allClassData;
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
            $arrindex[] = $this->findWordsClassIndex($class);
            // dd($index);
            foreach ($wordsArray as $word) {
                // kalo ga da maka hasilnya undenfined
                $match = array_filter($this->wordsClass[$index]['computed'], function ($item) use ($word) {
                    return ($item['word'] === $word);
                });
                $arrmatch[] = array_filter($this->wordsClass[$index]['computed'], function ($item) use ($word) {
                    return ($item['word'] === $word);
                });
                $this->match = $arrmatch;
                if ($match) {
                    $testClass[$class]['computed'][] = reset($match)['value'];
                }
            }
            $arrmatch = [];
            $testClass[$class]['result'] = 1; // init the result for the class
        }
        // dd($arrmatch);
        foreach ($testClass as $key => $value) {
            foreach ($value['computed'] as $val) {
                $testClass[$key]['result'] *= $val;
            }
        }

        $result = [];
        foreach ($this->class as $class) {
            $result[] = $testClass[$class]['result'];
        }
        $this->testClass = $testClass;
        $this->result = $result;
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
        $res = json_encode($nb->displaysetWordsClass());
        return $res;
    }

    public function view(Request $request)
    {
        if ($request['input'] == null) {
            $text = "berapa harga studio 1";
        } else {
            $text = $request['input'];
        }
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
        $res = $nb->displaysetWordsClass();
        $allClassData = $nb->getAllClasData();
        $data = $nb->getData();
        $wordsCount[] = $nb->getAllWordsCount();
        $words = $nb->getWords();

        $resultClass = $nb->predict($text);
        $testClass = $nb->getTestClass();
        $result = $nb->getResult();
        $match = $nb->getMatch();
        return view('assets.pages.nbc.testing', compact(['res', 'allClassData', 'data', 'wordsCount', 'words', 'testClass', 'result', 'match']));
    }

    public function displaysetClass()
    {
        return $this->class;
    }

    protected function displaysetWordsClass()
    {
        return $this->wordsClass;
    }
    protected function getAllClasData()
    {
        return $this->allClassData;
    }
    protected function getData()
    {
        return $this->data;
    }
    protected function getAllWordsCount()
    {
        return $this->allWordsCount;
    }
    protected function getWords()
    {
        return $this->words;
    }
    protected function getTestClass()
    {
        return $this->testClass;
    }
    protected function getResult()
    {
        return $this->result;
    }
    protected function getMatch()
    {
        return $this->match;
    }
}
