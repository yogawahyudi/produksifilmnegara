<?php

namespace App\Http\Controllers;

use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class PertanyaanController extends Controller
{
    public function index()
    {
        $pertanyaan = Pertanyaan::all();
        return view('assets.pages.pertanyaan.index_pertanyaan', compact('pertanyaan', 'pertanyaan'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "pertanyaan" => 'required',
            "label" => 'required'
        ]);

        Pertanyaan::create([
            "pertanyaan" => $request['pertanyaan'],
            "label" => $request['label']
        ]);

        return redirect()->back()->with('succes', "Berhasil Menambahkan Pertanyaan");
    }

    public function create()
    {
        return view('assets.pages.pertanyaan.create_pertanyaan');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "pertanyaan" => 'required',
            "label" => 'required'
        ]);

        Pertanyaan::where('id', $id)->update([
            "pertanyaan" => $request['pertanyaan'],
            "label" => $request['label']
        ]);

        return redirect()->back()->with('success', "Berhasil Update Pertanyaan");
    }

    public function delete($id)
    {
        Pertanyaan::find($id)->delete();
        return redirect()->back()->with('success', "Berhasil Hapus Pertanyaan");
    }
}
