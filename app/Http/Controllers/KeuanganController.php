<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class KeuanganController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('dashboard.index', compact('user'));
    }
    public function table_keuangan(request $request)
    {
        $user = Auth::user();
        $query = Keuangan::with('user')->where('user_id', $user->id);

        //menyeleksi berdasarkan tanggal
        if ($request->start_date && $request->end_date) {
            // Mengubah format tanggal awal dan akhir sesuai dengan format yang diterima oleh database
            $start_date = date('Y-m-d', strtotime($request->start_date));
            $end_date = date('Y-m-d', strtotime($request->end_date));

            // Menambahkan 1 hari pada tanggal akhir untuk mencakup seluruh rentang waktu
            $end_date = date('Y-m-d', strtotime('+1 day', strtotime($end_date)));

            // Menambahkan kondisi pencarian berdasarkan rentang tanggal pada kolom 'created_at'
            $query = $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('No', function ($data) {
                static $i = 1;
                return $i++;
            })
            ->addColumn('nominal', function ($data) {
                return 'Rp ' . number_format($data->nominal, 0, ',', '.');
            })

            ->addColumn('created_at', function ($data) {
                return $data->created_at->format('d-m-Y');
            })
            ->make(true);
    }
    public function show(Request $request)
    {
        //year and month
        $year   = date('Y');
        $month  = date('m');

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            // Menghitung total semua pengeluaran
            $semuapemasukan = Keuangan::where('jenis', 'pemasukan')
                ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('created_at', [$startDate, $endDate]);
                })
                ->sum('nominal');
            $semuapengeluaran = Keuangan::where('jenis', 'keluaran')
                ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('created_at', [$startDate, $endDate]);
                })
                ->sum('nominal');
            $sisasaldo = $semuapemasukan - $semuapengeluaran;
        } else {
            $semuapemasukan = Keuangan::where('jenis', 'pemasukan')->sum('nominal');
            $semuapengeluaran = Keuangan::where('jenis', 'keluaran')->sum('nominal');
            $sisasaldo = $semuapemasukan - $semuapengeluaran;
        }
        return view('dashboard.show', compact('semuapemasukan', 'semuapengeluaran', 'sisasaldo'));
    }
}
