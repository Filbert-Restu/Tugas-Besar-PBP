<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KlikMart Admin Centre</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 min-h-screen">
  <div class="flex">
    <!-- Sidebar -->
    @include('partials.admin.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-8">
      @yield('content')
    </main>
  </div>
</body>
</html>
