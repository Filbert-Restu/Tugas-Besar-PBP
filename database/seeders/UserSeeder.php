<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Admin No. 1',
            'city' => 'Jakarta',
            'province' => 'DKI Jakarta',
            'postal_code' => '10110',
        ]);

        // Regular users
        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'phone' => '081234567891',
            'address' => 'Jl. Sudirman No. 123',
            'city' => 'Jakarta Selatan',
            'province' => 'DKI Jakarta',
            'postal_code' => '12190',
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi.santoso@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '081234567892',
            'address' => 'Jl. Gatot Subroto No. 45',
            'city' => 'Bandung',
            'province' => 'Jawa Barat',
            'postal_code' => '40262',
        ]);

        User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'siti.nurhaliza@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '081234567893',
            'address' => 'Jl. Diponegoro No. 78',
            'city' => 'Surabaya',
            'province' => 'Jawa Timur',
            'postal_code' => '60241',
        ]);

        User::create([
            'name' => 'Ahmad Dhani',
            'email' => 'ahmad.dhani@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '081234567894',
            'address' => 'Jl. Ahmad Yani No. 99',
            'city' => 'Semarang',
            'province' => 'Jawa Tengah',
            'postal_code' => '50149',
        ]);

        User::create([
            'name' => 'Rina Wijaya',
            'email' => 'rina.wijaya@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '081234567895',
            'address' => 'Jl. Veteran No. 12',
            'city' => 'Yogyakarta',
            'province' => 'DI Yogyakarta',
            'postal_code' => '55164',
        ]);

        User::create([
            'name' => 'Dedi Kurniawan',
            'email' => 'dedi.kurniawan@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '081234567896',
            'address' => 'Jl. Pahlawan No. 34',
            'city' => 'Malang',
            'province' => 'Jawa Timur',
            'postal_code' => '65122',
        ]);

        User::create([
            'name' => 'Maya Putri',
            'email' => 'maya.putri@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '081234567897',
            'address' => 'Jl. Merdeka No. 56',
            'city' => 'Denpasar',
            'province' => 'Bali',
            'postal_code' => '80119',
        ]);

        User::create([
            'name' => 'Andi Wijaya',
            'email' => 'andi.wijaya@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '081234567898',
            'address' => 'Jl. Sudirman No. 67',
            'city' => 'Medan',
            'province' => 'Sumatera Utara',
            'postal_code' => '20111',
        ]);

        User::create([
            'name' => 'Dewi Sartika',
            'email' => 'dewi.sartika@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '081234567899',
            'address' => 'Jl. Asia Afrika No. 89',
            'city' => 'Makassar',
            'province' => 'Sulawesi Selatan',
            'postal_code' => '90111',
        ]);

        User::create([
            'name' => 'Rudi Hartono',
            'email' => 'rudi.hartono@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '081234567800',
            'address' => 'Jl. Pemuda No. 101',
            'city' => 'Palembang',
            'province' => 'Sumatera Selatan',
            'postal_code' => '30126',
        ]);
    }
}
