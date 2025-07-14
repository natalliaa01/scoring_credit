// database/migrations/XXXX_XX_XX_XXXXXX_create_data_pemohon_umkm_table.php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_pemohon_umkm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aplikasi_id')->constrained('aplikasi_kredit')->onDelete('cascade');
            $table->string('nama_umkm');
            $table->decimal('omzet_usaha', 15, 2);
            $table->smallInteger('lama_usaha_tahun');
            $table->foreignId('sektor_ekonomi_id')->constrained('kategori_sektor_ekonomi')->onDelete('restrict'); // REFERENSI BARU
            $table->string('lokasi_usaha');
            $table->enum('riwayat_pinjaman', ['Pernah Menunggak', 'Pernah Macet', 'Tidak Pernah']);
            $table->enum('jenis_penggunaan_kredit', ['Modal Kerja', 'Investasi']);
            $table->enum('jenis_jaminan', ['Tanah/Bangunan', 'Barang Bergerak', 'Lainnya']);
            $table->enum('sumber_dana_pengembalian', ['Dari Usaha Sendiri', 'Hibah/Pinjaman Lain']);
            $table->decimal('plafond_pengajuan', 15, 2);
            $table->smallInteger('jangka_waktu_kredit_bulan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_pemohon_umkm');
    }
};