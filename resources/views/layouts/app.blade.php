<!DOCTYPE html>
<html lang="en">
<head>
    @livewireStyles
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    @vite('resources/css/app.css')
    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <!-- Navigation -->
    @include('partials.navbar')

    <!-- Main Content -->
    <main>
        {{-- cek livewire atau bukan --}}
        @if (isset($slot))
            {{ $slot }}
        @else
            @yield('content')
        @endif
    </main>
    <!-- Footer -->
    @include('partials.footer')
    {{-- AlpineJS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireScripts
</body>
</html>
