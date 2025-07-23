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
        // 'nama_umkm', // Jika kolom ini ada di tabel, tambahkan kembali. Berdasarkan error sebelumnya, 'nama_lengkap_pemohon' disimpan di AplikasiKredit
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
        // Kolom-kolom baru dari migrasi
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
