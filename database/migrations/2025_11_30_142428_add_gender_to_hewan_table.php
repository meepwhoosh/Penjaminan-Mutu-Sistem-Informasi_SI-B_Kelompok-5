<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hewan', function (Blueprint $table) {
            $table->enum('gender', ['jantan', 'betina'])->after('usia')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('hewan', function (Blueprint $table) {
            $table->dropColumn('gender');
        });
    }
};