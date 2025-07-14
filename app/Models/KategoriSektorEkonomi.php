<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSektorEkonomi extends Model
{
    use HasFactory;

    protected $table = 'kategori_sektor_ekonomi';

    protected $fillable = [
        'kode_kbli',
        'nama_sektor',
        'tingkat_risiko',
        'keterangan',
    ];

    // Relasi: Satu kategori sektor ekonomi bisa dimiliki oleh banyak data pemohon UMKM
    public function dataPemohonUmkms()
    {
        return $this->hasMany(DataPemohonUmkm::class, 'sektor_ekonomi_id');
    }
}