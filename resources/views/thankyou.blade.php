@extends('layout')

@section('title', 'Terima Kasih - KlikMart')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Breadcrumb -->
    <div class="flex items-center space-x-2 text-xs text-gray-600 mb-6">
        <a href="{{ route('cart') }}" class="text-teal-600 hover:text-teal-700 font-medium">Keranjang</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <a href="{{ route('checkout') }}" class="text-teal-600 hover:text-teal-700 font-medium">Detail</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <span class="font-medium">Pengiriman & Pembayaran</span>
    </div>

    <!-- Success Card -->
    <div class="bg-white rounded-xl shadow-sm p-10 text-center">
        <!-- Success Icon -->
        <div class="flex justify-center mb-5">
            <div class="w-20 h-20 bg-teal-100 rounded-full flex items-center justify-center">
                <i class="fas fa-check text-4xl text-teal-600"></i>
            </div>
        </div>

        <!-- Success Message -->
        <h1 class="text-2xl font-bold text-gray-800 mb-3">Pesanan Terkonfirmasi</h1>
        <p class="text-gray-600 text-sm mb-1">ORDER #{{ $orderNumber }}</p>
        
        <p class="text-gray-700 text-sm max-w-2xl mx-auto mb-6 mt-4">
            Terima kasih, telah membeli. Informasi akan dikirim via KlikMart. Kami sangat senang melayani anda. Tunggu update status pesanan di situs or melalui email anda.
        </p>

        <!-- Action Buttons -->
        <div class="mb-5">
            <a href="{{ route('home') }}" class="inline-block bg-teal-500 hover:bg-teal-600 text-white font-semibold px-7 py-2.5 rounded-lg transition">
                Kembali Belanja
            </a>
        </div>

        <a href="{{ route('receipt', $orderNumber) }}" class="text-teal-600 hover:text-teal-700 font-medium text-sm">
            Print Kuitansi
        </a>
    </div>
</div>
@endsection