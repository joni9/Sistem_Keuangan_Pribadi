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
                <form method="GET" action="' . route('editpemasukan', $data->id) . '" style="display: inline;" class="form-edit">
                    ' . csrf_field() . '
                    <button type="submit" class="btn btn-info edit-btn" data-id="' . $data->id . '">
                        <i class="glyphicon glyphicon-trash icon-white"></i> 
                        Edit
                    </button>
                </form>
                
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
    public function edit($id)
    {
        $keuangan = Keuangan::findOrFail($id);
        return view('admin.pemasukan.edit', compact('keuangan'));
    }
    public function update(Request $request, $id)
    {
        // Validasi inputan jika diperlukan
        $request->validate([
            'nominal' => 'required|numeric',
            'keterangan' => 'string',
        ]);
        // Cari data tahun berdasarkan $id
        $keuangan = Keuangan::where('id', $id)->first();

        if (!$keuangan) {
            // Jika data tidak ditemukan, redirect dengan pesan error
            return redirect()->back()->with(['error' => 'Data tidak ditemukan!']);
        }

        // Update data keuangan dengan data baru dari form
        $keuangan->nominal = $request->nominal;
        $keuangan->keterangan = $request->keterangan;
        $keuangan->save();
    }
    public function delete($id)
    {
        $data = Keuangan::findOrFail($id);
        $data->delete();
    }
}
