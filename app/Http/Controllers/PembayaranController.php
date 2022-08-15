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
            $tagihan = Tagihan::with(['transaksi', 'transaksi.transaksi_items'])->find($id);
            $transaksi_items = $tagihan->transaksi->transaksi_items->sortBy('created_at');
            $pembayaran = Pembayaran::create([
                'tagihan_id' => $tagihan->id,
                'users_id' => Auth::user()->id,
                'nominal' => $tagihan->nominal,
                'bukti_img' => $filename,
                'verified' => 0
            ]);
            for ($i = 0; $i < count($transaksi_items); $i++) {
                $dur_overcharge_shooting = $transaksi_items[$i]['durasi_shooting'] % 12;
                $durshot = ($transaksi_items[$i]['durasi_shooting'] - $dur_overcharge_shooting) / 12;
                $dur_overcharge_setting = $transaksi_items[$i]['durasi_setting'] % 12;
                $durset = ($transaksi_items[$i]['durasi_setting'] - $dur_overcharge_setting) / 12;

                $b_shooting[] = ($durshot * $transaksi_items[$i]['harga_shooting']) + ($dur_overcharge_shooting * $transaksi_items[$i]['harga_shooting']);
                $b_settting[] = ($durset * $transaksi_items[$i]['harga_setting']) + ($dur_overcharge_setting * $transaksi_items[$i]['harga_setting']);
            }
        }

        $sendMail = new emailController;
        $sendMail->sendPembayaran($pembayaran, $transaksi_items, $tagihan, $b_shooting, $b_settting);

        return redirect()->back()->with("success", "Pembayaran Berhasil Harap Menunggu Konfirmasi Dari Admin");
    }

    public function assetsVerif($id)
    {
        $pembayaran = Pembayaran::find($id);
        $tagihan = Tagihan::find($pembayaran->tagihan_id);
        $transaksi_items = Transaksi_items::where('transaksi_id', $tagihan->transaksi_id)->first();
        $transaksi = Transaksi::where('id', $tagihan->transaksi_id)->first();

        $harga_shooting = $transaksi_items->harga_shooting;
        $harga_setting = $transaksi_items->harga_setting;
        $h_overcharge_setting = $transaksi_items->overcharge_setting;
        $h_overcharge_shooting = $transaksi_items->overcharge_shooting;

        $dur_overcharge_shooting = $transaksi_items->durasi_shooting % 12;
        $durshot = ($transaksi_items->durasi_shooting - $dur_overcharge_shooting) / 12;
        $dur_overcharge_setting = $transaksi_items->durasi_setting % 12;
        $durset = ($transaksi_items->durasi_setting - $dur_overcharge_setting) / 12;

        $b_shooting = ($durshot * $harga_shooting) + ($dur_overcharge_shooting * $harga_shooting);
        $b_settting = ($durset * $harga_setting) + ($dur_overcharge_setting * $harga_setting);
        $t_harga = $b_shooting + $b_settting;
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
            $sendMail = new emailController;
            $sendMail->sendInvoice($transaksi, $transaksi_items, $tagihann, $b_shooting, $b_settting);
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
