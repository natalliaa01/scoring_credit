<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AplikasiKreditController; // Import controller

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Enjoy building your API!
|
*/

// Route default dari Breeze untuk user API
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route untuk API pencarian dan daftar kredit
// Untuk kemudahan debugging, sementara tanpa middleware auth:sanctum
Route::get('/aplikasi-kredit', [AplikasiKreditController::class, 'index']);
