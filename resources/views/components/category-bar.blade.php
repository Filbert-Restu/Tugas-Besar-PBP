<aside class="lg:w-56 flex-shrink-0 h-full">
    <div class="bg-teal-50 rounded-xl p-5 sticky top-20">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Kategori</h2>
        <ul class="space-y-2 font-bold">
            {{-- semua kategori --}}
            <li>
                <a href="{{ route('main', ['category' => null]) }}"
                    class="block text-gray-700 hover:text-teal-600 hover:bg-teal-100 px-3 py-2 rounded-lg transition text-sm {{ $currentCategory === null ? 'bg-teal-100 text-teal-600 font-semibold' : '' }}">
                    Semua
                </a>
            @foreach($categories as $category)
            <li>
                <a href="{{ route('main', ['category' => $category->name]) }}"
                    class=" block text-gray-700 hover:text-teal-600 hover:bg-teal-100 px-3 py-2 rounded-lg transition text-sm {{ $currentCategory === $category ? 'bg-teal-100 text-teal-600 font-semibold' : '' }}">
                    {{ $category->name }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</aside>

