<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::get();

        return view('products.index', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            return abort(404);
        }

        return view('products.single', compact('product'));
    }
}