@extends('layouts.app')

@section('title', 'Checkout - KlikMart')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 text-xs text-gray-600 mb-6">
        <a href="{{ route('cart.index') }}" class="text-teal-600 hover:text-teal-700 font-medium">Keranjang</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <span class="font-medium">Detail</span>
        <i class="fas fa-chevron-right text-xs"></i>
        <span class="text-gray-400">Pengiriman & Pembayaran</span>
    </div>

    <form action="{{ route('cart.checkout.shipping') }}" method="GET">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Forms -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-5">Informasi Pengiriman</h2>

                    <!-- Contact -->
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kontak</label>
                        <div class="flex items-center gap-3">
                            <input type="email" name="email" required placeholder="Email atau No. Telepon" class="flex-1 border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            <span class="text-teal-600 font-medium text-sm cursor-pointer hover:text-teal-700">Login</span>
                        </div>
                    </div>

                    <!-- Delivery Address -->
                    <div class="space-y-4">
                        <h3 class="text-base font-bold text-gray-800 mb-3">Alamat Pengiriman</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <input type="text" name="first_name" required placeholder="Nama Depan" class="border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            <input type="text" name="last_name" required placeholder="Nama Belakang" class="border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                        </div>

                        <input type="text" name="address" required placeholder="Alamat dan No. Telepon" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500">

                        <input type="text" name="notes" placeholder="Catatan (opsional)" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <input type="text" name="city" required placeholder="Kota" class="border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            <select name="province" required class="border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                                <option value="">Provinsi</option>
                                <option value="Jawa Tengah">Jawa Tengah</option>
                                <option value="Jawa Barat">Jawa Barat</option>
                                <option value="Jawa Timur">Jawa Timur</option>
                                <option value="DKI Jakarta">DKI Jakarta</option>
                            </select>
                        </div>

                        <select name="country" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-700 focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            <option value="Indonesia">Indonesia</option>
                        </select>

                        <div class="flex items-center">
                            <input type="checkbox" id="saveInfo" class="w-4 h-4 text-teal-600 rounded focus:ring-1 focus:ring-teal-500 border-gray-300">
                            <label for="saveInfo" class="ml-2 text-xs text-gray-700">Simpan informasi untuk kunjungan selanjutnya</label>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between mt-6 pt-6 border-t">
                        <a href="{{ route('cart.checkout.shipping') }}" class="text-teal-600 hover:text-teal-700 font-medium text-sm">
                            Kembali ke Detail
                        </a>
                        <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white font-semibold px-6 py-2.5 rounded-lg text-sm transition">
                            Pergi ke Pengiriman
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Column - Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm p-5 sticky top-20">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Produk Dipesan</h3>

                    <!-- Product Items -->
                    <div class="space-y-3">
                    @foreach($CheckoutItems as $item)
                    <div class="flex items-start space-x-3 pb-3 border-b last:border-0">
                        <div class="relative flex-shrink-0">
                            <div class="w-16 h-16 bg-gradient-to-br {{ $item['product']['gradient'] }} rounded-lg flex items-center justify-center">
                                <i class="fas {{ $item->icon }} text-xl {{ $item->icon_color }}"></i>
                            </div>
                            <span class="absolute -top-1 -right-1 bg-teal-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-semibold">{{ $item->quantity }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-gray-800 text-sm truncate">{{ $item->name }}</h4>
                            <p class="text-xs text-gray-500">Rp{{ number_format($item->price, 0, ',', '.') }} x {{ $item->quantity }}</p>
                        </div>
                        <div class="font-bold text-gray-800 text-sm">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</div>
                    </div>
                    @endforeach
                    </div>

                    <!-- Summary Details -->
                    <div class="space-y-2 py-3">
                        <div class="flex justify-between text-gray-700 text-sm">
                            <span>Subtotal</span>
                            <span class="font-medium">Rp 10</span>
                        </div>
                        <div class="flex justify-between text-gray-700 text-sm">
                            <span>Jumlah Item</span>
                            <span class="font-medium">10</span>
                        </div>
                        <div class="flex justify-between text-gray-700 text-sm">
                            <span>Pengiriman</span>
                            <span class="font-medium text-teal-600">Gratis</span>
                        </div>
                    </div>

                    <div class="border-t pt-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-bold text-gray-800">Total Pesanan</span>
                            <span class="text-xl font-bold text-teal-600">Rp 10</span>
                        </div>
                        <p class="text-xs text-gray-500 text-right mt-1">10 Item</p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
