// database/migrations/XXXX_XX_XX_XXXXXX_add_status_to_users_table.php

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
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom 'status' setelah kolom 'role'
            $table->enum('status', ['pending', 'active', 'rejected'])->default('pending')->after('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom 'status' jika migrasi di-rollback
            $table->dropColumn('status');
        });
    }
};