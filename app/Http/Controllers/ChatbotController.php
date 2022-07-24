<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeManagement;
use App\Models\Pattern;
use App\Models\Pertanyaan;
use App\Models\Respon;
use App\Models\Studio;
use Biobii\NaiveBayes;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function Index()
    {
        return view('users.pages.chatbot.chatbot');
    }

    public function Index_assets()
    {
        return view('assets.pages.bot.index_bot');
    }

    public function stemming()
    {
    }

    public function listening(Request $request)
    {
        $knowledge = Pertanyaan::all();

        foreach ($knowledge as $kn) {
            $data[] = [
                'text' => $kn['pertanyaan'],
                'class' => $kn['label']
            ];

            $label[] = $kn['label'];
        }
        $nb = new NaiveBayes();

        // mendefinisikan class target sesuai dengan yang ada pada data training.
        $nb->setClass(array_unique($label));

        // proses training
        $nb->training($data);

        // pengujian
        $resultnb =  $nb->predict($request['input']);

        if ($resultnb != "umum") {
            $input = "";
            $studio = Studio::all();
            for ($i = 0; $i < count($studio); $i++) {
                if (str_contains($request['input'], $studio[$i]['studio'])) {
                    $input = str_replace("studio", $studio[$i]['studio'], $resultnb);
                    $i = count($studio);
                }
            }

            $boyer = new BoyerMooreController;
            $pattern = Pattern::where('label', $resultnb)->get();
            for ($i = 0; $i < count($pattern); $i++) {
                $result = $boyer->BoyerMoore($input, $pattern[$i]['pattern']);
                if ($result >= 0) {
                    $respon = Respon::find($pattern[$i]['respon_id']);

                    $responbot = [
                        "respon" => $respon['respon'],
                        "index" => $result,
                        "pattern" => $pattern[$i]['pattern'],
                    ];
                    return $responbot;
                }
            }
        } else {

            $textProcessing = new TextProcessingController;
            $input = $textProcessing->stemming($request['input']);
            $pattern = Pattern::where('label', $resultnb)->get();

            $boyer = new BoyerMooreController;
            for ($i = 0; $i < count($pattern); $i++) {
                $result = $boyer->BoyerMoore($input, $pattern[$i]['pattern']);
                if ($result >= 0) {
                    $respon = Respon::find($pattern[$i]['respon_id']);
                    $responbot = [
                        "respon" => $respon['respon'],
                        "index" => $result,
                        "pattern" => $pattern[$i]['pattern'],
                    ];
                    return $responbot;
                }
            }
            return "Maaf untuk info lebih lanjutnya bisa menghubungi nomor whatsapp wa.me/+6285155123214";
        }
    }

    public function hear($input)
    {
        $knowledge = Pertanyaan::all();

        foreach ($knowledge as $kn) {
            $data[] = [
                'text' => $kn['pertanyaan'],
                'class' => $kn['label']
            ];

            $label[] = $kn['label'];
        }
        $nb = new NaiveBayes();

        // mendefinisikan class target sesuai dengan yang ada pada data training.
        $nb->setClass(array_unique($label));

        // proses training
        $nb->training($data);

        // pengujian
        $resultnb =  $nb->predict($input);


        $textProcessing = new TextProcessingController;
        $input = $textProcessing->stemming($input);
        $pattern = Pattern::where('label', $resultnb)->get();

        $boyer = new BoyerMooreController;
        for ($i = 0; $i < count($pattern); $i++) {
            $result = $boyer->BoyerMoore($input, $pattern[$i]['pattern']);
            if ($result >= 0) {
                $respon = Respon::find($pattern[$i]['respon_id']);
                $responbot = strVal($respon['respon']);
                return $responbot;
            }
        }
        $responbot = "Maaf untuk info lebih lanjutnya bisa menghubungi nomor whatsapp wa.me/+6285155123214";
        return $responbot;
    }
}
