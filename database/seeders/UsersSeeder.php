<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'first_name' => 'Annisa',
                'last_name'  => '',
                'email'      => 'annisa@gmail.com',
                'password'   => Hash::make('annisa12345'),
                'role'       => 'user'
            ],
            [
                'first_name' => 'Dian',
                'last_name'  => '',
                'email'      => 'dian@gmail.com',
                'password'   => Hash::make('dian12345'),
                'role'       => 'user'
            ],
            [
                'first_name' => 'Sofia',
                'last_name'  => '',
                'email'      => 'sofia@gmail.com',
                'password'   => Hash::make('sofia12345'),
                'role'       => 'user'
            ],
            [
                'first_name' => 'Dede',
                'last_name'  => '',
                'email'      => 'dede@gmail.com',
                'password'   => Hash::make('dede12345'),
                'role'       => 'user'
            ],
            [
                'first_name' => 'Aura',
                'last_name'  => '',
                'email'      => 'aura@gmail.com',
                'password'   => Hash::make('aura12345'),
                'role'       => 'user'
            ],
        ]);
    }
}
