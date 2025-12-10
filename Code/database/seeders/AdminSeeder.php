<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $email = 'admin@example.com';

        if (User::where('email', $email)->exists()) {
            $this->command->info('Admin user already exists: ' . $email);
            return;
        }

        User::create([
            'first_name' => 'Admin',
            'last_name'  => 'System',
            'email' => $email,
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $this->command->info('Admin user created: ' . $email . ' (password: password)');
    }
}
