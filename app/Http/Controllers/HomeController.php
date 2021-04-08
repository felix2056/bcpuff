<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $images = Carousel::orderBy('position', 'ASC')->get();
        $featured = Product::inRandomOrder()->limit(8)->get();

        foreach ($images as $image) {
            $image['url'] = '/storage/settings/carousel/' . $image->url;
        }

        return view('index', compact('images', 'featured'));
    }

    public function faqs()
    {
        return view('faqs');
    }

    public function orders()
    {
        $user = User::find(Auth::user()->id);
        $orders = $user->orders()->with('user')->get();

        return view('products.orders', compact('orders'));
    }
}
