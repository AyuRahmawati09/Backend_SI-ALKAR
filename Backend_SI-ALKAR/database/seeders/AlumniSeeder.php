<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Alumni;
use Illuminate\Support\Facades\Hash;

class AlumniSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'nama' => 'Budi Santoso',
            'email' => 'alumni@gmail.com',
            'password' => Hash::make('alumni123'),
            'role' => 'alumni',
        ]);

        Alumni::create([
            'id_user' => $user->id_user,
            'nim' => '2021001',
            'nama' => 'Budi Santoso',
            'prodi' => 'Informatika',
            'tahun_lulus' => 2024,
            'alamat' => 'OKU Timur',
            'no_hp' => '081234567890',
            'email' => 'alumni@gmail.com',
        ]);
    }
}