@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-semibold mb-6 text-green-700">Tambah Pengguna Baru</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-gray-700 mb-1">Nama</label>
            <input type="text" name="name" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-green-300" value="{{ old('name') }}" required>
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Email</label>
            <input type="email" name="email" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-green-300" value="{{ old('email') }}" required>
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Password</label>
            <input type="password" name="password" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-green-300" required>
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-green-300" required>
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Role</label>
            <select name="role" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-green-300" required>
                <option value="">-- Pilih Role --</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">Batal</a>
            <button type="submit" class="px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
