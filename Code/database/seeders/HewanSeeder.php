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
            // Row 1
            ['nama' => 'Kopi', 'jenis' => 'kucing', 'ras' => 'Tabby Cat', 'usia' => '2 years', 'gender' => 'jantan', 'foto' => '1.jpeg', 'status' => 'tersedia'],
            ['nama' => 'Milo', 'jenis' => 'anjing', 'ras' => 'Cocker Spaniel English', 'usia' => '2 years', 'gender' => 'jantan', 'foto' => '8.jpeg', 'status' => 'tersedia'],
            ['nama' => 'Luna', 'jenis' => 'kucing', 'ras' => 'Birman Cat', 'usia' => '5 months', 'gender' => 'betina', 'foto' => '4.jpeg', 'status' => 'tersedia'],
            ['nama' => 'Bella', 'jenis' => 'anjing', 'ras' => 'Border Collie', 'usia' => '1,5 years', 'gender' => 'betina', 'foto' => '9.jpeg', 'status' => 'tersedia'],
            
            // Row 2
            ['nama' => 'Kiri', 'jenis' => 'kucing', 'ras' => 'Domestic Cat', 'usia' => '6 months', 'gender' => 'jantan', 'foto' => '5.jpeg', 'status' => 'tersedia'],
            ['nama' => 'Mocha', 'jenis' => 'anjing', 'ras' => 'Shiba Inu', 'usia' => '2 years', 'gender' => 'jantan', 'foto' => '7.jpeg', 'status' => 'tersedia'],
            ['nama' => 'Choco', 'jenis' => 'anjing', 'ras' => 'Pomeranian', 'usia' => '2,5 years', 'gender' => 'betina', 'foto' => '10.jpeg', 'status' => 'tersedia'],
            ['nama' => 'Sora', 'jenis' => 'kucing', 'ras' => 'Birman Cat', 'usia' => '1,5 years', 'gender' => 'betina', 'foto' => '2.jpeg', 'status' => 'tersedia'],
            
            // Row 3
            ['nama' => 'Oreo', 'jenis' => 'anjing', 'ras' => 'Dalmatian', 'usia' => '1 years', 'gender' => 'jantan', 'foto' => '12.jpeg', 'status' => 'tersedia'],
            ['nama' => 'Biskuit', 'jenis' => 'kucing', 'ras' => 'Abisinia Cat', 'usia' => '3 years', 'gender' => 'betina', 'foto' => '6.jpeg', 'status' => 'tersedia'],
            ['nama' => 'Niko', 'jenis' => 'kucing', 'ras' => 'Domestic Longhair', 'usia' => '4 months', 'gender' => 'jantan', 'foto' => '3.jpeg', 'status' => 'tersedia'],
            ['nama' => 'Taro', 'jenis' => 'anjing', 'ras' => 'Toy Poodle', 'usia' => '3 years', 'gender' => 'jantan', 'foto' => '11.jpeg', 'status' => 'tersedia'],
        ]);
    }
}