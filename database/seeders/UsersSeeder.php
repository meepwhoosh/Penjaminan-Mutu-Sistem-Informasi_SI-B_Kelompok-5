<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;       // <--- tambahkan baris ini
use Illuminate\Support\Facades\Hash;    // <--- tambahkan juga ini (untuk bcrypt)
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    DB::table('users')->insert([
        ['nama' => 'annisa', 'email' => 'annisa@gmail.com', 'password' => bcrypt('annisa12345'), 'role' => 'user'],
        ['nama' => 'dian', 'email' => 'dian@gmail.com', 'password' => bcrypt('dian12345'), 'role' => 'user'],
        ['nama' => 'sofia', 'email' => 'sofia@gmail.com', 'password' => bcrypt('sofia12345'), 'role' => 'user'],
        ['nama' => 'dede', 'email' => 'dede@gmail.com', 'password' => bcrypt('dede12345'), 'role' => 'user'],
        ['nama' => 'aura', 'email' => 'aura@gmail.com', 'password' => bcrypt('aura12345'), 'role' => 'user'],
        ]);


    }
}
