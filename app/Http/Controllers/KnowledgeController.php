<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeManagement;
use App\Models\Pattern;
use App\Models\Respon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KnowledgeController extends Controller

{

    public function indexKnowledge()
    {

        $knowledge = DB::table('pattern')->select('pattern.*', 'respon.respon')
            ->join('respon', 'pattern.respon_id', '=', 'respon.id')
            ->get();
        return view('assets.pages.knowledge.index', compact('knowledge', 'knowledge'));
    }

    public function store(Request $request)
    {
        $processing = new TextProcessingController;

        $this->validate($request, [
            'pattern' => "required",
            "respon" => "required",
            "label" => "required"
        ]);

        $Respon = Respon::firstOrCreate(
            ['respon' =>  $request['respon']],
        );

        Pattern::create([
            "respon_id" => $Respon['id'],
            'pattern' => $processing->Stemming($request['pattern']),
            "label" => $request['label']
        ]);

        return redirect()->back()->with('success', 'Berhasil Menambahkan Knowledge');
    }

    public function update(Request $request, $id)
    {
        $processing = new TextProcessingController;

        $this->validate($request, [
            'pattern' => "required",
            "respon" => "required",
            "label" => "required"
        ]);

        $Respon = Respon::firstOrCreate(
            ['respon' =>  $request['respon']],
        );

        Pattern::find($id)->update([
            "respon_id" => $Respon['id'],
            'pattern' => $processing->Stemming($request['pattern']),
            "label" => $request['label']
        ]);

        return redirect()->back()->with('success', 'Berhasil Update Knowledge');
    }

    public function delete($id)
    {
        Pattern::find($id)->delete();
        return redirect()->back()->with('success', 'Berhasil Delete Knowledge');
    }
}
