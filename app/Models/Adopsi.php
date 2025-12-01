<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adopsi extends Model
{
    use HasFactory;

    protected $table = 'adopsi';

    protected $fillable = [
        'user_id',
        'hewan_id',
        'tanggal_adopsi',
        'status',
    ];

    // =========================================================
    // ✅ PENYESUAIAN: MENGGUNAKAN $casts UNTUK TANGGAL/WAKTU
    // =========================================================
    protected $casts = [
        // Mengubah kolom created_at (dari timestamps) menjadi objek Carbon
        'created_at' => 'datetime', 
        // Mengubah kolom tanggal_adopsi menjadi objek Carbon
        'tanggal_adopsi' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // =========================================================
    // ✅ METHOD RELASI (Sudah Benar)
    // =========================================================
    
    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Hewan (Sudah Benar)
    public function hewan()
    {
        return $this->belongsTo(Hewan::class, 'hewan_id', 'id');
    }
    
}