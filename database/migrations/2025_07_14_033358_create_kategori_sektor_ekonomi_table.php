// database/migrations/XXXX_XX_XX_XXXXXX_create_kategori_sektor_ekonomi_table.php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_sektor_ekonomi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kbli', 10)->unique()->nullable();
            $table->string('nama_sektor');
            $table->enum('tingkat_risiko', ['Rendah', 'Sedang', 'Tinggi'])->default('Sedang');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_sektor_ekonomi');
    }
};