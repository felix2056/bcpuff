<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $data = [];

        $data['top_sellers'] = Product::orderby('sales', 'DESC')->get();

        return view('account.index', compact('data'));
    }
}
