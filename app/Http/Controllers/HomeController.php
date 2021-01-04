<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Order;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
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

    public function sendMail(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $orders = $user->orders()->with('user')->get();

        return view('products.orders', compact('orders'));
    }
}
