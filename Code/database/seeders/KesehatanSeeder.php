<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KesehatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kesehatan')->insert([
    ['hewan_id' => 1, 'vaksin' => 'vaksin rabies', 'penyakit' => 'tidak ada', 'tanggal_cek' => '2024-12-01'],
    ['hewan_id' => 2, 'vaksin' => 'vaksin parvo', 'penyakit' => 'flu ringan', 'tanggal_cek' => '2024-12-02'],
    ['hewan_id' => 3, 'vaksin' => 'vaksin kombinasi', 'penyakit' => 'tidak ada', 'tanggal_cek' => '2024-12-03'],
    ['hewan_id' => 4, 'vaksin' => 'vaksin DHLPP', 'penyakit' => 'alergi ringan', 'tanggal_cek' => '2024-12-04'],
    ['hewan_id' => 5, 'vaksin' => 'tidak divaksin', 'penyakit' => 'infeksi ringan', 'tanggal_cek' => '2024-12-05'],
]);

    }
}
