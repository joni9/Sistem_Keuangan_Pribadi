<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class PengeluaranController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.pengeluaran.index', compact('user'));
    }
    public function table_pengeluaran(request $request)
    {
        $user = Auth::user();
        $query = Keuangan::with('user')->where('jenis', 'keluaran')->where('user_id', $user->id);

        //menyeleksi berdasarkan tanggal
        if ($request->start_date && $request->end_date) {
            // Mengubah format tanggal awal dan akhir sesuai dengan format yang diterima oleh database
            $start_date = date('Y-m-d', strtotime($request->start_date));
            $end_date = date('Y-m-d', strtotime($request->end_date));

            // Menambahkan 1 hari pada tanggal akhir untuk mencakup seluruh rentang waktu
            $end_date = date('Y-m-d', strtotime('+1 day', strtotime($end_date)));

            // Menambahkan kondisi pencarian berdasarkan rentang tanggal pada kolom 'created_at'
            $query = $query->whereBetween('created_at', [$start_date, $end_date]);
        } else {
            $year   = date('Y');
            $query = Keuangan::with('user')->where('jenis', 'keluaran')->where('user_id', $user->id)->whereYear('created_at', $year)->latest('created_at');
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


            ->addColumn('aksi', function ($data) {
                return '
                <form method="GET" action="' . route('editpengeluaran', $data->id) . '" style="display: inline;" class="form-edit">
                    ' . csrf_field() . '
                    <button type="submit" class="btn btn-info edit-btn btn-sm" data-id="' . $data->id . '">
                        <i class="tim-icons icon-pencil"></i>
                    </button>
                </form>
                
                <form method="POST" action="' . route('deletepengeluaran', $data->id) . '" style="display: inline;" class="form-delete">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger delete-btn btn-sm" data-id="' . $data->id . '">
                        <i class="tim-icons icon-trash-simple"></i>
                    </button>
                </form>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function create()
    {
        return view('admin.pengeluaran.create');
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
            'jenis' => $request->input('jenis'),
            'keterangan' => $request->input('keterangan'),
            'user_id' => auth()->id(),
        ];

        Keuangan::create($data);
    }
    public function show(Request $request)
    {
        //year and month
        $year   = date('Y');
        $month  = date('m');
        //statistic revenue
        $pengeluaranbulan = Keuangan::where('jenis', 'keluaran')
            ->whereMonth('created_at', '=', $month)
            ->whereYear('created_at', $year)
            ->sum('nominal');

        $pengeluarantahun = Keuangan::where('jenis', 'keluaran')
            ->whereYear('created_at', $year)
            ->sum('nominal');

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            $endDate = date('Y-m-d', strtotime('+1 day', strtotime($endDate)));
            // Menghitung total semua pengeluaran
            $semuapengeluaran =
                Keuangan::where('jenis', 'keluaran')
                ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('created_at', [$startDate, $endDate]);
                })
                ->sum('nominal');
        } else {
            $semuapengeluaran = Keuangan::where('jenis', 'keluaran')->sum('nominal');
        }
        return view('admin.pengeluaran.show', compact('semuapengeluaran', 'pengeluaranbulan', 'pengeluarantahun'));
    }

    public function edit($id)
    {
        $keuangan = Keuangan::findOrFail($id);
        return view('admin.pengeluaran.edit', compact('keuangan'));
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
