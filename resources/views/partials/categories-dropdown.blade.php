{{-- Dropdown kategori otomatis dari database --}}
@php
    use App\Models\Category;
    $categories = Category::orderBy('name')->get();
@endphp

<div class="bg-white shadow-lg rounded-lg w-80 border border-gray-200 overflow-hidden">
    <!-- Header -->
    <div class="px-4 py-3 border-b border-gray-100">
        <p class="font-semibold text-gray-800 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" class="w-5 h-5 text-emerald-500">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            Kategori Populer
        </p>
    </div>

    <!-- Daftar Kategori -->
    @if($categories->count() > 0)
        <ul class="max-h-80 overflow-y-auto divide-y divide-gray-100">
            @foreach($categories as $category)
                <li>
                    {{-- <a href="{{ route('category.show', $category->slug) }}"
                       class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-colors">
                        <div class="w-8 h-8 bg-emerald-100 text-emerald-600 flex items-center justify-center rounded-md font-semibold">
                            {{ strtoupper(substr($category->name, 0, 1)) }}
                        </div>
                        <span class="text-sm font-medium">{{ $category->name }}</span>
                    </a> --}}
                    <a href="{{ route('category.show', $category->slug) }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-md transition-colors
                            {{ request()->is('kategori/' . $category->slug) 
                                ? 'bg-emerald-100 text-emerald-600 font-semibold' 
                                : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-600' }}">
                    <span class="text-sm font-medium">{{ $category->name }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <div class="p-4 text-center text-gray-400 text-sm">
            Belum ada kategori tersedia.
        </div>
    @endif

    <!-- Footer -->
    <div class="px-4 py-3 border-t border-gray-100 text-center">
        <a href="{{ route('main') }}" 
           class="text-emerald-600 hover:text-emerald-700 text-sm font-medium transition">
            Lihat Semua Produk →
        </a>
    </div>
</div>
