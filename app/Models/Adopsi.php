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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hewan()
    {
        return $this->belongsTo(Hewan::class);
    }
}
