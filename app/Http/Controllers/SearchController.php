<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('query');

        $products = Product::where('name', 'LIKE', "%{$query}%")->get();
        return view('products.search', compact('products', 'query'));
    }
}
