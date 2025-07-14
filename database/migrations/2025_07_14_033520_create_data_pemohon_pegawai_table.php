// database/migrations/XXXX_XX_XX_XXXXXX_create_data_pemohon_pegawai_table.php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_pemohon_pegawai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aplikasi_id')->constrained('aplikasi_kredit')->onDelete('cascade');
            $table->string('nama_pegawai');
            $table->smallInteger('usia');
            $table->smallInteger('masa_kerja_tahun');
            $table->foreignId('golongan_jabatan_id')->constrained('kategori_golongan_jabatan')->onDelete('restrict'); // REFERENSI BARU
            $table->enum('status_kepegawaian', ['Tetap', 'Kontrak']);
            $table->decimal('gaji_bulanan', 15, 2);
            $table->smallInteger('jumlah_tanggungan');
            $table->enum('riwayat_kredit_sebelumnya', ['Pernah Macet', 'Tidak Pernah', 'Lain-lain'])->default('Tidak Pernah');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_pemohon_pegawai');
    }
};