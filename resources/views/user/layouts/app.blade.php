<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'KlikMart'))</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    {{-- Navbar --}}
    <nav class="bg-white shadow-md px-6 py-3 flex justify-between items-center">
        {{-- Logo / Brand --}}
        <a href="{{ route('main') }}" class="text-xl font-bold text-emerald-600 hover:text-emerald-700 transition">
            KlikMart
        </a>

        {{-- Navigation Links --}}
        <div class="space-x-4 flex items-center">
            <a href="{{ route('main') }}" class="text-gray-700 hover:text-emerald-600 transition">Beranda</a>
            <a href="{{ route('search') }}" class="text-gray-700 hover:text-emerald-600 transition">Produk</a>

            @auth
                <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-emerald-600 transition">Keranjang</a>
                <a href="{{ route('orders.index') }}" class="text-gray-700 hover:text-emerald-600 transition">Pesanan</a>

                {{-- Logout --}}
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-600 font-medium transition">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-emerald-600 transition">Login</a>
                <a href="{{ route('register') }}" class="text-gray-700 hover:text-emerald-600 transition">Register</a>
            @endauth
        </div>
    </nav>

    {{-- Alert --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 text-sm p-3 text-center">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="bg-red-100 text-red-800 text-sm p-3 text-center">
            {{ session('error') }}
        </div>
    @endif

    {{-- Breadcrumb (opsional) --}}
    @hasSection('breadcrumb')
        <div class="bg-gray-50 px-6 py-2 text-sm text-gray-600 border-b">
            @yield('breadcrumb')
        </div>
    @endif

    {{-- Main Content --}}
    <main class="flex-1 p-6">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-white border-t text-center py-4 text-sm text-gray-500 mt-auto">
        &copy; {{ date('Y') }} KlikMart — Semua Hak Cipta Dilindungi.
    </footer>

</body>
</html>
