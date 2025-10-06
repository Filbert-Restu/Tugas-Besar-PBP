<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Jika sudah login, alihkan ke halaman HOME
                if (Auth::user()->role == 'admin') {
                        // Jika admin, alihkan ke dashboard admin
                    return redirect('/admin/dashboard');
                } else if (Auth::user()->role == 'user') {
                    // Jika bukan admin (dianggap user biasa), alihkan ke dashboard user
                    return redirect('/');
                }
            }
        }

        return $next($request);
    }
}
