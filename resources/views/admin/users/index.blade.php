@extends('layouts.admin')

@section('title', 'Manajemen User')

@section('content')
<div class="p-6 bg-white shadow rounded-xl">
    <h2 class="text-lg font-semibold mb-4">Daftar User</h2>
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-2">ID</th>
                <th class="p-2">Nama</th>
                <th class="p-2">Email</th>
                <th class="p-2">Role</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="border-b">
                <td class="p-2">{{ $user->id }}</td>
                <td class="p-2">{{ $user->name }}</td>
                <td class="p-2">{{ $user->email }}</td>
                <td class="p-2">{{ ucfirst($user->role) }}</td>
                <td class="p-2">
                    @if($user->role !== 'admin')
                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded" onclick="return confirm('Yakin hapus user ini?')">Hapus</button>
                        </form>
                    @else
                        <span class="text-gray-500">-</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
