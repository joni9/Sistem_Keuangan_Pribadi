<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PemasukanControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $pemasukan = Keuangan::with('user')->where('jenis', 'pemasukan')->latest('created_at')->get();

        if ($pemasukan->isEmpty()) {
            return response()->json([
                'status'    => false,
                'message'   => 'Data tidak ditemukan',
                'data'      => []
            ], 404);
        }

        return response()->json([
            'status'    => true,
            'message'   => 'Data ready',
            'data'      => $pemasukan
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pemasukan = new Keuangan;
        $uuid = Str::uuid();
        $pemasukan->id      = $uuid;
        $pemasukan->nominal = $request->nominal;
        $pemasukan->jenis   = 'pemasukan';
        $pemasukan->keterangan   = $request->keterangan;
        $pemasukan->user_id   = $request->user_id;
        $pemasukan->save();
        if ($request->created_at) {
            $pemasukanBaru = Keuangan::find($uuid);
            $pemasukanBaru->created_at = $request->created_at;
            $pemasukanBaru->save();
        }

        return response()->json([
            'status'    => true,
            'message'   => 'Data berhasil ditambahkan',
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pemasukan = Keuangan::with('user')->find($id);
        if ($pemasukan) {
            return response()->json([
                'status'    => true,
                'message'   => 'Data ready',
                'data'      => $pemasukan
            ], 200);
        } else {
            return response()->json([
                'status'    => true,
                'message'   => 'Data tidak ditemukan',
                'data'      => []
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pemasukan = Keuangan::with('user')->find($id);
        if ($pemasukan) {
            return response()->json([
                'status'    => true,
                'message'   => 'Data ready',
                'data'      => $pemasukan
            ], 200);
        } else {
            return response()->json([
                'status'    => true,
                'message'   => 'Data tidak ditemukan',
                'data'      => []
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pemasukan = Keuangan::with('user')->find($id);
        if ($pemasukan) {

            $pemasukan->nominal = $request->nominal;
            $pemasukan->jenis   = 'pemasukan';
            $pemasukan->keterangan   = $request->keterangan;
            $pemasukan->user_id   = $request->user_id;
            if ($request->created_at) {
                $pemasukan->created_at = $request->created_at;
            }
            $pemasukan->save();

            return response()->json([
                'status'    => true,
                'message'   => 'Data berhasil di update',
            ], 200);
        } else {
            return response()->json([
                'status'    => true,
                'message'   => 'Data tidak ditemukan',
                'data'      => []
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pemasukan = Keuangan::with('user')->find($id);
        if ($pemasukan) {
            $pemasukan->delete();
            return response()->json([
                'status'    => true,
                'message'   => 'Data berhsil dihapus',
            ], 200);
        } else {
            return response()->json([
                'status'    => true,
                'message'   => 'Data tidak ditemukan',
            ], 404);
        }
    }
}
