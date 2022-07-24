<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeManagement;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use Biobii\NaiveBayes;

class ClassificationController extends Controller
{
    public function classification(Request $request)
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
        $result =  $nb->predict($request['input']);
        return $result;
    }
}
