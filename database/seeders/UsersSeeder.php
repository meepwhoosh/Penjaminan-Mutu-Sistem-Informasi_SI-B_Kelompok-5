<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            ['id' => 1, 'nama' => 'annisa', 'email' => 'annisa@gmail.com', 'password' => bcrypt('annisa12345'), 'role' => 'user'],
            ['id' => 2, 'nama' => 'dian', 'email' => 'dian@gmail.com', 'password' => bcrypt('dian12345'), 'role' => 'user'],
            ['id' => 3, 'nama' => 'sofia', 'email' => 'sofia@gmail.com', 'password' => bcrypt('sofia12345'), 'role' => 'user'],
            ['id' => 4, 'nama' => 'dede', 'email' => 'dede@gmail.com', 'password' => bcrypt('dede12345'), 'role' => 'user'],
            ['id' => 5, 'nama' => 'aura', 'email' => 'aura@gmail.com', 'password' => bcrypt('aura12345'), 'role' => 'user'],
        ]);
    }
}
