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
        // 'nama_umkm', // Jika sudah dihapus dari tabel, hapus dari sini juga
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
        // Tambahkan kolom-kolom baru dari migrasi di sini
        'tahun_berdiri_usaha',
        'pendapatan_lain',
        'pengeluaran_rutin',
        'nama_kontak_darurat',
        'hubungan_kontak_darurat',
        'no_telepon_kontak_darurat',
    ];

    public function aplikasiKredit()
    {
        return $this->belongsTo(AplikasiKredit::class, 'aplikasi_id');
    }

    public function sektorEkonomi()
    {
        return $this->belongsTo(KategoriSektorEkonomi::class, 'sektor_ekonomi_id');
    }
}