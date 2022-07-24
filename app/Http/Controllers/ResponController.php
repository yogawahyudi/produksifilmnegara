<?php

namespace App\Http\Controllers;

use App\Models\Respon;
use Illuminate\Http\Request;

class ResponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $respon = Respon::all();
        return view('assets.pages.knowledge.managementRespon', compact('respon', 'respon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Respon = Respon::firstOrCreate(
            ['respon' =>  $request['respon']],
        );
        return redirect()->back()->with('succes', 'Berhasim Menambahkan Respon');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Respon = Respon::find($id)->update(
            ['respon' =>  $request['respon']],
        );
        return redirect()->back()->with('succes', 'Berhasil Update Respon');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Respon = Respon::find($id)->delete();
        return redirect()->back()->with('succes', 'Berhasil Menghapus Respon');
    }
}
