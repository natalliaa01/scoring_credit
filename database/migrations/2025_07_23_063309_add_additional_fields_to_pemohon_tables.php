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
        Schema::table('data_pemohon_umkm', function (Blueprint $table) {
            $table->string('tahun_berdiri_usaha', 4)->nullable()->after('jangka_waktu_kredit_bulan');
            $table->decimal('pendapatan_lain', 15, 2)->nullable()->after('tahun_berdiri_usaha');
            $table->decimal('pengeluaran_rutin', 15, 2)->nullable()->after('pendapatan_lain');
            $table->string('nama_kontak_darurat')->nullable()->after('pengeluaran_rutin');
            $table->enum('hubungan_kontak_darurat', ['Orang Tua', 'Saudara', 'Adik', 'Kakak', 'Teman', 'Lainnya'])->nullable()->after('nama_kontak_darurat');
            $table->string('no_telepon_kontak_darurat')->nullable()->after('hubungan_kontak_darurat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_pemohon_umkm', function (Blueprint $table) {
            $table->dropColumn([
                'tahun_berdiri_usaha',
                'pendapatan_lain',
                'pengeluaran_rutin',
                'nama_kontak_darurat',
                'hubungan_kontak_darurat',
                'no_telepon_kontak_darurat',
            ]);
        });
    }
};
