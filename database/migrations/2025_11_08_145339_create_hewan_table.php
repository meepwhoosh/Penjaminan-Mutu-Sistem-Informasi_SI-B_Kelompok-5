<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('hewan', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('jenis', 50);
            $table->string('ras', 50)->nullable();
            $table->integer('usia')->nullable();
            $table->string('foto', 255)->nullable();
            $table->enum('status', ['tersedia', 'diadopsi'])->default('tersedia');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('hewan');
    }
};
