@extends('layouts.app')

@section('title', 'Alamat Pengiriman')

@section('content')
<div class="min-h-screen py-8 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Breadcrumb -->
        <div class="mb-8">
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <a href="{{ route('cart.index') }}" class="hover:text-teal-600">Keranjang</a>
                <span>›</span>
                <span class="text-teal-600 font-medium">Alamat</span>
                <span>›</span>
                <span class="text-gray-400">Pengiriman & Pembayaran</span>
            </div>
        </div>

            <!-- Alert Messages -->
            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('checkout.address.store') }}" method="POST">
                @csrf

                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <!-- Kontak Section -->
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Kontak</h2>

                        <div class="border border-gray-300 rounded-lg">
                            <input
                                type="text"
                                name="phone"
                                id="phone"
                                value="{{ old('phone', Auth::user()->phone) }}"
                                placeholder="Email atau No. Telepon"
                                class="w-full px-4 py-3 border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                required
                            >
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Alamat Pengiriman Section -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Alamat Pengiriman</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    value="{{ old('name', Auth::user()->name) }}"
                                    placeholder="Nama Depan"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('name') @enderror"
                                    required
                                >
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <input
                                    type="text"
                                    name="last_name"
                                    id="last_name"
                                    value="{{ old('last_name') }}"
                                    placeholder="Nama Belakang"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                >
                            </div>
                        </div>

                        <div class="mb-4">
                            <input
                                type="text"
                                name="address"
                                id="address"
                                value="{{ old('address', Auth::user()->address) }}"
                                placeholder="Alamat dan No. Telepon"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('address') @enderror"
                                required
                            >
                            @error('address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <input
                                type="text"
                                name="notes"
                                id="notes"
                                value="{{ old('notes') }}"
                                placeholder="Catatan (opsional)"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                            >
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <input
                                    type="text"
                                    name="city"
                                    id="city"
                                    value="{{ old('city', Auth::user()->city) }}"
                                    placeholder="Kota"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('city') @enderror"
                                    required
                                >
                                @error('city')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <input
                                    type="text"
                                    name="postal_code"
                                    id="postal_code"
                                    value="{{ old('postal_code', Auth::user()->postal_code) }}"
                                    placeholder="Kode Pos"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('postal_code') @enderror"
                                    required
                                >
                                @error('postal_code')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <select
                                    name="province"
                                    id="province"
                                    class="w-full px-4 py-3border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent bg-white @error('province') @enderror"
                                    required
                                >
                                    <option value="">Provinsi</option>
                                    <option value="DKI Jakarta" {{ old('province', Auth::user()->province) == 'DKI Jakarta' ? 'selected' : '' }}>DKI Jakarta</option>
                                    <option value="Jawa Barat" {{ old('province', Auth::user()->province) == 'Jawa Barat' ? 'selected' : '' }}>Jawa Barat</option>
                                    <option value="Jawa Tengah" {{ old('province', Auth::user()->province) == 'Jawa Tengah' ? 'selected' : '' }}>Jawa Tengah</option>
                                    <option value="Jawa Timur" {{ old('province', Auth::user()->province) == 'Jawa Timur' ? 'selected' : '' }}>Jawa Timur</option>
                                    <option value="DI Yogyakarta" {{ old('province', Auth::user()->province) == 'DI Yogyakarta' ? 'selected' : '' }}>DI Yogyakarta</option>
                                    <option value="Banten" {{ old('province', Auth::user()->province) == 'Banten' ? 'selected' : '' }}>Banten</option>
                                    <option value="Bali" {{ old('province', Auth::user()->province) == 'Bali' ? 'selected' : '' }}>Bali</option>
                                    <option value="Sumatera Utara" {{ old('province', Auth::user()->province) == 'Sumatera Utara' ? 'selected' : '' }}>Sumatera Utara</option>
                                    <option value="Sumatera Selatan" {{ old('province', Auth::user()->province) == 'Sumatera Selatan' ? 'selected' : '' }}>Sumatera Selatan</option>
                                    <option value="Sulawesi Selatan" {{ old('province', Auth::user()->province) == 'Sulawesi Selatan' ? 'selected' : '' }}>Sulawesi Selatan</option>
                                </select>
                                @error('province')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <select
                                name="country"
                                id="country"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent bg-white"
                                required
                            >
                                <option value="Indonesia" selected>Indonesia</option>
                            </select>
                        </div>

                        <div class="flex items-start gap-2">
                            <input
                                type="checkbox"
                                name="save_info"
                                id="save_info"
                                class="mt-1 w-4 h-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500"
                            >
                            <label for="save_info" class="text-sm text-gray-600">
                                Simpan informasi untuk lanjut ke pembayaran
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex items-center justify-between">
                    <a
                        href="{{ route('cart.index') }}"
                        class="text-teal-600 hover:text-teal-700 font-medium flex items-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Kembali ke Keranjang
                    </a>

                    <button
                        type="submit"
                        class="bg-gradient-to-r from-teal-600 to-cyan-500 text-white px-8 py-3 rounded-lg font-medium hover:shadow-lg transition-all duration-200"
                    >
                        Pergi ke Pengiriman
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
