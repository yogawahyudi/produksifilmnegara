<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use App\Models\Tagihan;
use App\Models\Transaksi;
use App\Models\Transaksi_items;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function create()
    {
        $users = User::all();
        return view('assets.pages.transaksi.create_transaksi', compact('users', 'users'));
    }

    public function index()
    {
        return view('assets.pages.transaksi.index_transaksi');
    }

    public function indexUser($id)
    {
        $user = User::find($id);
        session([
            'userId' => $user->id
        ]);
        return redirect()->route('pilihStudio.transaksi');
    }

    public function indexTransaksiUser()
    {
        $transaksi = Transaksi::where('users_id', Auth::user()->id)->with(['transaksi_items', 'tagihan'])->get();
        $tagihan = Tagihan::where('users_id', Auth::user()->id)->get();
        return view('users.pages.transaksi.transaksi', compact(['transaksi', 'transaksi', 'tagihan', 'tagihan']));
    }


    public function pilihStudio()
    {
        $studio = Studio::all();
        $users = session('userId');
        return view('assets.pages.transaksi.pilih_studio', compact(['users', 'users', 'studio', 'studio']));
    }

    public function formPemesanan($id_user, $id_studio)
    {
        $user = User::find($id_user);
        $studio = Studio::find($id_studio);
        $now = Carbon::now()->isoFormat('YYYY/MM/DD');
        return view('assets.pages.transaksi.form_pemesanan', compact(['user', 'user', 'studio', 'studio', 'now', 'now']));
    }

    public function view($id)
    {
        // $transaksi = Transaksi::find($id);
        return view('assets.pages.transaksi.view_transaksi');
    }

    public function indexMangerTransaksi()
    {
        return view('manager.pages.transaksi.index_transaksi');
    }

    public function viewTransaksiManager($id)
    {
        // $transaksi = Transaksi::find($id);
        return view('manager.pages.transaksi.view_transaksi');
    }

    public function storeTransaksiUser(Request $request, $id)
    {
        $this->validate($request, [
            'nama_perusahaan' => 'required',
            'email_perusahaan' => 'required',
            'no_perusahaan' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'tanggal' => 'required',
            'durasi_shooting' => 'required',
        ]);

        $studio = Studio::find($id);
        $harga_shooting = $studio->harga_shooting;
        $harga_setting = $studio->harga_setting;
        $h_overcharge_setting = $studio->overcharge_setting;
        $h_overcharge_shooting = $studio->overcharge_shooting;

        $dur_overcharge_shooting = $request->durasi_shooting % 12;
        $durshot = ($request->durasi_shooting - $dur_overcharge_shooting) / 12;
        $dur_overcharge_setting = $request->durasi_setting % 12;
        $durset = ($request->durasi_setting - $dur_overcharge_setting) / 12;

        $b_shooting = ($durshot * $harga_shooting) + ($dur_overcharge_shooting * $harga_shooting);
        $b_settting = ($durset * $harga_setting) + ($dur_overcharge_setting * $harga_setting);
        $t_harga = $b_shooting + $b_settting;

        $transaksi = Transaksi::create([
            'users_id' => Auth::user()->id,
            'status_tran' => 'berlangsung',
            'tanggal' => Carbon::now()->isoFormat('YYYY-MM-DD'),
            'nama' => Auth::user()->name,
            'email' => Auth::user()->email,
            'no_hp' => Auth::user()->no_hp,
            'nama_per' => $request->nama_perusahaan,
            'email_per' => $request->email_perusahaan,
            'no_hp_per' => $request->no_perusahaan
        ]);

        $transaksi_items = Transaksi_items::create([
            'transaksi_id' => $transaksi->id,
            'studio' => $studio->studio,
            'harga_setting' => $harga_setting,
            'harga_shooting' => $harga_shooting,
            'overcharge_setting' => $h_overcharge_setting,
            'overcharge_shooting' => $h_overcharge_shooting,
            'durasi_shooting' => $request->durasi_shooting,
            'durasi_setting' => $request->durasi_setting,
            't_harga' => $t_harga,
            'tanggal' => $request->tanggal
        ]);

        $tagihan = Tagihan::create([
            'transaksi_id' => $transaksi->id,
            'users_id' => Auth::user()->id,
            'jenis' => "DP",
            'lunas' => 0,
            'nominal' => $t_harga * (20 / 100),
        ]);

        return redirect()->route('index.transaksi.user');
    }
}
