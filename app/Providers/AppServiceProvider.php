<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Password::defaults(function () {
            return Password::min(10)          // Minimal 10 karakter.
                           ->mixedCase()      // Wajib ada huruf besar dan kecil.
                           ->numbers()        // Wajib ada angka.
                           ->symbols()        // Wajib ada simbol.
                           ->uncompromised(); // Cek di database password yang pernah bocor.
        });

        View::composer('*', function ($view) {
            // Inisialisasi variabel untuk jumlah item di keranjang
            $userCartQty = 0;
            if (Auth::check()) {
                $userCartQty = DB::table('carts')
                    ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
                    ->where('carts.user_id', Auth::id()) // <-- KONDISI PENTING YANG HILANG
                    ->where('carts.status', 'active') // Ini opsional, tergantung logika bisnis Anda
                    ->sum('cart_items.qty');

                // Gunakan nama variabel yang lebih deskriptif
                $view->with('userCartQty', $userCartQty);
            }
        });
    }
}
