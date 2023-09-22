<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PemasukanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.pemasukan.index', compact('user'));
    }
    public function table_pemasukan()
    {
        $query = Keuangan::where('jenis', 'pemasukan');

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
