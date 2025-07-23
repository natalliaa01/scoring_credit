<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aplikasi_kredit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id_pengaju')->nullable()->constrained('users')->onDelete('set null'); // Pengaju aplikasi
            $table->foreignId('direksi_id_persetujuan')->nullable()->constrained('users')->onDelete('set null'); // Direksi yang menyetujui

            // Data Umum Pemohon (dipindahkan dari tabel detail ke tabel utama)
            $table->string('nama_lengkap_pemohon');
            $table->string('no_ktp')->unique();
            $table->date('tanggal_pengajuan');
            $table->string('jenis_kelamin')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('alamat_ktp')->nullable();
            $table->string('alamat_tinggal')->nullable();
            $table->string('status_tempat_tinggal')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->string('no_handphone')->nullable();
            $table->string('no_telepon_rumah')->nullable();
            $table->string('no_npwp')->nullable();
            $table->string('email_pemohon')->nullable();
            $table->string('tujuan_penggunaan_kredit')->nullable();
            $table->string('jenis_jaminan_detail')->nullable();
            $table->decimal('nilai_jaminan', 15, 2)->nullable();
            $table->string('status_kepemilikan_jaminan')->nullable();

            // Data Aplikasi Kredit
            $table->string('jenis_pemohon'); // UMKM atau Pegawai
            $table->decimal('skor_kredit', 5, 2)->nullable(); // Skor hasil scoring
            $table->string('rekomendasi_sistem')->nullable(); // Rekomendasi sistem (Disetujui/Ditolak)
            $table->string('status_aplikasi')->default('Diajukan'); // Diajukan, Menunggu Persetujuan Direksi, Disetujui Direksi, Ditolak Direksi
            $table->timestamp('tanggal_persetujuan_direksi')->nullable();
            $table->text('catatan_direksi')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aplikasi_kredit');
    }
};
