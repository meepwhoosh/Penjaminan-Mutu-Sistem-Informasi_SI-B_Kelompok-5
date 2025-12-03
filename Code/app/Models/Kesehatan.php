<?php

// app/Models/Kesehatan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kesehatan extends Model
{
    use HasFactory;

    protected $table = 'kesehatan'; 

    protected $fillable = [
        'hewan_id',
        'vaksin',
        'penyakit',
        'tanggal_cek', // atau tanggal_created
        // Tambahkan kolom lain jika ada, seperti 'catatan_alergi'
    ];
}