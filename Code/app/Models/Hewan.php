<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hewan extends Model
{
    use HasFactory;

    protected $table = 'hewan';

    protected $fillable = [
        'nama',
        'jenis',
        'ras',
        'deskripsi',
        'usia',
        'gender',
        'warna',
        'kepribadian',
        'foto',
        'status',
    ];
    public function kesehatan()
    {
        return $this->hasMany(Kesehatan::class, 'hewan_id');
    }
}
