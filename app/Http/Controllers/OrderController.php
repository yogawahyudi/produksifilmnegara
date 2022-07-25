<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Studio;
use App\Models\Tagihan;
use App\Models\Transaksi;
use App\Models\Transaksi_items;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function indexOrder($id)
    {
        $studio = Studio::find($id);
        $disabledDay = DB::table('transaksi_items')
            ->select('transaksi_items.tanggal')
            ->join('transaksi', 'transaksi_items.transaksi_id', '=', 'transaksi.id')
            ->where('transaksi.status_tran', '=', 'berlangsung')
            ->where('transaksi_items.studio', '=', $studio->studio)
            ->get();

        if ($disabledDay->isNotEmpty()) {
            foreach ($disabledDay as $dis) [
                $disDate[] = $dis->tanggal
            ];
        } else {
            $disDate = 0;
        }
        $now = Carbon::now()->isoFormat('YYYY-MM-DD');
        return view('users.pages.transaksi.form_pemesanan', compact(['studio', 'studio', 'now', 'now', 'disDate', 'disDate']));
    }
}
