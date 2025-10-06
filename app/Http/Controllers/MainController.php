<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input dari request
        $search = $request->input('search', '');
        $categoryFilter = $request->input('category', '');

        // Mulai query produk
        $query = Product::with('category')->where('is_active', true);

        // Jika ada pencarian
        if (!empty($search)) {
            $query->where('name', 'like', "%{$search}%");
        }

        // Jika ada filter kategori
        if (!empty($categoryFilter)) {
            $query->whereHas('category', function ($q) use ($categoryFilter) {
                // Cek apakah categoryFilter adalah ID atau slug
                if (is_numeric($categoryFilter)) {
                    $q->where('id', $categoryFilter);
                } else {
                    $q->where('slug', $categoryFilter)
                      ->orWhere('name', $categoryFilter);
                }
            });
        }

        // Ambil semua kategori untuk sidebar/dropdown
        $categories = Category::all();

        // Ambil produk dengan paginasi
        $products = $query->latest()->paginate(12)->withQueryString();

        // Kirim data ke view index
        return view('index', [
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => $categoryFilter,
            'currentSearch' => $search,
        ]);
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.index', compact('product'));
    }

    // Tambahan: Halaman kategori langsung (untuk route /kategori/{slug})
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $products = Product::where('category_id', $category->id)
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        $categories = Category::all();

        return view('category.show', [
            'category' => $category,
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => $category->slug,
            'currentSearch' => '',
        ]);
    }
}
