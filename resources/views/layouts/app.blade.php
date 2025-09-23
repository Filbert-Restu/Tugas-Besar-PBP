<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', config('app.name'))</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex">

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Navbar -->
        <header>
            @include('partials.navbar')
        </header>

        <!-- main -->
        <main>
            @yield('content')
        </main>


        <!-- Footer -->
    </div>
</body>
</html>
