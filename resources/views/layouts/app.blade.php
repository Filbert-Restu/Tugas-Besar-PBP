<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UMKM Mini-Commerce')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    {{-- Navbar --}}
    <nav class="bg-white shadow px-6 py-4">
        <div class="flex justify-between items-center">
            <a href="{{ route('landing') }}" class="text-xl font-bold text-blue-600">
                UMKM Mini-Commerce
            </a>
            <div class="space-x-4">
                @auth
                    <a href="{{ route('cart.index') }}" class="text-gray-700">Cart</a>
                    <form method="POST" action="{{ route('login') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600">Login</button>
                    </form>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="text-gray-700">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-700">Register</a>
                @endguest
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="p-6">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-200 text-center py-4 mt-8">
        <p>&copy; {{ date('Y') }} UMKM Mini-Commerce</p>
    </footer>

</body>
</html>
