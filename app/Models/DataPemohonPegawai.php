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
        // 'nama_pegawai', // Jika kolom ini ada di tabel, tambahkan kembali. Berdasarkan error sebelumnya, 'nama_lengkap_pemohon' disimpan di AplikasiKredit
        'usia',
        'masa_kerja_tahun',
        'golongan_jabatan_id', // FK
        'status_kepegawaian',
        'gaji_bulanan',
        'jumlah_tanggungan',
        'riwayat_kredit_sebelumnya',
        // Kolom-kolom baru dari migrasi
        'nama_perusahaan_kantor',
        'jenis_pekerjaan_detail',
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

    public function golonganJabatan()
    {
        return $this->belongsTo(KategoriGolonganJabatan::class, 'golongan_jabatan_id');
    }
}
