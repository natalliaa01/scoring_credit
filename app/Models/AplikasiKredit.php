<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AplikasiKredit extends Model
{
    use HasFactory;

    protected $table = 'aplikasi_kredit';

    protected $fillable = [
        'user_id_pengaju',
        'direksi_id_persetujuan',
        'nama_lengkap_pemohon',
        'no_ktp',
        'tanggal_pengajuan',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'alamat_ktp',
        'alamat_tinggal',
        'status_tempat_tinggal',
        'status_perkawinan',
        'no_handphone',
        'no_telepon_rumah',
        'no_npwp',
        'email_pemohon',
        'tujuan_penggunaan_kredit',
        'jenis_jaminan_detail',
        'nilai_jaminan',
        'status_kepemilikan_jaminan',
        'jenis_pemohon',
        'skor_kredit',
        'rekomendasi_sistem',
        'status_aplikasi',
        'tanggal_persetujuan_direksi',
        'catatan_direksi',
    ];

    // Relasi ke DataPemohonUmkm
    public function dataPemohonUmkm()
    {
        return $this->hasOne(DataPemohonUmkm::class, 'aplikasi_id');
    }

    // Relasi ke DataPemohonPegawai
    public function dataPemohonPegawai()
    {
        return $this->hasOne(DataPemohonPegawai::class, 'aplikasi_id');
    }

    // Relasi ke User yang mengajukan aplikasi
    public function pengaju()
    {
        return $this->belongsTo(User::class, 'user_id_pengaju');
    }

    // Relasi ke User yang menyetujui (Direksi)
    public function direksiPenyetuju()
    {
        return $this->belongsTo(User::class, 'direksi_id_persetujuan');
    }
}
