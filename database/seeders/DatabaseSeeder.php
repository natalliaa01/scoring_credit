<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            KategoriDataSeeder::class, // Panggil seeder kategori data dulu
            UserSeeder::class,       // Lalu panggil seeder user
            // Tambahkan seeder lain di sini jika ada di masa depan
        ]);
    }
}