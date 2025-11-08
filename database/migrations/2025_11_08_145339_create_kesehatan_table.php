<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('kesehatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hewan_id')->nullable()->constrained('hewan')->onDelete('cascade');
            $table->string('vaksin', 100)->nullable();
            $table->string('penyakit', 100)->nullable();
            $table->date('tanggal_cek')->nullable();
        });
    }

    public function down(): void {
        Schema::dropIfExists('kesehatan');
    }
};
