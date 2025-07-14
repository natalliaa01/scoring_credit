<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AplikasiKredit extends Model // <--- PASTIKAN CLASS NAME INI BENAR
{
    use HasFactory;

    protected $table = 'aplikasi_kredit'; // Sesuaikan dengan nama tabel Anda jika tidak plural default Laravel

    protected $fillable = [
        'user_id_pengaju',
        'tanggal_pengajuan',
        'skor_kredit',
        'rekomendasi_sistem',
        'status_aplikasi',
        'direksi_id_persetujuan',
        'tanggal_persetujuan_direksi',
        'catatan_direksi',
        'catatan_kepala_bagian',
    ];

    // Relasi ke User (pengaju)
    public function pengaju()
    {
        return $this->belongsTo(User::class, 'user_id_pengaju');
    }

    // Relasi ke User (direksi yang menyetujui)
    public function direksiPenyetuju()
    {
        return $this->belongsTo(User::class, 'direksi_id_persetujuan');
    }

    // Relasi ke data pemohon UMKM
    public function dataUmkm()
    {
        return $this->hasOne(DataPemohonUmkm::class, 'aplikasi_id');
    }

    // Relasi ke data pemohon Pegawai
    public function dataPegawai()
    {
        return $this->hasOne(DataPemohonPegawai::class, 'aplikasi_id');
    }
}