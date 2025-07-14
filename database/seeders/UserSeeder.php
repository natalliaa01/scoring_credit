<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // NONAKTIFKAN FOREIGN KEY CHECKS SEMENTARA
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('users')->truncate();

        // AKTIFKAN FOREIGN KEY CHECKS KEMBALI SETELAH TRUNCATE SELESAI
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('users')->insert([
            [
                'name' => 'Admin Utama',
                'email' => 'admin@msa.com',
                'password' => Hash::make('admin'), // Password default: 'password'
                'role' => 'admin',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Direksi Utama',
                'email' => 'direksi@msa.com',
                'password' => Hash::make('direksi'),
                'role' => 'direksi',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kepala Bagian Kredit',
                'email' => 'kabag@msa.com',
                'password' => Hash::make('kabag'),
                'role' => 'kepala_bagian',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Teller Cabang A',
                'email' => 'teller@msa.com',
                'password' => Hash::make('teller'),
                'role' => 'teller',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}