<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class products extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Elektronik
            [
                'name' => 'Laptop ASUS Vivobook 14',
                'price' => 9000000.00,
                'stock' => 10,
                'category_id' => 1, // Elektronik
                'is_active' => true,
            ],
            [
                'name' => 'Smartphone Samsung Galaxy A34',
                'price' => 4500000.00,
                'stock' => 15,
                'category_id' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Headphone Sony WH-1000XM5',
                'price' => 5200000.00,
                'stock' => 5,
                'category_id' => 1,
                'is_active' => true,
            ],

            // Furniture
            [
                'name' => 'Meja Belajar Minimalis',
                'price' => 750000.00,
                'stock' => 20,
                'category_id' => 2, // Furniture
                'is_active' => true,
            ],
            [
                'name' => 'Kursi Gaming Rexus',
                'price' => 1800000.00,
                'stock' => 8,
                'category_id' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Lemari Pakaian 3 Pintu',
                'price' => 2500000.00,
                'stock' => 4,
                'category_id' => 2,
                'is_active' => true,
            ],

            // Fashion
            [
                'name' => 'Kaos Polos Uniqlo',
                'price' => 120000.00,
                'stock' => 50,
                'category_id' => 3, // Fashion
                'is_active' => true,
            ],
            [
                'name' => 'Jaket Hoodie Adidas',
                'price' => 650000.00,
                'stock' => 12,
                'category_id' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Sepatu Sneakers Nike Air Force 1',
                'price' => 1500000.00,
                'stock' => 7,
                'category_id' => 3,
                'is_active' => true,
            ],
        ];
        DB::table('products')->insert($products);
    }
}