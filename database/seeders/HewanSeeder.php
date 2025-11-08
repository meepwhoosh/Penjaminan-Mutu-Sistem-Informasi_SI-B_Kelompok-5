<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class HewanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hewan')->insert([
    ['nama' => 'milo', 'jenis' => 'kucing', 'ras' => 'persia', 'usia' => 4, 'foto' => 'milo.jpeg', 'status' => 'tersedia'],
    ['nama' => 'bobby', 'jenis' => 'anjing', 'ras' => 'golden retriever', 'usia' => 4, 'foto' => 'bobby.jpeg', 'status' => 'tersedia'],
    ['nama' => 'luna', 'jenis' => 'kucing', 'ras' => 'anggora', 'usia' => 3, 'foto' => 'luna.jpeg', 'status' => 'tersedia'],
    ['nama' => 'rocky', 'jenis' => 'anjing', 'ras' => 'bulldog', 'usia' => 2, 'foto' => 'rocky.jpeg', 'status' => 'tersedia'],
    ['nama' => 'rio', 'jenis' => 'anjing', 'ras' => 'beagle', 'usia' => 2, 'foto' => 'rio.jpeg', 'status' => 'tersedia'],
]);

    }
}
