<?php

namespace App\Providers;

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
    }
}
