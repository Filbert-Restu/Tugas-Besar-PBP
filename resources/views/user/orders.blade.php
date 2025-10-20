@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Pesanan Saya</h1>
            <p class="text-gray-600 mt-2">Kelola dan pantau semua pesanan Anda di sini</p>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center gap-3">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center gap-3">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Orders List -->
        @if($orders->count() > 0)
            <div class="space-y-4">
                @foreach($orders as $order)
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                        <!-- Order Header -->
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-4">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900">Order #{{ $order->order_id ?? $order->id }}</h3>
                                            <p class="text-sm text-gray-600 mt-1">{{ $order->created_at->format('d M Y H:i') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-600">Total:</p>
                                    <p class="text-xl font-bold text-teal-600">Rp{{ number_format($order->total, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Order Status -->
                        <div class="p-6 bg-gray-50 border-b border-gray-200">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Order Status -->
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase mb-2">Status Pesanan</p>
                                    <div class="flex items-center gap-2">
                                        @php
                                            $orderStatusColor = match($order->status) {
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'processing' => 'bg-blue-100 text-blue-800',
                                                'shipped' => 'bg-cyan-100 text-cyan-800',
                                                'delivered' => 'bg-green-100 text-green-800',
                                                'cancelled' => 'bg-red-100 text-red-800',
                                                default => 'bg-gray-100 text-gray-800',
                                            };
                                            $orderStatusIcon = match($order->status) {
                                                'pending' => '⏳',
                                                'processing' => '📦',
                                                'shipped' => '🚚',
                                                'delivered' => '✅',
                                                'cancelled' => '❌',
                                                default => '❓',
                                            };
                                        @endphp
                                        <span class="text-lg">{{ $orderStatusIcon }}</span>
                                        <span class="px-3 py-1 {{ $orderStatusColor }} rounded-full text-sm font-medium">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Payment Status -->
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase mb-2">Status Pembayaran</p>
                                    <div class="flex items-center gap-2">
                                        @php
                                            $paymentStatusColor = match($order->payment_status) {
                                                'paid' => 'bg-green-100 text-green-800',
                                                'unpaid' => 'bg-red-100 text-red-800',
                                                'failed' => 'bg-orange-100 text-orange-800',
                                                'refunded' => 'bg-gray-100 text-gray-800',
                                                default => 'bg-gray-100 text-gray-800',
                                            };
                                            $paymentStatusIcon = match($order->payment_status) {
                                                'paid' => '💳',
                                                'unpaid' => '⏳',
                                                'failed' => '❌',
                                                'refunded' => '↩️',
                                                default => '❓',
                                            };
                                        @endphp
                                        <span class="text-lg">{{ $paymentStatusIcon }}</span>
                                        <span class="px-3 py-1 {{ $paymentStatusColor }} rounded-full text-sm font-medium">
                                            {{ ucfirst(str_replace('_', ' ', $order->payment_status)) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Shipping Status -->
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase mb-2">Status Pengiriman</p>
                                    <div class="flex items-center gap-2">
                                        @php
                                            $shippingStatusColor = match($order->shipping_status) {
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'processing' => 'bg-blue-100 text-blue-800',
                                                'shipped' => 'bg-cyan-100 text-cyan-800',
                                                'delivered' => 'bg-green-100 text-green-800',
                                                default => 'bg-gray-100 text-gray-800',
                                            };
                                            $shippingStatusIcon = match($order->shipping_status) {
                                                'pending' => '📋',
                                                'processing' => '📦',
                                                'shipped' => '🚚',
                                                'delivered' => '📍',
                                                default => '❓',
                                            };
                                        @endphp
                                        <span class="text-lg">{{ $shippingStatusIcon }}</span>
                                        <span class="px-3 py-1 {{ $shippingStatusColor }} rounded-full text-sm font-medium">
                                            {{ ucfirst(str_replace('_', ' ', $order->shipping_status)) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="p-6">
                            <p class="text-sm font-semibold text-gray-700 mb-4">Produk yang Dipesan:</p>
                            <div class="space-y-3">
                                @foreach($order->items as $item)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex-1">
                                            <p class="font-medium text-gray-900">{{ $item->product->name ?? 'Produk Tidak Tersedia' }}</p>
                                            <p class="text-sm text-gray-600">
                                                {{ $item->qty }} × Rp{{ number_format($item->price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <p class="font-semibold text-gray-900">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Order Details -->
                        <div class="p-6 bg-gray-50 border-t border-gray-200">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Left Column -->
                                <div>
                                    <p class="text-sm font-semibold text-gray-700 mb-2">Alamat Pengiriman:</p>
                                    <p class="text-sm text-gray-600">{{ $order->address_text ?? Auth::user()->address }}</p>
                                </div>

                                <!-- Right Column - Summary -->
                                <div class="space-y-2">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Subtotal:</span>
                                        <span class="font-medium">Rp{{ number_format($order->subtotal ?? ($order->total / 1.1), 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Pajak (10%):</span>
                                        <span class="font-medium">Rp{{ number_format($order->tax ?? 0, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm font-semibold border-t border-gray-300 pt-2 mt-2">
                                        <span class="text-gray-900">Total:</span>
                                        <span class="text-teal-600">Rp{{ number_format($order->total, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="p-6 border-t border-gray-200 flex gap-3">
                            @if($order->payment_status === 'unpaid')
                                <button
                                    onclick="alert('Fitur pembayaran ulang akan segera hadir')"
                                    class="flex-1 px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors font-medium text-sm"
                                >
                                    Bayar Sekarang
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination (jika perlu) -->
            @if($orders->hasPages())
                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Pesanan</h3>
                <p class="text-gray-600 mb-6">Anda belum membuat pesanan apapun. Mari mulai berbelanja sekarang!</p>
                <a
                    href="{{ route('main') }}"
                    class="inline-block px-6 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors font-medium"
                >
                    Mulai Belanja
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
