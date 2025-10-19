@extends('layouts.app')

@section('title', 'Review Pesanan')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Error/Success Messages -->
        @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Review Pesanan</h1>
            <p class="text-gray-600">Periksa kembali pesanan Anda sebelum melanjutkan ke pembayaran</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
            <!-- Shipping Address -->
            <div class="lg:col-span-3 bg-white rounded-lg shadow p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-900">Alamat Pengiriman</h2>
                    <a href="{{ route('checkout.address') }}" class="text-teal-600 hover:text-teal-700 text-sm font-medium">
                        Ubah
                    </a>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="font-semibold text-gray-900">{{ $shippingAddress['name'] }}</p>
                    <p class="text-gray-700 mt-1">{{ $shippingAddress['phone'] }}</p>
                    <p class="text-gray-700 mt-2">{{ $shippingAddress['address'] }}</p>
                    <p class="text-gray-700">{{ $shippingAddress['city'] }}, {{ $shippingAddress['province'] }} {{ $shippingAddress['postal_code'] }}</p>
                    @if($shippingAddress['notes'])
                        <p class="text-gray-600 text-sm mt-2 italic">Catatan: {{ $shippingAddress['notes'] }}</p>
                    @endif
                </div>
            </div>

            <!-- Items Review -->
            <div class="lg:col-span-3 bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Item yang Akan Dibeli</h2>

                <div class="space-y-4">
                    @foreach($checkoutItems as $item)
                        <div class="flex items-center gap-4 pb-4 border-b border-gray-200">
                            @if($item->product->image)
                                <img
                                    src="{{ asset('storage/' . $item->product->image) }}"
                                    alt="{{ $item->product->name }}"
                                    class="w-20 h-20 object-cover rounded border border-gray-200"
                                >
                            @else
                                <div class="w-20 h-20 rounded border border-gray-200 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900">{{ $item->product->name }}</h3>
                                <p class="text-sm text-gray-600 mt-1">
                                    Rp{{ number_format($item->product->price, 0, ',', '.') }} × {{ $item->qty }}
                                </p>
                                @if($item->product->stock < 10)
                                    <p class="text-xs text-orange-600 mt-1">⚠️ Stok terbatas: {{ $item->product->stock }} tersisa</p>
                                @endif
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900">
                                    Rp{{ number_format($item->product->price * $item->qty, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Buttons -->
                <div class="mt-6 flex gap-3">
                    <a href="{{ route('checkout.address') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 rounded-lg text-center transition">
                        Kembali ke Alamat
                    </a>
                    <a href="{{ route('checkout.payment') }}" class="flex-1 bg-teal-500 hover:bg-teal-600 text-white font-semibold py-3 rounded-lg text-center transition">
                        Lanjut ke Pembayaran
                    </a>
                </div>
            </div>

            <!-- Summary -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow p-6 sticky top-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 pb-4 border-b">Ringkasan Belanja</h2>

                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-700">
                            <span>Subtotal ({{ count($checkoutItems) }} item)</span>
                            <span class="font-semibold">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-700">
                            <span>Pajak ({{ $taxPercent }}%)</span>
                            <span class="font-semibold">Rp{{ number_format($tax, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t pt-3 flex justify-between text-lg">
                            <span class="font-bold text-gray-900">Total Pembayaran</span>
                            <span class="font-bold text-teal-600">Rp{{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="bg-blue-50 p-4 rounded-lg text-sm text-blue-800">
                        <p class="font-semibold mb-2">ℹ️ Informasi</p>
                        <ul class="space-y-1 text-xs">
                            <li>• Harga sudah termasuk pajak</li>
                            <li>• Pembayaran dilakukan di halaman berikutnya</li>
                            <li>• Pastikan stok masih tersedia</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
