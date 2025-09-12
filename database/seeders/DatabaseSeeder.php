<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ====== Default Admin User ======
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // ====== Default Normal User ======
        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'User Biasa',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );

        // ====== Categories ======
        $categories = [
            'Elektronik',
            'Furniture',
            'Fashion'
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['name' => $cat]);
        }

        // ====== Products ======
        $products = [
            ['name' => 'Laptop Asus', 'price' => 12000000, 'stock' => 10, 'category' => 'Elektronik'],
            ['name' => 'iPhone 15', 'price' => 18000000, 'stock' => 5, 'category' => 'Elektronik'],
            ['name' => 'Meja Belajar', 'price' => 1500000, 'stock' => 20, 'category' => 'Furniture'],
            ['name' => 'Kursi Gaming', 'price' => 2500000, 'stock' => 15, 'category' => 'Furniture'],
            ['name' => 'Sepatu Nike', 'price' => 900000, 'stock' => 30, 'category' => 'Fashion'],
            ['name' => 'Kaos Polos', 'price' => 75000, 'stock' => 50, 'category' => 'Fashion'],
        ];

        foreach ($products as $p) {
            $category = Category::where('name', $p['category'])->first();

            Product::firstOrCreate(
                ['name' => $p['name']],
                [
                    'price' => $p['price'],
                    'stock' => $p['stock'],
                    'category_id' => $category->id,
                    'is_active' => true,
                ]
            );
        }
    }
}
