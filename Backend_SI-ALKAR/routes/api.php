<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AlumniController;
use App\Http\Controllers\Api\LowonganController;
use App\Http\Controllers\Api\InformasiController;
use App\Http\Controllers\Api\TracerStudiController;
use App\Http\Controllers\Api\LaporanController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::post('/register-alumni', [AuthController::class, 'registerAlumni']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/lowongan', [LowonganController::class, 'index']);
Route::get('/informasi', [InformasiController::class, 'index']);

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);

    // Alumni
    Route::put('/alumni/{id}', [AlumniController::class, 'ubahProfil']);
    Route::post('/tracer-studi', [TracerStudiController::class, 'store']);

    // Admin
    Route::get('/admin/alumni', [AdminController::class, 'lihatDataAlumni']);
    Route::get('/admin/tracer-studi', [TracerStudiController::class, 'rekap']);

    // Lowongan
    Route::post('/lowongan', [LowonganController::class, 'store']);
    Route::delete('/lowongan/{id}', [LowonganController::class, 'destroy']);

    // Informasi
    Route::post('/informasi', [InformasiController::class, 'store']);
    Route::delete('/informasi/{id}', [InformasiController::class, 'destroy']);

    // Laporan
    Route::post('/laporan/generate', [LaporanController::class, 'generate']);
});