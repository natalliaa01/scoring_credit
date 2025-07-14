<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPemohonUmkm extends Model
{
    use HasFactory;

    protected $table = 'data_pemohon_umkm';

    protected $fillable = [
        'aplikasi_id',
        'nama_umkm',
        'omzet_usaha',
        'lama_usaha_tahun',
        'sektor_ekonomi_id', // FK
        'lokasi_usaha',
        'riwayat_pinjaman',
        'jenis_penggunaan_kredit',
        'jenis_jaminan',
        'sumber_dana_pengembalian',
        'plafond_pengajuan',
        'jangka_waktu_kredit_bulan',
    ];

    // Relasi: Setiap data pemohon UMKM milik satu AplikasiKredit
    public function aplikasiKredit()
    {
        return $this->belongsTo(AplikasiKredit::class, 'aplikasi_id');
    }

    // Relasi: Setiap data pemohon UMKM memiliki satu KategoriSektorEkonomi
    public function sektorEkonomi()
    {
        return $this->belongsTo(KategoriSektorEkonomi::class, 'sektor_ekonomi_id');
    }
}