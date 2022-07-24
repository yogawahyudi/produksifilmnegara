<?php

namespace App\Http\Controllers;

use App\Models\Pattern;
use Illuminate\Http\Request;

class BoyerMooreController extends Controller
{
    public function BoyerMoore($text, $pattern)
    {
        $patlen = strlen($pattern);
        $textlen = strlen($text);
        $makeCharTable = new BoyerMooreController;
        $table = $makeCharTable->makeCharTable($pattern);

        for ($i = $patlen - 1; $i < $textlen;) {
            $t = $i;
            for ($j = $patlen - 1; $pattern[$j] == $text[$i]; $j--, $i--) {
                if ($j == 0) return $i;
            }
            $i = $t;
            if (array_key_exists($text[$i], $table))
                $i = $i + max($table[$text[$i]], 1);
            else
                $i += $patlen;
        }
        return -1;
    }

    public function makeCharTable($string)
    {
        $len = strlen($string);
        $table = array();
        for ($i = 0; $i < $len; $i++) {
            $table[$string[$i]] = $len - $i - 1;
        }
        return $table;
    }

    public function hasilBooyerMore(Request $request)
    {
        $bm = new BoyerMooreController;
        $stemming = new TextProcessingController;
        $hasilStemming = $stemming->stemming($request->input);

        $pattern = Pattern::all();

        for ($i = 0; $i < count($pattern); $i++) {
            $hasilbm = $bm->BoyerMoore($hasilStemming, $pattern[$i]['pattern']);
            if ($hasilbm >= 0) {
                $hasil = [
                    'pattern' => $pattern[$i]['pattern'],
                    'index' => $hasilbm,
                ];
                return $hasil;
            }
        }
    }
}
