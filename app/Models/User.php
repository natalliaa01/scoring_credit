<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // <-- TAMBAHKAN BARIS INI

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles; // <-- TAMBAHKAN HasRoles DI SINI

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function aplikasiKreditDiajukan()
    {
        return $this->hasMany(AplikasiKredit::class, 'user_id_pengaju');
    }

    public function aplikasiKreditDisetujui()
    {
        return $this->hasMany(AplikasiKredit::class, 'direksi_id_persetujuan');
    }

    public function aplikasiKreditDiterima()
    {
        return $this->hasMany(AplikasiKredit::class, 'direksi_id_penerimaan');
    }

    public function aplikasiKreditDitolak()
    {
        return $this->hasMany(AplikasiKredit::class, 'direksi_id_penolakan');
    }

    public function aplikasiKreditDibatalkan()
    {
        return $this->hasMany(AplikasiKredit::class, 'direksi_id_pembatalan');
    }
}
