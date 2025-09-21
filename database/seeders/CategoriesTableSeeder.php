<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Elektronik', 'Furniture', 'Fashion', 'Makanan', 'Aksesoris'];

        foreach ($categories as $c) {
            Category::updateOrCreate(['name' => $c], ['name' => $c]);
        }
    }
}
