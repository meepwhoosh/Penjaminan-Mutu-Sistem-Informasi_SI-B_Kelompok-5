<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdopsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('adopsi')->insert([
    ['user_id' => 1, 'hewan_id' => 1, 'tanggal_adopsi' => '2025-01-05', 'status' => 'pending'],
    ['user_id' => 2, 'hewan_id' => 2, 'tanggal_adopsi' => '2025-01-06', 'status' => 'diterima'],
    ['user_id' => 3, 'hewan_id' => 3, 'tanggal_adopsi' => '2025-01-07', 'status' => 'selesai'],
    ['user_id' => 4, 'hewan_id' => 4, 'tanggal_adopsi' => '2025-01-08', 'status' => 'ditolak'],
    ['user_id' => 5, 'hewan_id' => 5, 'tanggal_adopsi' => '2025-01-09', 'status' => 'pending'],
]);

    }
}
