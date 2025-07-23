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
        'tanggal_pengajuan',
        'skor_kredit',
        'rekomendasi_sistem',
        'status_aplikasi',
        'direksi_id_persetujuan',
        'tanggal_persetujuan_direksi',
        'catatan_direksi',
        'catatan_kepala_bagian',
        'nama_lengkap_pemohon',
        'no_ktp',
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
    ];

    // Tambahkan properti $casts untuk mengonversi kolom tanggal ke objek Carbon
    protected $casts = [
        'tanggal_pengajuan' => 'date',
        'tanggal_lahir' => 'date',
        'tanggal_persetujuan_direksi' => 'datetime', // Jika ini juga tanggal
    ];

    public function pengaju()
    {
        return $this->belongsTo(User::class, 'user_id_pengaju');
    }

    public function direksiPenyetuju()
    {
        return $this->belongsTo(User::class, 'direksi_id_persetujuan');
    }

    public function dataPemohonUmkm()
    {
        return $this->hasOne(DataPemohonUmkm::class, 'aplikasi_id');
    }

    public function dataPemohonPegawai()
    {
        return $this->hasOne(DataPemohonPegawai::class, 'aplikasi_id');
    }
}
