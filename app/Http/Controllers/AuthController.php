<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function viewregister()
    {
        return view('register');
    }

    public function inRegister(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        if (empty($name) || empty($email) || empty($password)) {
            return back()->withErrors([
                'register' => 'Semua field wajib diisi.',
            ]);
        }

        session(['user' => [
            'name' => $name,
            'email' => $email,
        ]]);

        return redirect('/dashboard');
    }

    public function viewLogin()
    {
        return view('login');
    }

    public function inLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if ($email === 'admin@example.com' && $password === 'admin123') {
            session(['user' => ['role' => 'admin', 'email' => $email]]);
            return redirect('/admin/dashboard');
        } elseif ($email === 'user@example.com' && $password === 'user123') {
            session(['user' => ['role' => 'user', 'email' => $email]]);
            return redirect('/dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}

