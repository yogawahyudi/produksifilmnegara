<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TextProcessingController extends Controller
{
    /**
     * Stemmed words.
     *
     * @var array
     */
    protected $words;

    public function stemming($text)
    {
        $stopWordRemoverFactory = new \Sastrawi\StopWordRemover\StopWordRemoverFactory();
        $stopWordRemover  = $stopWordRemoverFactory->createStopWordRemover();
        // create stemmer
        $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
        $stemmer  = $stemmerFactory->createStemmer();
        // $input = $stopWordRemover->remove($text);
        $input = $stemmer->stem($text);
        $words = explode(' ', $input);
        foreach ($words as $word) {
            $this->words[] = $word;
        }
        return $input;
    }

    public function stemmingg(Request $request)
    {
        $stopWordRemoverFactory = new \Sastrawi\StopWordRemover\StopWordRemoverFactory();
        $stopWordRemover  = $stopWordRemoverFactory->createStopWordRemover();
        // create stemmer
        $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
        $stemmer  = $stemmerFactory->createStemmer();
        $input = $stopWordRemover->remove($request->input);
        $input = $stemmer->stem($input);
        return $input;
    }

    public function stem(string $text)
    {
        $stemmed = $this->stemmer->stem($text);
        $words = explode(' ', $stemmed);
        foreach ($words as $word) {
            $this->words[] = $word;
        }

        return $stemmed;
    }

    /**
     * Get all words.
     *
     * @param void
     * @return array
     */
    public function getWords()
    {
        $unique = array_unique($this->words);
        $this->words = array_values($unique);
        return $this->words;
    }
}
