<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use App\Models\StudioImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StudioController extends Controller
{


    public function detailStudioUser($id)
    {
        $studio = Studio::find($id);
        return view('users.pages.studio.detail_studio', compact(['studio', 'studio']));
    }

    public function imageStudio($id)
    {
        $studio = Studio::find($id);
        $imagesStudio = StudioImages::where('studio_id', $id)->get();
        return view('assets.pages.studio.images_studio', compact(['studio', 'studio', 'imagesStudio', 'imagesStudio']));
    }

    public function storeImagesStudio(Request $request, $id)
    {
        $this->validate($request, [
            'images' => 'required',
            'images.*' => 'mimes:jpg,png,jpeg',
            'images.*' => 'max:10000'
        ]);

        $studio = Studio::find($id);
        $namaStudio = str_replace(' ', '-', $studio->studio);
        $jmlhFoto = StudioImages::where('studio_id', $id)->count();

        if ($jmlhFoto < 5) {
            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $key => $file) {
                    $filename = $file->getClientOriginalName();
                    $file->move(public_path('assets/images/studio'), $filename);
                    StudioImages::create([
                        'studio_id' => $id,
                        'img' => $filename
                    ]);
                }
            }
            // dd($insert);
            return redirect()->back()->with('success', "Berhasil Menambahkan Foto Studio");
        } else {
            return redirect()->back()->with('error', "Hanya 5 foto yang diperbolehkan");
        }
    }

    public function updateImagesStudio(Request $request, $img_id)
    {
        $this->validate($request, [
            'images' => 'required',
            'images.*' => 'mimes:jpg,png,jpeg',
            'images.*' => 'max:5000'
        ]);

        if ($request->hasfile('images')) {
            $file = $request->file('images');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/studio'), $filename);
            $images = StudioImages::find($img_id);
            File::delete(public_path("assets/images/studio/" . $images->img));
            $images->update([
                'img' => $filename
            ]);
        }
        return redirect()->back()->with("success", "Berhasil Update Image");
    }

    public function deleteImagesStudio($img_id)
    {

        $images = StudioImages::find($img_id);
        File::delete(public_path("assets/images/studio/" . $images->img));
        $images->delete();
        return redirect()->back()->with("success", "Berhasil Hapus Image");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studio = Studio::with('studioImage')->get();
        foreach ($studio as $st) {
            $imgs[] = $st->studioImage->first();
        }
        return view('assets.pages.studio.index_studio', compact('studio', 'studio', 'imgs', 'imgs'));
    }

    public function index_user()
    {
        $studio = Studio::all();

        return view('users.pages.studio.index_studio', compact('studio', 'studio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assets.pages.studio.create_studio');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'studio' => "required",
            'harga_setting' => "required",
            'harga_shooting' => "required",
            'overcharge_setting' => "required",
            'overcharge_shooting' => "required",
            'luas' => "required",
            'tinggi' => "required",
            'fasilitas' => "required",
        ]);

        Studio::create([
            'studio' => $request['studio'],
            'harga_setting' => $request['harga_setting'],
            'harga_shooting' => $request['harga_shooting'],
            'overcharge_setting' => $request['overcharge_setting'],
            'overcharge_shooting' => $request['overcharge_shooting'],
            'luas' => $request['luas'],
            'tinggi' => $request['tinggi'],
            'fasilitas' => $request['fasilitas'],
        ]);

        return redirect()->back();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
