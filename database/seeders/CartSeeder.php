<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\CartItem;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cart 1 - Siti Nurhaliza (user_id: 4)
        $cart1 = Cart::create(['user_id' => 4, 'status' => 'active']);
        CartItem::create(['cart_id' => $cart1->id, 'product_id' => 2, 'qty' => 1]);
        CartItem::create(['cart_id' => $cart1->id, 'product_id' => 9, 'qty' => 3]);

        // Cart 2 - Maya Putri (user_id: 8)
        $cart2 = Cart::create(['user_id' => 8, 'status' => 'active']);
        CartItem::create(['cart_id' => $cart2->id, 'product_id' => 4, 'qty' => 1]);
        CartItem::create(['cart_id' => $cart2->id, 'product_id' => 3, 'qty' => 1]);
        CartItem::create(['cart_id' => $cart2->id, 'product_id' => 23, 'qty' => 2]);

        // Cart 3 - Andi Wijaya (user_id: 9)
        $cart3 = Cart::create(['user_id' => 9, 'status' => 'active']);
        CartItem::create(['cart_id' => $cart3->id, 'product_id' => 18, 'qty' => 1]);
        CartItem::create(['cart_id' => $cart3->id, 'product_id' => 13, 'qty' => 1]);
        CartItem::create(['cart_id' => $cart3->id, 'product_id' => 15, 'qty' => 2]);

        // Cart 4 - Dewi Sartika (user_id: 10)
        $cart4 = Cart::create(['user_id' => 10, 'status' => 'active']);
        CartItem::create(['cart_id' => $cart4->id, 'product_id' => 5, 'qty' => 1]);
        CartItem::create(['cart_id' => $cart4->id, 'product_id' => 7, 'qty' => 1]);

        // Cart 5 - Rudi Hartono (user_id: 11)
        $cart5 = Cart::create(['user_id' => 11, 'status' => 'active']);
        CartItem::create(['cart_id' => $cart5->id, 'product_id' => 2, 'qty' => 1]);
        CartItem::create(['cart_id' => $cart5->id, 'product_id' => 24, 'qty' => 1]);
        CartItem::create(['cart_id' => $cart5->id, 'product_id' => 22, 'qty' => 2]);

        // Cart 6 - Ahmad Dhani (user_id: 5) - Already ordered
        $cart6 = Cart::create(['user_id' => 5, 'status' => 'ordered']);
        CartItem::create(['cart_id' => $cart6->id, 'product_id' => 5, 'qty' => 1]);
        CartItem::create(['cart_id' => $cart6->id, 'product_id' => 17, 'qty' => 1]);
        CartItem::create(['cart_id' => $cart6->id, 'product_id' => 16, 'qty' => 1]);
    }
}
