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
        Schema::table('data_pemohon_pegawai', function (Blueprint $table) {
            $table->string('nama_perusahaan_kantor')->nullable()->after('riwayat_kredit_sebelumnya');
            $table->string('jenis_pekerjaan_detail')->nullable()->after('nama_perusahaan_kantor');
            $table->decimal('pendapatan_lain', 15, 2)->nullable()->after('jenis_pekerjaan_detail');
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
        Schema::table('data_pemohon_pegawai', function (Blueprint $table) {
            $table->dropColumn([
                'nama_perusahaan_kantor',
                'jenis_pekerjaan_detail',
                'pendapatan_lain',
                'pengeluaran_rutin',
                'nama_kontak_darurat',
                'hubungan_kontak_darurat',
                'no_telepon_kontak_darurat',
            ]);
        });
    }
};
