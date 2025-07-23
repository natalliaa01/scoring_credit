<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AplikasiKreditController; // Import AplikasiKreditController
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Mengarahkan root URL langsung ke halaman login
Route::get('/', function () {
    return redirect()->route('login'); // Mengarahkan ke halaman login
});

// Grup rute yang memerlukan autentikasi dan verifikasi email
Route::middleware(['auth', 'verified'])->group(function () {
    // Route untuk Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // --- ROUTE UNTUK APLIKASI KREDIT ---
    // Menggunakan resource route untuk operasi CRUD standar (index, create, store, show, edit, update, destroy)
    // Policy yang terdaftar di AuthServiceProvider dan authorizeResource di controller akan menangani otorisasi
    Route::resource('aplikasi-kredit', AplikasiKreditController::class);

    // Route khusus untuk persetujuan Direksi dan penerusan ke Direksi
    // Otorisasi untuk rute ini akan ditangani oleh Policy yang dipanggil secara eksplisit di controller
    Route::post('aplikasi-kredit/{aplikasi_kredit}/forward-to-direksi', [AplikasiKreditController::class, 'forwardToDireksi'])->name('aplikasi-kredit.forward-to-direksi');
    Route::post('aplikasi-kredit/{aplikasi_kredit}/approve', [AplikasiKreditController::class, 'approve'])->name('aplikasi-kredit.approve');
    Route::post('aplikasi-kredit/{aplikasi_kredit}/reject', [AplikasiKreditController::class, 'reject'])->name('aplikasi-kredit.reject');
    // --- AKHIR ROUTE APLIKASI KREDIT ---
});

// Grup rute yang hanya memerlukan autentikasi (untuk profil pengguna)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Memuat rute autentikasi Breeze (login, register, logout, dll.)
require __DIR__.'/auth.php';
