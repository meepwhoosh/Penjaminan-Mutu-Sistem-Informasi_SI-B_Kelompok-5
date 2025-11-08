<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdopsiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('adopsi')->insert([
            ['id' => 1, 'user_id' => 1, 'hewan_id' => 1, 'tanggal_adopsi' => '2025-01-05', 'status' => 'pending'],
            ['id' => 2, 'user_id' => 2, 'hewan_id' => 2, 'tanggal_adopsi' => '2025-01-06', 'status' => 'diterima'],
            ['id' => 3, 'user_id' => 3, 'hewan_id' => 3, 'tanggal_adopsi' => '2025-01-07', 'status' => 'selesai'],
            ['id' => 4, 'user_id' => 4, 'hewan_id' => 4, 'tanggal_adopsi' => '2025-01-08', 'status' => 'ditolak'],
            ['id' => 5, 'user_id' => 5, 'hewan_id' => 5, 'tanggal_adopsi' => '2025-01-09', 'status' => 'pending'],
        ]);
    }
}
