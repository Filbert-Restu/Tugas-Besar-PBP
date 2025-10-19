<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Elektronik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fashion',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Makanan & Minuman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kesehatan & Kecantikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Olahraga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rumah Tangga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Buku & Alat Tulis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mainan & Hobi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Category::insert($categories);
    }
}
