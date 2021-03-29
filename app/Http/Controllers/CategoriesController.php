<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    public function create(Request $request)
    {
        $rules = [
            'cat_name' => 'required|min:5|max:1000'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Be sure to fill up all required fields!')->withErrors($validator)->withInput();
        }

        $category = new Category();
        $category->name = $request->cat_name;
        $category->save();

        return redirect()->back()->with('cat_success', 'Successfully Added New Category: ' . $category->name);
    }

    public function destroy(Request $request, $id)
    {
        $category = Category::find($request->category_id);

        if (!$category) {
            return redirect()->back()->with('error', 'This category does not exist!');
        }

        $products = $category->products()->get();

        if (count($products) > 0) {
            foreach ($products as $product) {
                $product->category_id = 0;
                $product->save();
            }
        }

        $category->delete();

        return redirect()->back()->with('cat_success', 'Category has been deleted!');
    }
}
