<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', config('app.name'))</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md h-screen fixed">
        <div class="p-4 border-b">
            <h1 class="text-xl font-bold text-blue-600">Admin Panel</h1>
        </div>
        <nav class="p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 hover:bg-blue-100">Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="block px-3 py-2 hover:bg-blue-100">Produk</a>
            <a href="#" class="block px-3 py-2 hover:bg-blue-100">Kategori</a>
            <a href="{{ route('admin.orders.index') }}" class="block px-3 py-2 hover:bg-blue-100">Pesanan</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="ml-64 flex-1 flex flex-col">
        <!-- Navbar -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h2 class="text-lg font-semibold">@yield('title', 'Admin')</h2>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-red-500 text-white px-3 py-1 rounded">Logout</button>
            </form>
        </header>

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

        <main class="flex-1 p-6">
            @yield('content')
        </main>

        <footer class="bg-white border-t text-center py-4 text-sm text-gray-500">
            &copy; {{ date('Y') }} Admin Panel
        </footer>
    </div>
</body>
</html>
