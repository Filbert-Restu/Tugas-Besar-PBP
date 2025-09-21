@extends('layouts.app')

@section('title', 'Landing Page')

@section('content')
<div class="text-center py-12">
    <h1 class="text-4xl font-bold text-blue-600 mb-4">
        Selamat Datang di UMKM Mini-Commerce
    </h1>
    <p class="text-gray-600 mb-6">
        Belanja produk UMKM lokal dengan mudah, aman, dan cepat.
    </p>
    <div class="space-x-4">
        <a href="{{ route('products.index') }}" 
           class="bg-blue-500 text-white px-4 py-2 rounded">Lihat Produk</a>
        @guest
            <a href="{{ route('login') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Login</a>
            <a href="{{ route('register') }}" class="bg-green-500 text-white px-4 py-2 rounded">Register</a>
        @endguest
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="bg-red-500 text-white px-4 py-2 rounded">Admin Dashboard</a>
            @else
                <a href="{{ route('user.dashboard') }}" class="bg-yellow-500 text-white px-4 py-2 rounded">User Dashboard</a>
            @endif
        @endauth
    </div>
</div>
@endsection
