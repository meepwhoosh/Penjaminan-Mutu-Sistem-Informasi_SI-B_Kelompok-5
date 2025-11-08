<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HewanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('hewan')->insert([
            ['id' => 1, 'nama' => 'milo', 'jenis' => 'kucing', 'ras' => 'persia', 'usia' => 4, 'foto' => 'milo.jpeg', 'status' => 'tersedia'],
            ['id' => 2, 'nama' => 'bobby', 'jenis' => 'anjing', 'ras' => 'golden retriever', 'usia' => 4, 'foto' => 'bobby.jpeg', 'status' => 'tersedia'],
            ['id' => 3, 'nama' => 'luna', 'jenis' => 'kucing', 'ras' => 'anggora', 'usia' => 3, 'foto' => 'luna.jpeg', 'status' => 'tersedia'],
            ['id' => 4, 'nama' => 'rocky', 'jenis' => 'anjing', 'ras' => 'bulldog', 'usia' => 2, 'foto' => 'rocky.jpeg', 'status' => 'tersedia'],
            ['id' => 5, 'nama' => 'rio', 'jenis' => 'anjing', 'ras' => 'beagle', 'usia' => 2, 'foto' => 'rio.jpeg', 'status' => 'tersedia'],
        ]);
    }
}
