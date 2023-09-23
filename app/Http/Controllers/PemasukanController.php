<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class PemasukanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.pemasukan.index', compact('user'));
    }
    public function table_pemasukan()
    {
        $user = Auth::user();
        $query = Keuangan::with('user')->where('jenis', 'pemasukan')->where('user_id', $user->id);

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
                    Edit
                </a>
                
                <form method="POST" action="' . route('deletepemasukan', $data->id) . '" style="display: inline;" class="form-delete">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger delete-btn" data-id="' . $data->id . '">
                        <i class="glyphicon glyphicon-trash icon-white"></i> 
                        Hapus
                    </button>
                </form>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function create()
    {
        return view('admin.pemasukan.create');
    }
    public function store(request $request)
    {
        // Validasi inputan jika diperlukan
        $request->validate([
            'nominal' => 'required|numeric',
            'keterangan' => 'string',
        ]);

        $data = [
            'id' => Str::uuid(),
            'name' => $request->input('name'),
            'nominal' => $request->input('nominal'),
            'keterangan' => $request->input('keterangan'),
            'user_id' => auth()->id(),
        ];

        Keuangan::create($data);
    }
    public function delete($id)
    {
        $data = Keuangan::findOrFail($id);
        $data->delete();
    }
}
