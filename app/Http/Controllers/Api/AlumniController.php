<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    // Ubah profil alumni
    public function ubahProfil(Request $request, $id)
    {
        $alumni = Alumni::find($id);
        if (!$alumni) return response()->json(['message' => 'Alumni tidak ditemukan'], 404);

        $request->validate([
            'alamat' => 'sometimes|string',
            'no_hp' => 'sometimes|string',
            'foto' => 'sometimes|string' // Bisa dikembangkan pakai upload file beneran
        ]);

        // Method UPDATE: Mengubah state/nilai properti dari sebuah objek
        $alumni->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui!',
            'data' => $alumni
        ], 200);
    }
}