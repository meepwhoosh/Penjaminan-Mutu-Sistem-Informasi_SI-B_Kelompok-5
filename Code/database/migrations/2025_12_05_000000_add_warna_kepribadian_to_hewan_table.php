<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hewan', function (Blueprint $table) {
            $table->string('warna', 50)->nullable()->after('gender');
            $table->string('kepribadian', 255)->nullable()->after('warna');
        });
    }

    public function down(): void
    {
        Schema::table('hewan', function (Blueprint $table) {
            $table->dropColumn(['warna', 'kepribadian']);
        });
    }
};
