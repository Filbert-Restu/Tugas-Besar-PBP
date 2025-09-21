@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Produk UMKM</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($products as $product)
            <div class="border rounded-lg p-4 shadow">
                <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                <p class="text-gray-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <div class="mt-4 flex space-x-2">
                    <a href="{{ route('products.show', $product->id) }}" 
                       class="bg-blue-500 text-white px-3 py-1 rounded">Detail</a>

                    @auth
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded">
                                Tambah ke Cart
                            </button>
                        </form>
                    @endauth

                    @guest
                        <button onclick="openLoginModal()" 
                                class="bg-gray-500 text-white px-3 py-1 rounded">
                            Tambah ke Cart
                        </button>
                    @endguest
                </div>
            </div>
        @endforeach
    </div>
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
