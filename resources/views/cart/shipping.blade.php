@extends('layout')

@section('title', 'Pengiriman & Pembayaran - KlikMart')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 text-xs text-gray-600 mb-6">
        <a href="{{ route('cart.index') }}" class="text-teal-600 hover:text-teal-700 font-medium">Keranjang</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <a href="{{ route('cart.checkout') }}" class="text-teal-600 hover:text-teal-700 font-medium">Detail</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <span class="font-medium">Pengiriman & Pembayaran</span>
    </div>

    <form action="#" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Shipping & Payment -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <!-- Contact Info -->
                    <div class="mb-5 p-4 bg-gray-50 rounded-lg">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-xs text-gray-600 mb-1">Kontak</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ $customer['email'] ?? 'ipeagrencda@.co.id' }}</p>
                            </div>
                            <a href="{{ route('cart.checkout') }}" class="text-teal-600 hover:text-teal-700 font-medium text-xs">Edit</a>
                        </div>
                    </div>

                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-xs text-gray-600 mb-1">Alamat</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ ($customer['first_name'] ?? 'Jikacohga') }} {{ $customer['last_name'] ?? '' }}</p>
                            </div>
                            <a href="{{ route('cart.checkout') }}" class="text-teal-600 hover:text-teal-700 font-medium text-xs">Edit</a>
                        </div>
                    </div>

                    <!-- Voucher Input -->
                    <div class="mb-6">
                        <div class="flex space-x-2">
                            <input type="text" placeholder="Kode Voucher" class="flex-1 border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                            <button type="button" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium px-5 py-2.5 rounded-lg text-sm transition">
                                Konfirmasi
                            </button>
                        </div>
                    </div>

                    <!-- Shipping Method -->
                    <div class="mb-6">
                        <h3 class="text-base font-bold text-gray-800 mb-3">Metode Pengiriman</h3>
                        <label class="flex items-center justify-between p-4 border-2 border-gray-300 bg-white rounded-lg cursor-pointer hover:border-teal-500 transition">
                            <div class="flex items-center">
                                <input type="radio" name="shipping_method" value="standard" checked class="w-4 h-4 text-teal-600">
                                <span class="ml-3 font-semibold text-gray-800 text-sm">Pengiriman Standar</span>
                            </div>
                            <span class="font-bold text-sm">Gratis</span>
                        </label>
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-6">
                        <h3 class="text-base font-bold text-gray-800 mb-3">Metode Pembayaran</h3>
                        <div class="space-y-3">
                            <label class="flex items-center p-4 border-2 border-gray-300 bg-white rounded-lg cursor-pointer hover:border-teal-500 transition has-[:checked]:border-teal-500 has-[:checked]:bg-teal-50">
                                <input type="radio" name="payment_method" value="cod" checked class="w-4 h-4 text-teal-600">
                                <div class="ml-3 flex-1">
                                    <span class="font-semibold text-gray-800 text-sm block">COD (Cash on Delivery)</span>
                                    <span class="text-xs text-gray-500">Bayar saat barang diterima</span>
                                </div>
                            </label>

                            <label class="flex items-center p-4 border-2 border-gray-300 bg-white rounded-lg cursor-pointer hover:border-teal-500 transition has-[:checked]:border-teal-500 has-[:checked]:bg-teal-50">
                                <input type="radio" name="payment_method" value="transfer" class="w-4 h-4 text-teal-600">
                                <div class="ml-3 flex-1">
                                    <span class="font-semibold text-gray-800 text-sm block">Transfer Bank</span>
                                    <span class="text-xs text-gray-500">BCA, Mandiri, BNI, BRI</span>
                                </div>
                            </label>

                            <label class="flex items-center p-4 border-2 border-gray-300 bg-white rounded-lg cursor-pointer hover:border-teal-500 transition has-[:checked]:border-teal-500 has-[:checked]:bg-teal-50">
                                <input type="radio" name="payment_method" value="ewallet" class="w-4 h-4 text-teal-600">
                                <div class="ml-3 flex-1">
                                    <span class="font-semibold text-gray-800 text-sm block">E-Wallet</span>
                                    <span class="text-xs text-gray-500">GoPay, OVO, DANA, ShopeePay</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between mt-6 pt-6 border-t">
                        <a href="{{ route('cart.checkout') }}" class="text-teal-600 hover:text-teal-700 font-medium text-sm">
                            Kembali ke Detail
                        </a>
                        <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white font-semibold px-6 py-2.5 rounded-lg text-sm transition">
                            Pergi ke Pembayaran
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Column - Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm p-5 sticky top-20">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Ringkasan Pesanan</h3>

                    <!-- Product Items -->
                    <div class="space-y-3">
                    @foreach($cartItems as $item)
                    <div class="flex items-start space-x-3 pb-3 border-b last:border-0">
                        <div class="relative flex-shrink-0">
                            <div class="w-16 h-16 bg-gradient-to-br {{ $item['product']['gradient'] }} rounded-lg flex items-center justify-center">
                                <i class="fas {{ $item['product']['icon'] }} text-xl {{ $item['product']['icon_color'] }}"></i>
                            </div>
                            <span class="absolute -top-1 -right-1 bg-teal-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-semibold">{{ $item['quantity'] }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-gray-800 text-sm truncate">{{ $item['product']['name'] }}</h4>
                        </div>
                        <div class="font-bold text-gray-800 text-sm">Rp{{ number_format($item['subtotal'], 0, ',', '.') }}</div>
                    </div>
                    @endforeach
                    </div>

                    <!-- Summary Details -->
                    <div class="space-y-2 py-3">
                        <div class="flex justify-between text-gray-700 text-sm">
                            <span>Subtotal</span>
                            <span class="font-medium">Rp{{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-700 text-sm">
                            <span>Jumlah Item</span>
                            <span class="font-medium">{{ array_sum(array_column($cartItems, 'quantity')) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-700 text-sm">
                            <span>Pengiriman</span>
                            <span class="font-medium text-teal-600">Gratis</span>
                        </div>
                    </div>

                    <div class="border-t pt-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-bold text-gray-800">Total</span>
                            <span class="text-xl font-bold text-teal-600">Rp{{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <p class="text-xs text-gray-500 text-right mt-1">{{ array_sum(array_column($cartItems, 'quantity')) }} Item</p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
