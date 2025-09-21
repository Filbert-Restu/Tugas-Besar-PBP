<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;

class OrdersTableSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'user@example.com')->first();
        $product = Product::first();

        if ($user && $product) {
            $order = Order::create([
                'user_id' => $user->id,
                'total' => $product->price * 2,
                'status' => 'pending',
                'address_text' => $user->address,
                'payment_status' => 'unpaid',
                'payment_method' => 'transfer',
                'shipping_status' => 'pending',
                'tracking_number' => null,
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'price' => $product->price,
                'qty' => 2,
                'subtotal' => $product->price * 2,
            ]);
        }
    }
}
