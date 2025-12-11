<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk membuat tabel users.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->string('nomor_hp', 15)->nullable(); // No HP (nullable agar tidak wajib diisi admin seeder)
            $table->text('alamat')->nullable();         // Alamat (text untuk tulisan panjang)
            $table->date('tanggal_lahir')->nullable();  // Format Tanggal
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Batalkan migrasi (hapus tabel users).
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
