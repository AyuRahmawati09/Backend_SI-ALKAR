<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    // Menampilkan semua lowongan (Bisa diakses Alumni & Admin)
    public function index()
    {
        // Mengambil data lowongan yang statusnya aktif
        $lowongan = Lowongan::where('status', 'aktif')->get();
        
        return response()->json([
            'success' => true,
            'data' => $lowongan
        ], 200);
    }

    // Menambah lowongan baru (Hanya Admin)
    public function store(Request $request)
    {
        $request->validate([
            'id_admin' => 'required|integer',
            'perusahaan' => 'required|string',
            'posisi' => 'required|string',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string',
            'tanggal_posting' => 'required|date',
            'batas_pendaftaran' => 'required|date',
        ]);

        // Instansiasi dan simpan objek Lowongan
        $lowongan = Lowongan::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Lowongan berhasil ditambahkan!',
            'data' => $lowongan
        ], 201);
    }

    // Menghapus lowongan
    public function destroy($id)
    {
        $lowongan = Lowongan::find($id);
        
        if (!$lowongan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $lowongan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Lowongan berhasil dihapus!'
        ], 200);
    }
}