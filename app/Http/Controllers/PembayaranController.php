<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    // assets

    public function indexAssets()
    {
        return view('assets.pages.pembayaran.index_pembayaran');
    }
}
