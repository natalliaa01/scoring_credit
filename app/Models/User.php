<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // PASTIKAN KOLOM 'role' ADA DI SINI
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

    // Relasi: User bisa mengajukan banyak AplikasiKredit
    public function aplikasiKreditDiajukan()
    {
        return $this->hasMany(AplikasiKredit::class, 'user_id_pengaju');
    }

    // Relasi: User bisa menjadi direksi yang menyetujui banyak AplikasiKredit
    public function aplikasiKreditDisetujui()
    {
        return $this->hasMany(AplikasiKredit::class, 'direksi_id_persetujuan');
    }
}