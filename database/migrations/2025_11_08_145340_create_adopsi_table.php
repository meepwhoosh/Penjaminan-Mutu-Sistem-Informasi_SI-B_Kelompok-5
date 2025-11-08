<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('adopsi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('hewan_id')->nullable()->constrained('hewan')->onDelete('cascade');
            $table->date('tanggal_adopsi')->nullable();
            $table->enum('status', ['pending', 'diterima', 'selesai', 'ditolak'])->default('pending');
        });
    }

    public function down(): void {
        Schema::dropIfExists('adopsi');
    }
};
