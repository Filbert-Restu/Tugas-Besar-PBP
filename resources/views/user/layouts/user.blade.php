<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'KlikMart - User')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    {{-- Navbar --}}
    <header class="bg-white shadow-md py-4">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-emerald-600">KlikMart</h1>

            <nav class="flex items-center space-x-6">
                <a href="{{ route('main') }}" class="text-gray-600 hover:text-emerald-600">Beranda</a>
                <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-emerald-600">Keranjang</a>
                <a href="{{ route('orders.index') }}" class="text-gray-600 hover:text-emerald-600">Pesanan</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Logout</button>
                </form>
            </nav>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="flex-1 max-w-6xl mx-auto w-full px-6 py-10">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-white border-t mt-10 py-6 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} KlikMart — All Rights Reserved.
    </footer>

</body>
</html>
