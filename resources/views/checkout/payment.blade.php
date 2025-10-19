@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Pembayaran</h1>
            <p class="text-gray-600">Pilih metode pembayaran untuk menyelesaikan pesanan Anda</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form Pembayaran -->
            <div class="lg:col-span-2">
                <form action="{{ route('checkout.process') }}" method="POST" class="bg-white rounded-lg shadow p-6">
                    @csrf

                    <!-- Pilihan Metode Pembayaran -->
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Metode Pembayaran</h2>

                        <!-- Transfer Bank -->
                        <label class="block border-2 border-gray-200 rounded-lg p-4 mb-3 cursor-pointer hover:border-teal-500 transition">
                            <div class="flex items-center">
                                <input type="radio" name="payment_method" value="transfer_bank" class="w-4 h-4 text-teal-500" required>
                                <div class="ml-3 flex-1">
                                    <div class="flex items-center justify-between">
                                        <span class="font-semibold text-gray-900">Transfer Bank</span>
                                        <span class="text-2xl">🏦</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">Transfer ke rekening bank kami</p>
                                </div>
                            </div>
                        </label>

                        <!-- E-Wallet -->
                        <label class="block border-2 border-gray-200 rounded-lg p-4 mb-3 cursor-pointer hover:border-teal-500 transition">
                            <div class="flex items-center">
                                <input type="radio" name="payment_method" value="e-wallet" class="w-4 h-4 text-teal-500" required>
                                <div class="ml-3 flex-1">
                                    <div class="flex items-center justify-between">
                                        <span class="font-semibold text-gray-900">E-Wallet</span>
                                        <span class="text-2xl">💳</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">Bayar menggunakan GoPay, OVO, DANA, dll</p>
                                </div>
                            </div>
                        </label>

                        <!-- COD -->
                        <label class="block border-2 border-gray-200 rounded-lg p-4 cursor-pointer hover:border-teal-500 transition">
                            <div class="flex items-center">
                                <input type="radio" name="payment_method" value="cod" class="w-4 h-4 text-teal-500" required>
                                <div class="ml-3 flex-1">
                                    <div class="flex items-center justify-between">
                                        <span class="font-semibold text-gray-900">Cash on Delivery (COD)</span>
                                        <span class="text-2xl">💵</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">Bayar saat barang diterima</p>
                                </div>
                            </div>
                        </label>

                        @error('payment_method')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Catatan Pesanan -->
                    <div class="mb-6">
                        <label for="notes" class="block text-sm font-semibold text-gray-900 mb-2">
                            Catatan Pesanan (Opsional)
                        </label>
                        <textarea
                            name="notes"
                            id="notes"
                            rows="3"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500"
                            placeholder="Tambahkan catatan untuk pesanan Anda..."
                        >{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3">
                        <a href="{{ route('checkout.show') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 rounded-lg text-center transition">
                            Kembali
                        </a>
                        <button type="submit" class="flex-1 bg-teal-500 hover:bg-teal-600 text-white font-semibold py-3 rounded-lg transition">
                            Konfirmasi Pembayaran
                        </button>
                    </div>
                </form>
            </div>

            <!-- Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow p-6 sticky top-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-4 pb-4 border-b">Ringkasan Pesanan</h2>

                    <!-- Item List -->
                    <div class="mb-4 max-h-60 overflow-y-auto">
                        @foreach($checkoutItems as $item)
                            <div class="flex items-center gap-3 mb-3 pb-3 border-b border-gray-100">
                                <img
                                    src="{{ $item->product->image ?? 'https://via.placeholder.com/50' }}"
                                    alt="{{ $item->product->name }}"
                                    class="w-12 h-12 object-cover rounded"
                                >
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ $item->product->name }}</p>
                                    <p class="text-xs text-gray-600">{{ $item->qty }} × Rp{{ number_format($item->product->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Total Calculation -->
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between text-sm text-gray-700">
                            <span>Subtotal</span>
                            <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-700">
                            <span>Pajak ({{ $taxPercent }}%)</span>
                            <span>Rp{{ number_format($tax, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t pt-2 flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span class="text-teal-600">Rp{{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="bg-teal-50 p-3 rounded text-sm text-teal-800">
                        <p class="font-semibold mb-1">{{ count($checkoutItems) }} Item</p>
                        <p class="text-xs">Pastikan data pembayaran Anda benar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
