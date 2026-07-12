<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    // Lihat semua informasi (Untuk Alumni)
    public function index()
    {
        $informasi = Informasi::where('status', 'aktif')->get();
        return response()->json(['success' => true, 'data' => $informasi], 200);
    }

    // Tambah informasi baru (Untuk Admin)
    public function store(Request $request)
    {
        $request->validate([
            'id_admin' => 'required|integer',
            'judul' => 'required|string',
            'isi' => 'required|string',
        ]);

        $informasi = Informasi::create($request->all());

        return response()->json([
            'success' => true, 
            'message' => 'Informasi berhasil ditambahkan',
            'data' => $informasi
        ], 201);
    }

    // Hapus informasi (Untuk Admin)
    public function destroy($id)
    {
        $informasi = Informasi::find($id);
        if (!$informasi) return response()->json(['message' => 'Data tidak ditemukan'], 404);
        
        $informasi->delete();
        return response()->json(['success' => true, 'message' => 'Informasi dihapus!'], 200);
    }
}