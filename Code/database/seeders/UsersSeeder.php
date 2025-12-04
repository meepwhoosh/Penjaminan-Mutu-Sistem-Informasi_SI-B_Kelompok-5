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
                'name'       => 'Annisa',
                'email'      => 'annisa@gmail.com',
                'password'   => Hash::make('annisa12345'),
                'role'       => 'user'
            ],
            [
                'name'       => 'Dian',
                'email'      => 'dian@gmail.com',
                'password'   => Hash::make('dian12345'),
                'role'       => 'user'
            ],
            [
                'name'       => 'Sofia',
                'email'      => 'sofia@gmail.com',
                'password'   => Hash::make('sofia12345'),
                'role'       => 'user'
            ],
            [
                'name'       => 'Dede',
                'email'      => 'dede@gmail.com',
                'password'   => Hash::make('dede12345'),
                'role'       => 'user'
            ],
            [
                'name'       => 'Aura',
                'email'      => 'aura@gmail.com',
                'password'   => Hash::make('aura12345'),
                'role'       => 'user'
            ],
        ]);
    }
}
