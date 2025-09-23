<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-4 text-center">Register</h1>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

                <p class="mt-1 text-xs text-gray-500">
                    Minimal 10 karakter, harus mengandung huruf besar, huruf kecil, angka, dan simbol.
                </p>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">
                Register
            </button>
        </form>

        <p class="text-sm text-center mt-4">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
        </p>
    </div>
</body>
</html>
