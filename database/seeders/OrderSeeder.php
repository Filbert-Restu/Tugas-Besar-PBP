<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Order 1 - Budi Santoso (user_id: 3)
        $order1 = Order::create([
            'user_id' => 3,
            'total' => 19313000,
            'status' => 'completed',
            'address_text' => 'Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta 10220',
            'payment_status' => 'paid',
            'payment_method' => 'credit_card',
            'shipping_status' => 'delivered',
        ]);
        OrderItem::create(['order_id' => $order1->id, 'product_id' => 1, 'price' => 18999000, 'qty' => 1, 'subtotal' => 18999000]);
        OrderItem::create(['order_id' => $order1->id, 'product_id' => 22, 'price' => 125000, 'qty' => 1, 'subtotal' => 125000]);
        OrderItem::create(['order_id' => $order1->id, 'product_id' => 14, 'price' => 189000, 'qty' => 1, 'subtotal' => 189000]);

        // Order 2 - Siti Nurhaliza (user_id: 4)
        $order2 = Order::create([
            'user_id' => 4,
            'total' => 7349000,
            'status' => 'shipped',
            'address_text' => 'Jl. Gatot Subroto Kav. 45, Jakarta Selatan, DKI Jakarta 12190',
            'payment_status' => 'paid',
            'payment_method' => 'bank_transfer',
            'shipping_status' => 'shipped',
        ]);
        OrderItem::create(['order_id' => $order2->id, 'product_id' => 3, 'price' => 5499000, 'qty' => 1, 'subtotal' => 5499000]);
        OrderItem::create(['order_id' => $order2->id, 'product_id' => 13, 'price' => 1850000, 'qty' => 1, 'subtotal' => 1850000]);

        // Order 3 - Ahmad Dhani (user_id: 5)
        $order3 = Order::create([
            'user_id' => 5,
            'total' => 3533000,
            'status' => 'processing',
            'address_text' => 'Jl. HR Rasuna Said Blok X-5, Jakarta Selatan, DKI Jakarta 12950',
            'payment_status' => 'paid',
            'payment_method' => 'e_wallet',
            'shipping_status' => 'processing',
        ]);
        OrderItem::create(['order_id' => $order3->id, 'product_id' => 5, 'price' => 2899000, 'qty' => 1, 'subtotal' => 2899000]);
        OrderItem::create(['order_id' => $order3->id, 'product_id' => 17, 'price' => 249000, 'qty' => 1, 'subtotal' => 249000]);
        OrderItem::create(['order_id' => $order3->id, 'product_id' => 16, 'price' => 385000, 'qty' => 1, 'subtotal' => 385000]);

        // Order 4 - Rina Wijaya (user_id: 6)
        $order4 = Order::create([
            'user_id' => 6,
            'total' => 17537000,
            'status' => 'completed',
            'address_text' => 'Jl. Thamrin No. 88, Jakarta Pusat, DKI Jakarta 10350',
            'payment_status' => 'paid',
            'payment_method' => 'credit_card',
            'shipping_status' => 'delivered',
        ]);
        OrderItem::create(['order_id' => $order4->id, 'product_id' => 2, 'price' => 16999000, 'qty' => 1, 'subtotal' => 16999000]);
        OrderItem::create(['order_id' => $order4->id, 'product_id' => 23, 'price' => 349000, 'qty' => 1, 'subtotal' => 349000]);
        OrderItem::create(['order_id' => $order4->id, 'product_id' => 24, 'price' => 189000, 'qty' => 1, 'subtotal' => 189000]);

        // Order 5 - Dedi Kurniawan (user_id: 7)
        $order5 = Order::create([
            'user_id' => 7,
            'total' => 17297000,
            'status' => 'pending',
            'address_text' => 'Jl. Kuningan Mulia Kav. 26, Jakarta Selatan, DKI Jakarta 12920',
            'payment_status' => 'unpaid',
            'payment_method' => null,
            'shipping_status' => 'pending',
        ]);
        OrderItem::create(['order_id' => $order5->id, 'product_id' => 21, 'price' => 12999000, 'qty' => 1, 'subtotal' => 12999000]);
        OrderItem::create(['order_id' => $order5->id, 'product_id' => 18, 'price' => 2499000, 'qty' => 1, 'subtotal' => 2499000]);
        OrderItem::create(['order_id' => $order5->id, 'product_id' => 19, 'price' => 1799000, 'qty' => 1, 'subtotal' => 1799000]);

        // Order 6 - Maya Putri (user_id: 8)
        $order6 = Order::create([
            'user_id' => 8,
            'total' => 4496000,
            'status' => 'processing',
            'address_text' => 'Jl. Senopati Raya No. 56, Jakarta Selatan, DKI Jakarta 12190',
            'payment_status' => 'paid',
            'payment_method' => 'bank_transfer',
            'shipping_status' => 'processing',
        ]);
        OrderItem::create(['order_id' => $order6->id, 'product_id' => 7, 'price' => 2599000, 'qty' => 1, 'subtotal' => 2599000]);
        OrderItem::create(['order_id' => $order6->id, 'product_id' => 6, 'price' => 1299000, 'qty' => 1, 'subtotal' => 1299000]);
        OrderItem::create(['order_id' => $order6->id, 'product_id' => 8, 'price' => 299000, 'qty' => 2, 'subtotal' => 598000]);

        // Order 7 - Andi Wijaya (user_id: 9)
        $order7 = Order::create([
            'user_id' => 9,
            'total' => 6393000,
            'status' => 'shipped',
            'address_text' => 'Jl. Kemang Raya No. 78, Jakarta Selatan, DKI Jakarta 12730',
            'payment_status' => 'paid',
            'payment_method' => 'credit_card',
            'shipping_status' => 'shipped',
        ]);
        OrderItem::create(['order_id' => $order7->id, 'product_id' => 3, 'price' => 5499000, 'qty' => 1, 'subtotal' => 5499000]);
        OrderItem::create(['order_id' => $order7->id, 'product_id' => 23, 'price' => 349000, 'qty' => 1, 'subtotal' => 349000]);
        OrderItem::create(['order_id' => $order7->id, 'product_id' => 15, 'price' => 245000, 'qty' => 1, 'subtotal' => 245000]);
        OrderItem::create(['order_id' => $order7->id, 'product_id' => 8, 'price' => 299000, 'qty' => 1, 'subtotal' => 299000]);

        // Order 8 - Dewi Sartika (user_id: 10)
        $order8 = Order::create([
            'user_id' => 10,
            'total' => 2286000,
            'status' => 'completed',
            'address_text' => 'Jl. Cikini Raya No. 34, Jakarta Pusat, DKI Jakarta 10330',
            'payment_status' => 'paid',
            'payment_method' => 'e_wallet',
            'shipping_status' => 'delivered',
        ]);
        OrderItem::create(['order_id' => $order8->id, 'product_id' => 10, 'price' => 275000, 'qty' => 3, 'subtotal' => 825000]);
        OrderItem::create(['order_id' => $order8->id, 'product_id' => 16, 'price' => 385000, 'qty' => 1, 'subtotal' => 385000]);
        OrderItem::create(['order_id' => $order8->id, 'product_id' => 14, 'price' => 189000, 'qty' => 2, 'subtotal' => 378000]);
        OrderItem::create(['order_id' => $order8->id, 'product_id' => 23, 'price' => 349000, 'qty' => 2, 'subtotal' => 698000]);

        // Order 9 - Rudi Hartono (user_id: 11)
        $order9 = Order::create([
            'user_id' => 11,
            'total' => 14498000,
            'status' => 'cancelled',
            'address_text' => 'Jl. Menteng Raya No. 90, Jakarta Pusat, DKI Jakarta 10340',
            'payment_status' => 'refunded',
            'payment_method' => 'credit_card',
            'shipping_status' => 'cancelled',
        ]);
        OrderItem::create(['order_id' => $order9->id, 'product_id' => 4, 'price' => 13999000, 'qty' => 1, 'subtotal' => 13999000]);
        OrderItem::create(['order_id' => $order9->id, 'product_id' => 24, 'price' => 189000, 'qty' => 1, 'subtotal' => 189000]);
        OrderItem::create(['order_id' => $order9->id, 'product_id' => 10, 'price' => 275000, 'qty' => 1, 'subtotal' => 275000]);

        // Order 10 - Budi Santoso (2nd order, user_id: 3)
        $order10 = Order::create([
            'user_id' => 3,
            'total' => 1533000,
            'status' => 'processing',
            'address_text' => 'Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta 10220',
            'payment_status' => 'paid',
            'payment_method' => 'bank_transfer',
            'shipping_status' => 'processing',
        ]);
        OrderItem::create(['order_id' => $order10->id, 'product_id' => 16, 'price' => 899000, 'qty' => 1, 'subtotal' => 899000]);
        OrderItem::create(['order_id' => $order10->id, 'product_id' => 17, 'price' => 249000, 'qty' => 2, 'subtotal' => 498000]);
        OrderItem::create(['order_id' => $order10->id, 'product_id' => 11, 'price' => 145000, 'qty' => 1, 'subtotal' => 145000]);
    }
}
