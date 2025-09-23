<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function index(Request $request) {
        $query = $request->input('q');
        $products = Product::where('name', 'LIKE', "%{$query}%")->get();
        return view('search.index');
    }
}
