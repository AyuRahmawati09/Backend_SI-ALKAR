<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LowonganController;
use App\Http\Controllers\Api\TracerStudiController;
use App\Http\Controllers\Api\InformasiController;
use App\Http\Controllers\Api\LaporanController;  
use App\Http\Controllers\Api\AlumniController;
use App\Http\Controllers\Api\AdminController;

// ==========================================
// RUTE PUBLIK (Bisa diakses tanpa login)
// ==========================================
Route::post('/register-alumni', [AuthController::class, 'registerAlumni']);
Route::post('/login', [AuthController::class, 'login']);

// Publik (Alumni yang belum login pun bisa melihat daftar lowongan & informasi)
Route::get('/lowongan', [LowonganController::class, 'index']);
Route::get('/informasi', [InformasiController::class, 'index']);


// ==========================================
// RUTE TERPROTEKSI (Wajib menyertakan Token)
// ==========================================
Route::middleware('auth:sanctum')->group(function () {
    
    // Keluar Aplikasi (Hapus Token)
    Route::post('/logout', [AuthController::class, 'logout']);

    // --- FITUR ALUMNI ---
    // Update Profil (Menggunakan method PUT untuk proses update OOP)
    Route::put('/alumni/{id}', [AlumniController::class, 'ubahProfil']);
    
    // Mengisi Tracer Study
    Route::post('/tracer-studi', [TracerStudiController::class, 'store']);


    // --- FITUR ADMIN ---
    // Kelola Data Alumni & Rekap
    Route::get('/admin/alumni', [AdminController::class, 'lihatDataAlumni']);
    Route::get('/admin/tracer-studi', [TracerStudiController::class, 'rekap']);
    
    // Kelola Lowongan (Akses Penuh Admin: Lihat, Tambah, Ubah, Hapus)
    Route::get('/admin/lowongan', [LowonganController::class, 'index']);
    Route::post('/admin/lowongan', [LowonganController::class, 'store']);
    Route::put('/admin/lowongan/{id}', [LowonganController::class, 'update']);
    Route::delete('/admin/lowongan/{id}', [LowonganController::class, 'destroy']);
    
    // Kelola Informasi (Bisa kamu samakan formatnya dengan lowongan nanti)
    Route::post('/informasi', [InformasiController::class, 'store']);
    Route::delete('/informasi/{id}', [InformasiController::class, 'destroy']);
    Route::get('/informasi', [InformasiController::class, 'index']);
    // ==========================================
    // Kelola Informasi (Akses Penuh Admin)
    // ==========================================
    Route::get('/admin/informasi', [InformasiController::class, 'index']);       // Melihat daftar informasi
    Route::post('/admin/informasi', [InformasiController::class, 'store']);      // Menambah informasi baru
    Route::put('/admin/informasi/{id}', [InformasiController::class, 'update']); // Mengubah/Update informasi
    Route::delete('/admin/informasi/{id}', [InformasiController::class, 'destroy']); // Menghapus informasi
    
    // Generate Laporan
    Route::post('/laporan/generate', [LaporanController::class, 'generate']);

});