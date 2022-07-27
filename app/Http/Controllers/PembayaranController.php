<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Models\Transaksi;
use App\Models\Transaksi_items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    // assets

    public function indexAssets()
    {
        $pembayaran = Pembayaran::with(['tagihan.transaksi.transaksi_items'])->get();
        return view('assets.pages.pembayaran.index_pembayaran', compact('pembayaran', 'pembayaran'));
    }

    public function userStore(Request $request, $id)
    {
        $this->validate($request, [
            'images' => 'required',
            'images.*' => 'mimes:jpg,png,jpeg',
            'images.*' => 'max:5000'
        ]);

        if ($request->hasfile('images')) {
            $file = $request->file('images');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('assets/images/bukti-transfer/'), $filename);
            $tagihan = Tagihan::find($id);
            Pembayaran::create([
                'tagihan_id' => $tagihan->id,
                'users_id' => Auth::user()->id,
                'nominal' => $tagihan->nominal,
                'bukti_img' => $filename,
                'verified' => 0
            ]);
        }
        return redirect()->back()->with("success", "Pembayaran Berhasil Harap Menunggu Konfirmasi Dari Admin");
    }

    public function assetsVerif($id)
    {
        $pembayaran = Pembayaran::find($id);
        $tagihan = Tagihan::find($pembayaran->tagihan_id);
        $transaksi_items = Transaksi_items::where('transaksi_id', $tagihan->transaksi_id)->first();
        $pembayaran->update([
            'verified' => 1
        ]);

        $tagihan->update([
            'lunas' => 1,
        ]);
        if ($tagihan->jenis == "DP") {
            $tagihann = Tagihan::create([
                'transaksi_id' => $tagihan->transaksi_id,
                'users_id' => $tagihan->users_id,
                'jenis' => "pelunasan",
                'lunas' => 0,
                'nominal' => $transaksi_items->t_harga - $tagihan->nominal,
            ]);
        }

        if ($tagihan->jenis == "extends" or $tagihan->jenis == "pelunasan") {
            $transaksi = Transaksi::find($tagihan->transaksi_id);
            $transaksi->update([
                'status_tran' => "seselsai"
            ]);
        }

        return redirect()->back();
    }
}
