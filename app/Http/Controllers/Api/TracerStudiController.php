<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TracerStudi;
use Illuminate\Http\Request;

class TracerStudiController extends Controller
{
    // Menambah data Tracer Study (Diisi oleh Alumni)
    public function store(Request $request)
    {
        $request->validate([
            'id_alumni' => 'required|integer',
            'pekerjaan' => 'required|string',
            'nama_perusahaan' => 'required|string',
            'status_pekerjaan' => 'required|in:bekerja,wirausaha,melanjutkan_studi,belum_bekerja',
            'gaji' => 'required|string',
            'tanggal_isi' => 'required|date',
        ]);

        $tracer = TracerStudi::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data Tracer Study berhasil disimpan! Terima kasih atas partisipasinya.',
            'data' => $tracer
        ], 201);
    }

    // Rekap Data Tracer Study untuk Admin (Misal untuk Laporan)
    public function rekap()
    {
        // Memuat semua data tracer study beserta data diri alumninya (Eager Loading OOP)
        $data = TracerStudi::with('alumni')->get();
        
        return response()->json([
            'success' => true,
            'total_data' => $data->count(),
            'data' => $data
        ], 200);
    }
}