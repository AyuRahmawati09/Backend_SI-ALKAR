<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Admin melihat seluruh data alumni terdaftar
    public function lihatDataAlumni()
    {
        // Menarik data alumni beserta data user (akun loginnya)
        $alumni = Alumni::with('user')->get();
        
        return response()->json([
            'success' => true,
            'total_data' => $alumni->count(),
            'data' => $alumni
        ], 200);
    }
}