// database/migrations/XXXX_XX_XX_XXXXXX_create_kategori_golongan_jabatan_table.php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_golongan_jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_golongan_jabatan')->unique();
            $table->enum('kategori_penghasilan', ['Rendah', 'Menengah', 'Tinggi', 'Sangat Tinggi'])->default('Menengah');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_golongan_jabatan');
    }
};