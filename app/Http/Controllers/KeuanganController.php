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
    public function table_keuangan()
    {
        $user = Auth::user();
        $query = Keuangan::with('user')->where('user_id', $user->id);

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('No', function ($data) {
                static $i = 1;
                return $i++;
            })
            ->addColumn('aksi', function ($data) {
                return '
                <a class="btn btn-info" href="' . route('dashboard', $data->id) . '">
                    <i class="glyphicon glyphicon-edit icon-white"></i> 
                    Pilih
                </a>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
