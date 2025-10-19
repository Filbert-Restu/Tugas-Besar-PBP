@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Profil Saya</h1>
            <p class="text-gray-600 mt-2">Kelola informasi profil Anda untuk kontrol keamanan akun</p>
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <!-- Avatar -->
                    <div class="flex flex-col items-center text-center">
                        <div class="w-32 h-32 bg-gradient-to-br from-teal-400 to-emerald-500 rounded-full flex items-center justify-center text-white text-4xl font-bold mb-4">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">{{ Auth::user()->name }}</h2>
                        <p class="text-gray-600 text-sm mt-1">{{ Auth::user()->email }}</p>
                        <span class="mt-3 px-3 py-1 bg-teal-100 text-teal-700 rounded-full text-xs font-semibold">
                            {{ ucfirst(Auth::user()->role) }}
                        </span>
                    </div>

                    <!-- Stats -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 text-sm">Total Pesanan</span>
                                <span class="font-semibold text-gray-900">{{ Auth::user()->orders->count() }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 text-sm">Bergabung Sejak</span>
                                <span class="font-semibold text-gray-900">{{ Auth::user()->created_at->format('M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Tabs -->
                <div class="bg-white rounded-xl shadow-sm mb-6" x-data="{ activeTab: 'info' }">
                    <div class="border-b border-gray-200">
                        <nav class="flex -mb-px">
                            <button
                                @click="activeTab = 'info'"
                                :class="activeTab === 'info' ? 'border-teal-500 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                class="flex-1 py-4 px-1 text-center border-b-2 font-medium text-sm transition-colors">
                                Informasi Pribadi
                            </button>
                            <button
                                @click="activeTab = 'address'"
                                :class="activeTab === 'address' ? 'border-teal-500 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                class="flex-1 py-4 px-1 text-center border-b-2 font-medium text-sm transition-colors">
                                Alamat
                            </button>
                            <button
                                @click="activeTab = 'password'"
                                :class="activeTab === 'password' ? 'border-teal-500 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                class="flex-1 py-4 px-1 text-center border-b-2 font-medium text-sm transition-colors">
                                Keamanan
                            </button>
                        </nav>
                    </div>

                    <!-- Tab Content: Informasi Pribadi -->
                    <div x-show="activeTab === 'info'" class="p-6">
                        <form action="{{ route('user.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                    <input
                                        type="text"
                                        name="name"
                                        value="{{ old('name', Auth::user()->name) }}"
                                        class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent {{ $errors->has('name') ? 'border border-red-500' : 'border border-gray-300' }}"
                                        required
                                    >
                                    @error('name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                    <input
                                        type="email"
                                        name="email"
                                        value="{{ old('email', Auth::user()->email) }}"
                                        class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent {{ $errors->has('email') ? 'border border-red-500' : 'border border-gray-300' }}"
                                        required
                                    >
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">No. Telepon</label>
                                    <input
                                        type="text"
                                        name="phone"
                                        value="{{ old('phone', Auth::user()->phone) }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                        placeholder="08123456789"
                                    >
                                </div>
                            </div>

                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <button
                                    type="submit"
                                    class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-teal-500 to-emerald-500 text-white rounded-lg hover:from-teal-600 hover:to-emerald-600 transition-all shadow-md hover:shadow-lg font-semibold"
                                >
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Tab Content: Alamat -->
                    <div x-show="activeTab === 'address'" class="p-6">
                        <form action="{{ route('user.address.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
                                    <textarea
                                        name="address"
                                        rows="3"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                        placeholder="Jl. Contoh No. 123"
                                    >{{ old('address', Auth::user()->address) }}</textarea>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kota</label>
                                        <input
                                            type="text"
                                            name="city"
                                            value="{{ old('city', Auth::user()->city) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                            placeholder="Jakarta"
                                        >
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kode Pos</label>
                                        <input
                                            type="text"
                                            name="postal_code"
                                            value="{{ old('postal_code', Auth::user()->postal_code) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                            placeholder="12345"
                                        >
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Provinsi</label>
                                    <select
                                        name="province"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent bg-white"
                                    >
                                        <option value="">Pilih Provinsi</option>
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
                                </div>
                            </div>

                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <button
                                    type="submit"
                                    class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-teal-500 to-emerald-500 text-white rounded-lg hover:from-teal-600 hover:to-emerald-600 transition-all shadow-md hover:shadow-lg font-semibold"
                                >
                                    Simpan Alamat
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Tab Content: Keamanan -->
                    <div x-show="activeTab === 'password'" class="p-6">
                        <form action="{{ route('user.password.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password Lama</label>
                                    <input
                                        type="password"
                                        name="current_password"
                                        class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent {{ $errors->has('current_password') ? 'border border-red-500' : 'border border-gray-300' }}"
                                        required
                                    >
                                    @error('current_password')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                                    <input
                                        type="password"
                                        name="password"
                                        class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent {{ $errors->has('password') ? 'border border-red-500' : 'border border-gray-300' }}"
                                        required
                                    >
                                    @error('password')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <button
                                    type="submit"
                                    class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-teal-500 to-emerald-500 text-white rounded-lg hover:from-teal-600 hover:to-emerald-600 transition-all shadow-md hover:shadow-lg font-semibold"
                                >
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
