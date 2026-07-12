<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // Pertahankan fitur bawaan untuk optimasi seeder
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil kelas AdminSeeder yang sudah memiliki 
        // struktur data dan relasi yang 100% benar
        $this->call([
            AdminSeeder::class,
        ]);
    }
}