<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::get();

        if ($request->category && $request->id) {
            $category = Category::find($request->id);

            if ($category) {
                $products = Product::where('category_id', $category->id)->get();
            }
        }

        return view('products.index', compact('products', 'categories'));
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