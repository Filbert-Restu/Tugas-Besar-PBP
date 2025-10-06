@extends('user.layouts.user')

@section('title', 'Profil Saya | KlikMart')

@section('content')
<div class="max-w-5xl mx-auto px-6 sm:px-8 lg:px-10 py-10">

    {{-- Header --}}
    <div class="mb-10 text-center">
        <h1 class="text-3xl font-bold text-gray-800">Profil Pengguna</h1>
        <p class="text-gray-500 mt-2">Kelola data dan informasi akun Anda di sini.</p>
    </div>

    {{-- Data User --}}
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
        <div class="flex flex-col md:flex-row items-center p-8 gap-6">

            {{-- Foto Profil --}}
            <div class="w-28 h-28 flex-shrink-0">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=10b981&color=fff&size=128"
                     alt="Avatar {{ auth()->user()->name }}"
                     class="rounded-full border-4 border-emerald-400 shadow-md object-cover">
            </div>

            {{-- Detail User --}}
            <div class="flex-1 w-full">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Nama Lengkap</p>
                        <p class="text-lg font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Email</p>
                        <p class="text-lg font-semibold text-gray-800">{{ auth()->user()->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Peran Akun</p>
                        <p class="inline-block px-3 py-1 bg-emerald-100 text-emerald-700 font-semibold rounded-md text-sm">
                            {{ ucfirst(auth()->user()->role) }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Tanggal Bergabung</p>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ auth()->user()->created_at->translatedFormat('d F Y') }}
                        </p>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('orders.index') }}" 
                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg shadow transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M9 3v18m6-18v18M4 9h16" />
                        </svg>
                        Lihat Pesanan
                    </a>

                    <a href="{{ route('user.edit', auth()->id()) }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414
                                     a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Profil
                    </a>

                    <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Keluar dari akun?')">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Riwayat Aktivitas --}}
    <div class="mt-12">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Aktivitas Terbaru</h2>
        <div class="bg-white border border-gray-100 rounded-xl shadow p-6">
            <p class="text-gray-500 text-sm">
                Kamu belum memiliki aktivitas terbaru. Pesan produk sekarang untuk melihat riwayat belanja di sini!
            </p>
        </div>
    </div>

</div>
@endsection
