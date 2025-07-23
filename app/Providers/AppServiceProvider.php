<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Pastikan tidak ada logika $this->routes() di sini.
        // Bagian ini biasanya kosong atau hanya berisi service binding sederhana.
    }
}
