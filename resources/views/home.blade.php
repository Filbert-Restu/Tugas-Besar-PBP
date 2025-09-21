<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Beranda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto p-6">

        <!-- Header dengan keranjang -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Daftar Produk</h1>

            <div class="bg-white p-3 rounded-lg shadow">
                <h2 class="font-semibold mb-2">Keranjang</h2>
                <p class="text-gray-600">Total Item: {{ count($cart) }}</p>
            </div>
        </div>

        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('home') }}" class="flex flex-col md:flex-row gap-4 mb-6 justify-center">
            <input type="text" name="search" placeholder="Cari produk..." value="{{ $search }}"
                   class="w-full md:w-1/3 rounded-lg border-gray-300 shadow-sm">

            <select name="category" class="w-full md:w-1/4 rounded-lg border-gray-300 shadow-sm">
                <option value="">Semua Kategori</option>
                <option value="Elektronik" {{ $category == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                <option value="Furniture" {{ $category == 'Furniture' ? 'selected' : '' }}>Furniture</option>
                <option value="Fashion" {{ $category == 'Fashion' ? 'selected' : '' }}>Fashion</option>
            </select>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                Cari
            </button>
        </form>

        <!-- Daftar Produk -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse ($products as $product)
                <div class="bg-white p-4 rounded-lg shadow flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl font-semibold">{{ $product['name'] }}</h2>
                        <p class="text-gray-500">{{ $product['category'] }}</p>
                    </div>
                    <form method="POST" action="{{ route('cart.add') }}" class="mt-3">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product['id'] }}">
                        <input type="hidden" name="name" value="{{ $product['name'] }}">
                        <input type="hidden" name="category" value="{{ $product['category'] }}">
                        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg">
                            Tambah ke Keranjang
                        </button>
                    </form>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-500">Produk tidak ditemukan</p>
            @endforelse
        </div>
    </div>
</body>
</html>
