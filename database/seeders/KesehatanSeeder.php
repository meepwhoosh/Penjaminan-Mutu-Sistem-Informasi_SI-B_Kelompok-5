<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KesehatanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kesehatan')->insert([
            ['id' => 1, 'hewan_id' => 1, 'vaksin' => 'vaksing rabies', 'penyakit' => 'tidak ada', 'tanggal_cek' => '2024-12-01'],
            ['id' => 2, 'hewan_id' => 2, 'vaksin' => 'vaksin parvo', 'penyakit' => 'flu ringan', 'tanggal_cek' => '2024-12-02'],
            ['id' => 3, 'hewan_id' => 3, 'vaksin' => 'vaksin kombinasi', 'penyakit' => 'tidak ada', 'tanggal_cek' => '2024-12-03'],
            ['id' => 4, 'hewan_id' => 4, 'vaksin' => 'vaksin DHLPP', 'penyakit' => 'alergi ringan', 'tanggal_cek' => '2024-12-04'],
            ['id' => 5, 'hewan_id' => 5, 'vaksin' => 'tidak divaksin', 'penyakit' => 'infeksi ringan', 'tanggal_cek' => '2024-12-05'],
        ]);
    }
}
