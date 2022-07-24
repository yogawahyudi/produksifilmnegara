<?php

namespace App\Http\Controllers;

use App\Models\Pattern;
use App\Models\Pertanyaan;
use App\Models\Respon;
use App\Models\Studio;
use Biobii\NaiveBayes;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class BOTTelegramController extends Controller
{
    public function setWebhook()
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $response = Telegram::setWebhook(["url" => env('TELEGRAM_WEBHOOK_URL') . '/' . $token . '/webhook']);
        dd($response);
    }

    public function commandHandlerWebhook($token)
    {
        $updates = Telegram::getWebhookUpdates();
        // $updates = Telegram::commandsHandler(true);
        $chat_id = $updates->getChat()->getId();
        $username = $updates->getChat()->getFirstName();

        $text = $updates->getMessage()->getText();
        $responbot = "";
        $chatbot = new ChatbotController;
        $response = strVal($chatbot->hear($text));

        if (strtolower($text === 'halo')) {
            return Telegram::sendMessage([
                'chat_id' => $chat_id,
                'text' => 'Halo ' . $username
            ]);
        }

        if (strtolower($text != 'halo')) {
            return Telegram::sendMessage([
                'chat_id' => $chat_id,
                'text' => 'Halo ' . $response,
            ]);
        }
        return $response;
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

        if ($resultnb != "umum") {
            $input = "";
            $studio = Studio::all();
            for ($i = 0; $i < count($studio); $i++) {
                if (str_contains($input, $studio[$i]['studio'])) {
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
            $input = $textProcessing->stemming($input);
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
}
