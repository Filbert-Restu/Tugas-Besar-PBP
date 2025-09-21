@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
    <p class="text-gray-700 mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
    <p class="mb-6">{{ $product->description }}</p>

    @auth
        <form action="{{ route('cart.add', $product->id) }}" method="POST">
            @csrf
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                Tambah ke Cart
            </button>
        </form>
    @endauth

    @guest
        <button onclick="openLoginModal()" 
                class="bg-gray-500 text-white px-4 py-2 rounded">
            Tambah ke Cart
        </button>
    @endguest
</div>

<!-- Modal untuk Guest -->
<div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg w-80 text-center">
        <h2 class="text-lg font-bold mb-4">Login Diperlukan</h2>
        <p class="mb-4">Untuk menambahkan ke keranjang, silakan login atau buat akun terlebih dahulu.</p>
        
        <div class="flex flex-col space-y-2">
            <a href="{{ route('login') }}" 
               class="bg-blue-500 text-white px-4 py-2 rounded">Login</a>
            <a href="{{ route('register') }}" 
               class="bg-green-500 text-white px-4 py-2 rounded">Register</a>
            <button onclick="closeLoginModal()" 
                    class="bg-gray-400 text-white px-4 py-2 rounded">Nanti Saja</button>
        </div>
    </div>
</div>

<script>
    function openLoginModal() {
        document.getElementById('loginModal').classList.remove('hidden');
        document.getElementById('loginModal').classList.add('flex');
    }
    function closeLoginModal() {
        document.getElementById('loginModal').classList.add('hidden');
    }
</script>
@endsection
