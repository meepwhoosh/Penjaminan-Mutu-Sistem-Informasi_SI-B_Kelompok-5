<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('laporan_adopsi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hewan_id')->nullable()->constrained('hewan')->onDelete('cascade');
            $table->foreignId('adopter_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->date('tanggal')->nullable();
            $table->text('catatan')->nullable();
        });
    }

    public function down(): void {
        Schema::dropIfExists('laporan_adopsi');
    }
};
