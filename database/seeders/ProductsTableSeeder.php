<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Laptop Asus', 'price' => 7500000, 'stock' => 5, 'category' => 'Elektronik', 'image' => 'laptop.jpg'],
            ['name' => 'iPhone 15', 'price' => 18000000, 'stock' => 3, 'category' => 'Elektronik', 'image' => 'iphone.jpg'],
            ['name' => 'Meja Belajar', 'price' => 500000, 'stock' => 10, 'category' => 'Furniture', 'image' => 'meja.jpg'],
            ['name' => 'Kursi Gaming', 'price' => 1200000, 'stock' => 6, 'category' => 'Furniture', 'image' => 'kursi.jpg'],
            ['name' => 'Sepatu Nike', 'price' => 850000, 'stock' => 8, 'category' => 'Fashion', 'image' => 'sepatu.jpg'],
            ['name' => 'Kaos Polos', 'price' => 100000, 'stock' => 15, 'category' => 'Fashion', 'image' => 'kaos.jpg'],
        ];

        foreach ($products as $p) {
            $cat = Category::firstOrCreate(['name' => $p['category']]);
            Product::updateOrCreate(
                ['name' => $p['name']],
                [
                    'price' => $p['price'],
                    'stock' => $p['stock'],
                    'category_id' => $cat->id,
                    'is_active' => true,
                ]
            );
        }
    }
}
