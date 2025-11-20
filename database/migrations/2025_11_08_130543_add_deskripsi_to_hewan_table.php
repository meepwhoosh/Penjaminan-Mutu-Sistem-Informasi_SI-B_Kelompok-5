<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah kolom deskripsi ke tabel hewan.
     */
    public function up(): void
    {
        Schema::table('hewan', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->after('ras');
        });
    }

    /**
     * Rollback kolom deskripsi.
     */
    public function down(): void
    {
        Schema::table('hewan', function (Blueprint $table) {
            $table->dropColumn('deskripsi');
        });
    }
};
