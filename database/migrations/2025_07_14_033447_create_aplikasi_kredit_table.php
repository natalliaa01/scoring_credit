// database/migrations/XXXX_XX_XX_XXXXXX_create_aplikasi_kredit_table.php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aplikasi_kredit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id_pengaju')->constrained('users')->onDelete('cascade');
            $table->date('tanggal_pengajuan');
            $table->decimal('skor_kredit', 8, 2)->nullable();
            $table->string('rekomendasi_sistem')->nullable();
            $table->enum('status_aplikasi', ['Diajukan', 'Diproses Scoring', 'Menunggu Persetujuan Direksi', 'Disetujui Direksi', 'Ditolak Direksi', 'Ditolak Kepala Bagian', 'Ditinjau Ulang'])->default('Diajukan');
            $table->foreignId('direksi_id_persetujuan')->nullable()->constrained('users')->onDelete('set null');
            $table->dateTime('tanggal_persetujuan_direksi')->nullable();
            $table->text('catatan_direksi')->nullable();
            $table->text('catatan_kepala_bagian')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aplikasi_kredit');
    }
};