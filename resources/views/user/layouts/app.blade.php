<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', config('app.name'))</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow-md px-6 py-3 flex justify-between items-center">
        <a href="{{ route('landing') }}" class="text-xl font-bold text-blue-600">UMKM Mini-Commerce</a>
        <div class="space-x-4">
            <a href="{{ route('products.index') }}" class="hover:text-blue-500">Produk</a>
            @auth
                <a href="{{ route('cart.index') }}" class="hover:text-blue-500">Keranjang</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button class="hover:text-red-500">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:text-blue-500">Logout</a>
                <a href="{{ route('register') }}" class="hover:text-blue-500">Register</a>
            @endauth
        </div>
    </nav>

    <!-- Alert -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 text-center">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="bg-red-100 text-red-800 p-3 text-center">
            {{ session('error') }}
        </div>
    @endif

    <!-- Breadcrumb -->
    <div class="bg-gray-50 px-6 py-2 text-sm text-gray-600">
        @yield('breadcrumb')
    </div>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t text-center py-4 text-sm text-gray-500">
        &copy; {{ date('Y') }} UMKM Mini-Commerce. All rights reserved.
    </footer>
</body>
</html>
