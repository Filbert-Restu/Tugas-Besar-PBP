<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') - {{ config('app.name') }}</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

  <!-- Navbar -->
  @include('admin.layouts.navbar')

  <!-- Sidebar -->
  @include('admin.layouts.sidebar')

  <!-- Main Content -->
  <div class="pt-16 sm:ml-64">
    <main class="p-6">
      @yield('content')
    </main>
  </div>

</body>
</html>


