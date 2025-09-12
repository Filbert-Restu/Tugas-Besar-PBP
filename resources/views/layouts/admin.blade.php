<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - {{ config('app.name') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md h-screen fixed">
        <div class="p-4 border-b">
            <h1 class="text-xl font-bold text-blue-600">Admin Panel</h1>
        </div>
        <nav class="p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center px-3 py-2 rounded-lg hover:bg-blue-100 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-500 text-white' : 'text-gray-700' }}">
                📊 <span class="ml-2">Dashboard</span>
            </a>
            <a href="{{ route('products.index') }}"
                class="flex items-center px-3 py-2 rounded-lg hover:bg-blue-100 {{ request()->is('admin/products*') ? 'bg-blue-500 text-white' : 'text-gray-700' }}">
                🛒 <span class="ml-2">Produk</span>
            </a>
            <a href="{{ route('orders.index') }}"
                class="flex items-center px-3 py-2 rounded-lg hover:bg-blue-100 {{ request()->is('admin/orders*') ? 'bg-blue-500 text-white' : 'text-gray-700' }}">
                📦 <span class="ml-2">Pesanan</span>
            </a>
            <a href="#"
                class="flex items-center px-3 py-2 rounded-lg hover:bg-blue-100 text-gray-700">
                👥 <span class="ml-2">Users</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="ml-64 flex-1">
        <!-- Header -->
        <header class="bg-white shadow-md p-4 flex justify-between items-center">
            <h2 class="text-lg font-semibold">@yield('title', 'Admin')</h2>
            <div class="flex items-center space-x-3">
                <span class="text-gray-700">Halo, Admin</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">Logout</button>
                </form>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6">
            @yield('content')
        </main>
    </div>

</body>
</html>
