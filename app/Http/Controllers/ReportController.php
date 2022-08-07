<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    public function index()
    {
        return view('manager.pages.report.index_report');
    }

    public function userCount()
    {
        $userCount = User::all()->count();
        return $userCount;
    }

    public function transaksiCount()
    {
        $userCount = User::all()->count();
        return $userCount;
    }

    public function report($id)
    {
        $data = array();
        $dateq = array();
        $now = Carbon::now();

        if ($id === 'w') {
            $starDate = Carbon::now()->subWeeks(1);
            for ($i = $now; $i > $starDate; $i->subDays(1)) {
                array_push($dateq, $i->format('Y/m/d'));
                array_push($data, $i->format('d/m/y'));
            }

            for ($i = count($data) - 1; $i >= 0; $i--) {
                $datas[] = [
                    'date' => $data[$i],
                    'transaksi' => DB::table('transaksi')->where('tanggal', '=', $dateq[$i])->count(),
                ];
            }
            $result = [
                'title' => 'Transaksi dalam 1 minggu terakhir',
                'subtitle' => 'Periode ' . Carbon::now()->subWeeks(1)->isoFormat('DD-MMMM-YYYY') . ' - ' . Carbon::now()->isoFormat('DD-MMMM-YYYY'),
                'data' => $datas,
                'totalTransaksi' => DB::table('transaksi')->where('tanggal', '>', $starDate)->count(),
                'transaksiDibatalkan' => DB::table('transaksi')->where('tanggal', '>', $starDate)->where('status_tran', 'dibatalkan')->count(),
                'totalPendapatan' => DB::table('tagihan')->where('created_at', '>', $starDate)->where('lunas', '=', 1)->sum('nominal'),
                'totalUser' => DB::table('users')->count(),
                'totalUserBaru' => DB::table('users')->where('created_at', '>', $starDate)->count(),

            ];
            return json_encode($result);
        } elseif ($id === 'm') {
            $yearNow = Carbon::now()->isoFormat('Y');
            $starDate = Carbon::now()->subMonths(1);
            for ($i = $now; $i > $starDate; $i->subDays(1)) {
                array_push($data, $i->format('d/m/y'));
                array_push($dateq, $i->format('m-d'));
            }

            for ($i = count($data) - 1; $i >= 0; $i--) {
                $datas[] = [
                    'date' => $data[$i],
                    'transaksi' => DB::table('transaksi')->where('tanggal', '=', $yearNow . '-' . $dateq[$i])->count(),
                ];
            }

            $result = [
                'title' => 'Transaksi dalam 1 bulan terakhir',
                'subtitle' => 'Periode ' . Carbon::now()->subMonths(1)->isoFormat('DD-MMMM-YYYY') . ' - ' . Carbon::now()->isoFormat('DD-MMMM-YYYY'),
                'data' => $datas,
                'totalTransaksi' => DB::table('transaksi')->where('tanggal', '>', $starDate)->count(),
                'transaksiDibatalkan' => DB::table('transaksi')->where('tanggal', '>', $starDate)->where('status_tran', 'dibatalkan')->count(),
                'totalPendapatan' => DB::table('tagihan')->where('created_at', '>', $starDate)->where('lunas', '=', 1)->sum('nominal'),
                'totalUser' => DB::table('users')->count(),
                'totalUserBaru' => DB::table('users')->where('created_at', '>', $starDate)->count(),

            ];
            return json_encode($result);
        } else {
            $starDate = Carbon::now()->subYears(1);
            for ($i = $now; $i > $starDate; $i->subMonth(1)) {
                array_push($dateq, $i->format('Y-m-'));
                array_push($data, $i->format('M/Y'));
            }

            for ($i = count($data) - 1; $i >= 0; $i--) {
                $datas[] = [
                    'date' => $data[$i],
                    'transaksi' => DB::table('transaksi')->where('tanggal', 'LIKE', $dateq[$i] . '%')->count(),
                ];

                $result = [
                    'title' => 'Transaksi dalam 1 tahun terakhir',
                    'subtitle' => 'Periode ' . Carbon::now()->subYears(1)->isoFormat('DD-MMMM-YYYY') . ' - ' . Carbon::now()->isoFormat('DD-MMMM-YYYY'),
                    'data' => $datas,
                    'totalTransaksi' => DB::table('transaksi')->where('tanggal', '>', $starDate)->count(),
                    'transaksiDibatalkan' => DB::table('transaksi')->where('tanggal', '>', $starDate)->where('status_tran', 'dibatalkan')->count(),
                    'totalPendapatan' => DB::table('tagihan')->where('created_at', '>', $starDate)->where('lunas', '=', 1)->sum('nominal'),
                    'totalUser' => DB::table('users')->count(),
                    'totalUserBaru' => DB::table('users')->where('created_at', '>', $starDate)->count(),

                ];
            }
            return json_encode($result);
        }
    }

    public function customPeriod(Request $request)
    {
        $starDate  = Carbon::parse($request['start']);
        $endDate =  Carbon::parse($request['end']);

        $data = array();
        $dateq = array();
        for ($i = $endDate; $i > $starDate; $i->subDays(1)) {
            array_push($dateq, $i->format('Y/m/d'));
            array_push($data, $i->format('d/m/y'));
        }

        for ($i = count($data) - 1; $i >= 0; $i--) {
            $datas[] = [
                'date' => $data[$i],
                'transaksi' => DB::table('transaksi')->where('tanggal', '=', $dateq[$i])->count(),
            ];
        }
        $result = [
            'title' => 'Laporan Transaksi',
            'subtitle' => 'Periode ' . Carbon::parse($request['start'])->isoFormat('DD-MMMM-YYYY') . ' - ' . Carbon::parse($request['start'])->isoFormat('DD-MMMM-YYYY'),
            'data' => $datas,
            'totalTransaksi' => DB::table('transaksi')->where('tanggal', '>', $starDate)->count(),
            'transaksiDibatalkan' => DB::table('transaksi')->where('tanggal', '>', $starDate)->where('status_tran', 'dibatalkan')->count(),
            'totalPendapatan' => DB::table('tagihan')->where('created_at', '>', $starDate)->where('lunas', '=', 1)->sum('nominal'),
            'totalUser' => DB::table('users')->count(),
            'totalUserBaru' => DB::table('users')->where('created_at', '>', $starDate)->count(),

        ];
        return json_encode($result);
    }
}
