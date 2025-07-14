<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriGolonganJabatan extends Model
{
    use HasFactory;

    protected $table = 'kategori_golongan_jabatan';

    protected $fillable = [
        'nama_golongan_jabatan',
        'kategori_penghasilan',
        'keterangan',
    ];

    // Relasi: Satu kategori golongan jabatan bisa dimiliki oleh banyak data pemohon pegawai
    public function dataPemohonPegawais()
    {
        return $this->hasMany(DataPemohonPegawai::class, 'golongan_jabatan_id');
    }
}