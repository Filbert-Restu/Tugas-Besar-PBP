@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center gap-3">
        <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-emerald-500 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
        </div>
        Edit Kategori
    </h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded-lg mb-4 border border-red-200">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-5 bg-white shadow-xl p-6 rounded-2xl border border-gray-100">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 mb-1 font-medium">Nama Kategori</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}"
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                placeholder="Masukkan nama kategori" required>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.categories.index') }}"
                class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">Batal</a>
            <button type="submit"
                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">Perbarui</button>
        </div>
    </form>
</div>
@endsection
