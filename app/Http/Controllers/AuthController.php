<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function viewRegister() {
        return view('auth.register');
    }

    public function inRegister(Request $request) {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users',
            'password' => ['required', Password::defaults()],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
        ]);

        return redirect()->route('login');
    }

    public function viewLogin() {
        return view('auth.login');
    }

    public function inLogin(Request $request) {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // -- MULAI MODIFIKASI --
            // Cek role user yang sedang login
            if (Auth::user()->role == 'admin') {
                // Jika role adalah admin, arahkan ke dashboard admin
                return redirect()->intended('/admin/dashboard');
            } else if (Auth::user()->role == 'user') {
                // Jika role adalah user biasa, arahkan ke dashboard user
                return redirect()->intended('/');
            } else {
                // Jika role tidak dikenali, arahkan ke halaman login dengan pesan error
                return redirect()->route('login')->withErrors([
                    'email' => 'Role user tidak dikenali.',
                ]);
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
