@extends('layouts.app')

@section('title', 'Review Pesanan')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Review Pesanan</h1>
            <p class="text-gray-600">Periksa kembali pesanan Anda sebelum melanjutkan ke pembayaran</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Items Review -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Item yang Akan Dibeli</h2>

                <div class="space-y-4">
                    @foreach($checkoutItems as $item)
                        <div class="flex items-center gap-4 pb-4 border-b border-gray-200">
                            <img
                                src="{{ $item->product->image ?? 'https://via.placeholder.com/80' }}"
                                alt="{{ $item->product->name }}"
                                class="w-20 h-20 object-cover rounded border border-gray-200"
                            >
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
                    <a href="{{ route('cart.index') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 rounded-lg text-center transition">
                        Kembali ke Keranjang
                    </a>
                    <a href="{{ route('checkout.payment') }}" class="flex-1 bg-teal-500 hover:bg-teal-600 text-white font-semibold py-3 rounded-lg text-center transition">
                        Lanjut ke Pembayaran
                    </a>
                </div>
            </div>

            <!-- Summary -->
            <div class="lg:col-span-1">
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
