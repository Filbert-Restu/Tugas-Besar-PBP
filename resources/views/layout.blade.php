<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KlikMart - Belanja Klik, Semua Asik')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-teal-500">
                    KlikMart
                </a>
                <div class="flex items-center space-x-6">
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-teal-500 transition">
                        <i class="fas fa-user text-lg"></i>
                    </a>
                    <a href="{{ route('cart') }}" class="text-gray-600 hover:text-teal-500 transition relative">
                        <i class="fas fa-shopping-cart text-lg"></i>
                        @php
                            $cart = session()->get('cart', []);
                            $cartCount = array_sum(array_column($cart, 'quantity'));
                        @endphp
                        @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-semibold">{{ $cartCount }}</span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-2xl font-bold text-teal-400 mb-4">KlikMart</h3>
                    <p class="text-gray-400">Belanja Klik, Semua Asik!</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Info</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-teal-400 transition">Contact us</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
                <p>©KlikMart All Rights Reserved.</p>
                <p class="mt-2">Designed with <span class="text-red-500">❤</span> by uxbly</p>
            </div>
        </div>
    </footer>
</body>
</html>