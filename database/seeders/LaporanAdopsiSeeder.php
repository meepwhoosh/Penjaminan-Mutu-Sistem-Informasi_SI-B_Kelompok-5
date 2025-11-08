<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaporanAdopsiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('laporan_adopsi')->insert([
            ['id' => 1, 'hewan_id' => 1, 'adopter_id' => 1, 'tanggal' => '2025-01-10', 'catatan' => 'hewan diterima dalam kondisi baik'],
            ['id' => 2, 'hewan_id' => 2, 'adopter_id' => 2, 'tanggal' => '2025-01-11', 'catatan' => 'sudah divaksin dan sehat'],
            ['id' => 3, 'hewan_id' => 3, 'adopter_id' => 3, 'tanggal' => '2025-01-12', 'catatan' => 'perlu pengecekan kesehatan lanjutan'],
            ['id' => 4, 'hewan_id' => 4, 'adopter_id' => 4, 'tanggal' => '2025-01-13', 'catatan' => 'adaptasi berjalan baik'],
            ['id' => 5, 'hewan_id' => 5, 'adopter_id' => 5, 'tanggal' => '2025-01-14', 'catatan' => 'tidak ada keluhan'],
        ]);
    }
}
