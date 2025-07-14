<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Pastikan ini ada di bagian atas

class KategoriDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // NONAKTIFKAN FOREIGN KEY CHECKS SEMENTARA
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Pastikan tabel kosong sebelum diisi ulang jika db:seed dijalankan berkali-kali
        DB::table('kategori_sektor_ekonomi')->truncate();
        DB::table('kategori_golongan_jabatan')->truncate();

        // AKTIFKAN FOREIGN KEY CHECKS KEMBALI SETELAH TRUNCATE SELESAI
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Seed Kategori Sektor Ekonomi
        DB::table('kategori_sektor_ekonomi')->insert([
            ['kode_kbli' => 'A', 'nama_sektor' => 'Pertanian, Kehutanan, dan Perikanan', 'tingkat_risiko' => 'Rendah', 'keterangan' => 'Sektor dasar yang cenderung stabil.', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kbli' => 'C', 'nama_sektor' => 'Industri Pengolahan', 'tingkat_risiko' => 'Sedang', 'keterangan' => 'Industri manufaktur dan pengolahan.', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kbli' => 'F', 'nama_sektor' => 'Konstruksi', 'tingkat_risiko' => 'Sedang', 'keterangan' => 'Sektor pembangunan infrastruktur.', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kbli' => 'G', 'nama_sektor' => 'Perdagangan Besar dan Eceran', 'tingkat_risiko' => 'Sedang', 'keterangan' => 'Perdagangan barang konsumsi dan non-konsumsi.', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kbli' => 'I', 'nama_sektor' => 'Penyediaan Akomodasi dan Makan Minum (Kafe/Restoran)', 'tingkat_risiko' => 'Tinggi', 'keterangan' => 'Sektor jasa pariwisata dan kuliner.', 'created_at' => now(), 'updated_at' => now()],
            ['kode_kbli' => 'R', 'nama_sektor' => 'Kebudayaan, Hiburan, dan Rekreasi', 'tingkat_risiko' => 'Tinggi', 'keterangan' => 'Sektor hiburan dan rekreasi.', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed Kategori Golongan Jabatan
        DB::table('kategori_golongan_jabatan')->insert([
            ['nama_golongan_jabatan' => 'Direksi/Eksekutif', 'kategori_penghasilan' => 'Sangat Tinggi', 'keterangan' => 'Jabatan tertinggi dalam organisasi.', 'created_at' => now(), 'updated_at' => now()],
            ['nama_golongan_jabatan' => 'Manajer Senior/Kepala Bagian', 'kategori_penghasilan' => 'Tinggi', 'keterangan' => 'Manajemen tingkat atas/menengah.', 'created_at' => now(), 'updated_at' => now()],
            ['nama_golongan_jabatan' => 'Manajer/Supervisor', 'kategori_penghasilan' => 'Menengah', 'keterangan' => 'Bertanggung jawab atas tim atau departemen.', 'created_at' => now(), 'updated_at' => now()],
            ['nama_golongan_jabatan' => 'Staf Senior/Profesional', 'kategori_penghasilan' => 'Menengah', 'keterangan' => 'Memiliki keahlian khusus dan pengalaman.', 'created_at' => now(), 'updated_at' => now()],
            ['nama_golongan_jabatan' => 'Staf Junior/Pelaksana', 'kategori_penghasilan' => 'Rendah', 'keterangan' => 'Posisi entry-level atau pelaksana tugas rutin.', 'created_at' => now(), 'updated_at' => now()],
            ['nama_golongan_jabatan' => 'Pensiunan', 'kategori_penghasilan' => 'Menengah', 'keterangan' => 'Menerima dana pensiun secara berkala.', 'created_at' => now(), 'updated_at' => now()],
            ['nama_golongan_jabatan' => 'Karyawan Harian/Buruh', 'kategori_penghasilan' => 'Rendah', 'keterangan' => 'Pekerja dengan upah harian atau borongan.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}