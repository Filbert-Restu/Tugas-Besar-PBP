<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
        // default bawaan
        'auth' => \App\Http\Middleware\Authenticate::class,

        // tambahkan ini
        'is_admin' => \App\Http\Middleware\IsAdmin::class,
    ];

}
