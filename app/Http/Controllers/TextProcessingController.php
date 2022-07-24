<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TextProcessingController extends Controller
{
    public function stemming($text)
    {
        $stopWordRemoverFactory = new \Sastrawi\StopWordRemover\StopWordRemoverFactory();
        $stopWordRemover  = $stopWordRemoverFactory->createStopWordRemover();
        // create stemmer
        $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
        $stemmer  = $stemmerFactory->createStemmer();
        $input = $stopWordRemover->remove($text);
        $input = $stemmer->stem($input);
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
}
