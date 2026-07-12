<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Alumni;
use App\Models\TracerStudi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Generate Laporan Baru (Tugas Admin)
    public function generate(Request $request)
    {
        $request->validate([
            'id_admin' => 'required|integer',
            'periode_awal' => 'required|date',
            'periode_akhir' => 'required|date',
        ]);

        // Menerapkan Aggregation OOP: Menghitung jumlah objek dari kelas lain
        $totalAlumni = Alumni::count();
        $totalTracer = TracerStudi::whereBetween('tanggal_isi', [$request->periode_awal, $request->periode_akhir])->count();

        $laporan = Laporan::create([
            'id_admin' => $request->id_admin,
            'periode_awal' => $request->periode_awal,
            'periode_akhir' => $request->periode_akhir,
            'total_alumni' => $totalAlumni,
            'total_tracer' => $totalTracer
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil di-generate!',
            'data' => $laporan
        ], 201);
    }
}