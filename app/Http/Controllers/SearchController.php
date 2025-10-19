<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function index(Request $request) {
        $query = $request->input('q');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $sort = $request->input('sort');

        // Start building the query
        $productsQuery = Product::query()->where('is_active', true);

        // Search by name or description
        if ($query) {
            $productsQuery->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            });
        }

        // Filter by minimum price
        if ($minPrice) {
            $productsQuery->where('price', '>=', $minPrice);
        }

        // Filter by maximum price
        if ($maxPrice) {
            $productsQuery->where('price', '<=', $maxPrice);
        }

        // Apply sorting
        switch ($sort) {
            case 'price_asc':
                $productsQuery->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $productsQuery->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $productsQuery->orderBy('name', 'desc');
                break;
            default:
                $productsQuery->orderBy('created_at', 'desc');
                break;
        }

        // Paginate the results
        $products = $productsQuery->paginate(12)->withQueryString();

        return view('search.index', compact('products', 'query'));
    }
}
