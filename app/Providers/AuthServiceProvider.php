<?php

namespace App\Providers;

use App\Models\AplikasiKredit; // Import model
use App\Policies\AplikasiKreditPolicy; // Import policy
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        AplikasiKredit::class => AplikasiKreditPolicy::class, // <-- TAMBAHKAN BARIS INI
        // 'App\Models\Model' => 'App\Policies\ModelPolicy', // Contoh lain
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}