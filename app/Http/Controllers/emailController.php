<?php

namespace App\Http\Controllers;

use App\Mail\invoiceMail;
use App\Mail\notifyNewPembayaran;
use App\Mail\sendPembayaran;
use App\Models\Assets;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class emailController extends Controller
{
    public function sendInvoice($transaksi, $transaksi_items, $tagihan, $b_shooting, $b_setting)
    {

        // $transaksi = Tagihan::where('id', $id)->with('transaksi_items')->get();

        $mailData = [
            'name' => $transaksi->nama,
            'tanggal' => $transaksi->created_at,
            'idTransaksi' => $transaksi->id,
            'tagihan' => $tagihan,
            'transaksi_items' => $transaksi_items,
            'b_shooting' => $b_shooting,
            'b_setting' => $b_setting

        ];

        Mail::to($transaksi->email)->send(new invoiceMail($mailData));

        // dd("Email is sent successfully.");
        // return view('mail.invoice');
    }

    public function sendPembayaran($pembayaran, $transaksi_items, $tagihan, $b_shooting, $b_setting)
    {
        $assets = Assets::where('email_verified_at', '!=', null)->get();
        for ($i = 0; $i < count($assets); $i++) {
            $mailData = [
                'assets' => $assets[$i]['name'],
                'name' => $tagihan->transaksi['nama'],
                'tanggal' => $tagihan->transaksi['created_at'],
                'idTransaksi' => $tagihan->transaksi->id,
                'tagihan' => $tagihan,
                'transaksi_items' => $transaksi_items,
                'b_shooting' => $b_shooting,
                'b_setting' => $b_setting,
                'pembayaran' => $pembayaran
            ];
        }
        Mail::to($tagihan->transaksi->email)->send(new sendPembayaran($mailData));
        // for ($i = 0; $i < count($assets); $i++) {
        //     Mail::to($assets[$i]['email'])->send(new notifyNewPembayaran($mailData));
        // }
    }

    //     public function notifyNewPembayaran($pembayaran, $transaksi_items, $tagihan, $b_shooting, $b_setting)
    //     {
    //         $assets = Assets::all()
    //     }
}
