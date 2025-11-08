<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            HewanSeeder::class,
            KesehatanSeeder::class,
            AdopsiSeeder::class,
            LaporanAdopsiSeeder::class,
        ]);
    }
}
