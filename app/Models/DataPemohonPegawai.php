<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPemohonPegawai extends Model
{
    use HasFactory;

    protected $table = 'data_pemohon_pegawai';

    protected $fillable = [
        'aplikasi_id',
        'nama_pegawai',
        'usia',
        'masa_kerja_tahun',
        'golongan_jabatan_id', // FK
        'status_kepegawaian',
        'gaji_bulanan',
        'jumlah_tanggungan',
        'riwayat_kredit_sebelumnya',
    ];

    // Relasi: Setiap data pemohon Pegawai milik satu AplikasiKredit
    public function aplikasiKredit()
    {
        return $this->belongsTo(AplikasiKredit::class, 'aplikasi_id');
    }

    // Relasi: Setiap data pemohon Pegawai memiliki satu KategoriGolonganJabatan
    public function golonganJabatan()
    {
        return $this->belongsTo(KategoriGolonganJabatan::class, 'golongan_jabatan_id');
    }
}