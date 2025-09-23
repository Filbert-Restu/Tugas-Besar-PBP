<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin Demo',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]
        );

        // User
        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'User Demo',
                'password' => Hash::make('user123'),
                'role' => 'user'
            ]
        );
    }
}
