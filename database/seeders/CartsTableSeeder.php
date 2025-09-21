<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use App\Models\Product;

class CartsTableSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'user@example.com')->first();
        $product = Product::first();

        if ($user && $product) {
            $cart = Cart::updateOrCreate(
                ['user_id' => $user->id],
                ['status' => 'active']
            );

            CartItem::updateOrCreate(
                ['cart_id' => $cart->id, 'product_id' => $product->id],
                ['qty' => 2]
            );
        }
    }
}
