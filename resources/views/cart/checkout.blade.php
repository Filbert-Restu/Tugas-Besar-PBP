@extends('layouts.app')

@section('title', 'Konfirmasi Checkout')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold mb-8 text-gray-900">Konfirmasi Checkout</h1>

            @if($CheckoutItems->isEmpty())
                <div class="text-center py-12">
                    <p class="text-gray-600 text-lg mb-4">Tidak ada produk untuk di-checkout.</p>
                    <a href="{{ route('cart.index') }}" class="text-blue-500 hover:text-blue-600 font-medium">
                        Kembali ke Keranjang
                    </a>
                </div>
            @else
                <!-- Daftar Item -->
                <div class="mb-8 border-b pb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Rincian Produk</h2>
                    <div class="space-y-4">
                        @foreach($CheckoutItems as $item)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">{{ $item->product->name }}</p>
                                    <p class="text-sm text-gray-600">
                                        Rp {{ number_format($item->product->price, 0, ',', '.') }} × {{ $item->qty }}
                                    </p>
                                </div>
                                <p class="font-semibold text-gray-900">
                                    Rp {{ number_format($item->product->price * $item->qty, 0, ',', '.') }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Ringkasan Pembayaran -->
                <div class="mb-8 p-6 bg-blue-50 rounded-lg border border-blue-200">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Pembayaran</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between text-gray-700">
                            <span>Subtotal:</span>
                            <span class="font-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-700">
                            <span>Pajak ({{ $taxPercent }}%):</span>
                            <span class="font-medium">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t pt-3 flex justify-between text-lg">
                            <span class="font-semibold text-gray-900">Total Pembayaran:</span>
                            <span class="font-bold text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Form Pembayaran -->
                <form action="{{ route('cart.checkout.process') }}" method="POST">
                    @csrf

                    <!-- Catatan (Opsional) -->
                    <div class="mb-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                            Catatan Pesanan (Opsional)
                        </label>
                        <textarea
                            name="notes"
                            id="notes"
                            rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Contoh: Mohon dikemas dengan hati-hati..."
                        ></textarea>
                    </div>

                    <!-- Alamat Pengiriman Info (Opsional) -->
                    <div class="mb-8 p-4 bg-yellow-50 rounded border border-yellow-200">
                        <p class="text-sm text-gray-600">
                            📍 <strong>Alamat Pengiriman:</strong> Akan diisi setelah klik "Bayar Sekarang"
                        </p>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex gap-4">
                        <button
                            type="submit"
                            class="flex-1 bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-3 rounded-lg transition duration-300"
                        >
                            Bayar Sekarang
                        </button>
                        <a
                            href="#"
                            class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-900 font-semibold px-6 py-3 rounded-lg transition duration-300 text-center"
                        >
                            Batal
                        </a>
                    </div>
                </form>

                <!-- Info Keamanan -->
                <div class="mt-8 p-4 bg-green-50 rounded border border-green-200">
                    <p class="text-sm text-gray-700">
                        🔒 <strong>Informasi Anda Aman:</strong> Data pembayaran akan dienkripsi dan diproses dengan aman melalui gateway pembayaran terpercaya.
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
