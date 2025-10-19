<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;


class MainController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $categoryFilter = $request->input('category', '');

        $query = Product::query();

        $query->when($search, function ($q, $search) {
            return $q->where('name', 'like', '%' . $search . '%');
        });

        $query->when($categoryFilter, function ($q, $categoryFilter) {

            return $q->whereHas('category', function ($categoryQuery) use ($categoryFilter) {
                // $categoryQuery->where('slug', $categoryFilter); // Lebih baik pakai slug
                $categoryQuery->where('name', $categoryFilter);
            });
        });

        // Ambil semua kategori untuk ditampilkan di dropdown filter
        $categories = Category::all();

        // Ambil data produk yang sudah difilter, urutkan terbaru, dan paginasi
        $products = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        // Kirim data ke view
        return view('index', [
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => $categoryFilter,
            'currentSearch' => $search
        ]);
    }

    public function show($id)
    {
        return view('products.index', ['product' => Product::findOrFail($id)]);
    }
}
