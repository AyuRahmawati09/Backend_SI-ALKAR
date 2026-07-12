<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Alumni;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerAlumni(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
            'nim' => 'required|string|unique:alumni',
            'prodi' => 'required|string',
            'tahun_lulus' => 'required|integer',
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'alumni',
        ]);

        Alumni::create([
            'id_user' => $user->id_user,
            'nim' => $request->nim,
            'nama' => $request->nama,
            'prodi' => $request->prodi,
            'tahun_lulus' => $request->tahun_lulus,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Registrasi Alumni Berhasil!'
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        // Cek apakah user ada dan password cocok
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah!'
            ], 401);
        }

        // Membuat Token API menggunakan Sanctum
        $token = $user->createToken('auth_token', [$user->role])->plainTextToken;

        // Muat relasi secara dinamis berdasarkan role (Polimorfisme)
        $data = $user->role === 'admin' ? $user->load('admin') : $user->load('alumni');

        return response()->json([
            'success' => true,
            'message' => 'Login Berhasil!',
            'token' => $token,
            'role' => $user->role,
            'data' => $data
        ], 200);
    }

    // 3. Logout (Menghapus Token)
    public function logout(Request $request)
    {
        // Menghapus token dari objek user yang sedang aktif
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil logout, token dihapus!'
        ], 200);
    }
}