@extends('user.layouts.user')

@section('title', 'Detail Pesanan | KlikMart')

@section('content')
<div class="max-w-5xl mx-auto px-6 sm:px-8 lg:px-10 py-10">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Detail Pesanan</h1>
        <p class="text-gray-500 text-sm">Lihat informasi lengkap dari pesanan Anda.</p>
    </div>

    {{-- Informasi Pesanan --}}
    <div class="bg-white rounded-2xl shadow border border-gray-100 p-6 mb-10">
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-3">Informasi Pesanan</h2>
                <ul class="text-gray-600 text-sm space-y-2">
                    <li><span class="font-medium">ID Pesanan:</span> #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</li>
                    <li><span class="font-medium">Tanggal Pemesanan:</span> {{ $order->created_at->translatedFormat('d F Y, H:i') }}</li>
                    <li><span class="font-medium">Status:</span>
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'processing' => 'bg-blue-100 text-blue-700',
                                'completed' => 'bg-green-100 text-green-700',
                                'cancelled' => 'bg-red-100 text-red-700',
                            ];
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </li>
                </ul>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-3">Pembayaran</h2>
                <ul class="text-gray-600 text-sm space-y-2">
                    <li><span class="font-medium">Metode Pembayaran:</span> {{ $order->payment_method ?? 'Transfer Bank' }}</li>
                    <li><span class="font-medium">Total Pembayaran:</span> 
                        <span class="font-bold text-emerald-600">
                            Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Daftar Produk --}}
    <div class="bg-white rounded-2xl shadow border border-gray-100 p-6 mb-10">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Produk dalam Pesanan</h2>
        <div class="divide-y divide-gray-100">
            @foreach ($order->items as $item)
                <div class="flex items-center justify-between py-4">
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('storage/' . $item->product->image ?? 'default.jpg') }}" 
                             alt="{{ $item->product->name }}" 
                             class="w-16 h-16 rounded-lg object-cover border border-gray-200">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $item->product->name }}</p>
                            <p class="text-sm text-gray-500">Jumlah: {{ $item->quantity }}</p>
                        </div>
                    </div>
                    <p class="font-semibold text-gray-800">
                        Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Alamat Pengiriman --}}
    <div class="bg-white rounded-2xl shadow border border-gray-100 p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Alamat Pengiriman</h2>
        @if ($order->shipping_address)
            <p class="text-gray-700 text-sm leading-relaxed">{{ $order->shipping_address }}</p>
        @else
            <p class="text-gray-400 text-sm italic">Alamat belum ditentukan.</p>
        @endif
    </div>

    {{-- Tombol Kembali --}}
    <div class="mt-8 text-center">
        <a href="{{ route('orders.index') }}" 
           class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg transition font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Pesanan
        </a>
    </div>
</div>
@endsection
