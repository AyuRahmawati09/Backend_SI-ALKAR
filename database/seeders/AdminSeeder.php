<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Instansiasi Objek User (Akun Login Admin)
        $user = User::create([
            'nama' => 'Admin Utama',
            'email' => 'admin@alkar.com',
            'password' => Hash::make('password123'), // Password dienkripsi dengan aman
            'role' => 'admin',
        ]);

        // 2. Instansiasi Objek Profil Admin (Relasi)
        Admin::create([
            'id_user' => $user->id_user,
            'nama_admin' => 'Admin Utama',
        ]);

        $this->command->info('Data Admin Pertama Berhasil Dibuat!');
    }
}