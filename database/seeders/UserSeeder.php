<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role; // Import Role model

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan peran sudah ada sebelum menetapkannya
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $direksiRole = Role::firstOrCreate(['name' => 'direksi']);
        $kepalaBagianRole = Role::firstOrCreate(['name' => 'kepala_bagian']); // Pastikan nama peran ini konsisten
        $tellerRole = Role::firstOrCreate(['name' => 'teller']);

        // Buat atau temukan user Admin dan berikan peran
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'), // Ganti dengan password yang kuat di produksi
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole($adminRole);

        // Buat atau temukan user Direksi dan berikan peran
        $direksi = User::firstOrCreate(
            ['email' => 'direksi@example.com'],
            [
                'name' => 'Direksi User',
                'password' => Hash::make('password'), // Ganti dengan password yang kuat di produksi
                'email_verified_at' => now(),
            ]
        );
        $direksi->assignRole($direksiRole);

        // Buat atau temukan user Kepala Bagian Kredit dan berikan peran
        $kepalaBagian = User::firstOrCreate(
            ['email' => 'kabag@example.com'],
            [
                'name' => 'Kepala Bagian Kredit User',
                'password' => Hash::make('password'), // Ganti dengan password yang kuat di produksi
                'email_verified_at' => now(),
            ]
        );
        $kepalaBagian->assignRole($kepalaBagianRole);

        // Buat atau temukan user Teller dan berikan peran
        $teller = User::firstOrCreate(
            ['email' => 'teller@example.com'],
            [
                'name' => 'Teller User',
                'password' => Hash::make('password'), // Ganti dengan password yang kuat di produksi
                'email_verified_at' => now(),
            ]
        );
        $teller->assignRole($tellerRole);

        // Anda bisa membuat user lain sesuai kebutuhan
        // User::factory(10)->create()->each(function ($user) {
        //     $user->assignRole('teller'); // Contoh: semua user factory adalah teller
        // });
    }
}
