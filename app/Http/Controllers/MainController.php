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
        // Ambil input dari request dengan nilai default
        $search = $request->input('search', '');
        $categoryFilter = $request->input('category', ''); // Sebaiknya gunakan slug atau ID kategori

        // Mulai query builder Eloquent, jangan ambil datanya dulu
        $query = Product::query();

        // Terapkan filter pencarian jika ada isinya
        // Method `when` sangat efektif untuk query kondisional
        $query->when($search, function ($q, $search) {
            // Mencari di kolom 'name' (case-insensitive dengan ILIKE untuk PostgreSQL, atau sesuaikan)
            return $q->where('name', 'like', '%' . $search . '%');
        });

        // Terapkan filter kategori jika ada isinya dan bukan 'Semua'
        $query->when($categoryFilter, function ($q, $categoryFilter) {
            // Filter berdasarkan relasi. Ini lebih fleksibel.
            // Asumsi $categoryFilter adalah slug atau nama kategori.
            return $q->whereHas('category', function ($categoryQuery) use ($categoryFilter) {
                $categoryQuery->where('slug', $categoryFilter); // Lebih baik pakai slug
                // atau $categoryQuery->where('name', $categoryFilter);
            });
        });

        // Ambil semua kategori untuk ditampilkan di dropdown filter
        $categories = Category::all();

        // Eksekusi query: ambil hasilnya, urutkan dari yang terbaru, dan gunakan paginasi
        // Paginasi sangat penting untuk performa
        $products = $query->latest()->paginate(12)->withQueryString();

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
