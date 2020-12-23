<?php

namespace App\Helper;

use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function redirectIfAuth()
    {
        if (Auth::check()) {
            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.index');
            }

            return redirect()->route('account.index');
        }

    }

    //Set route active for both parent and children
    public static function setActive($path, $active = 'active') 
    {
        return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }

    //Set route active for exact route name
    public static function setActiveExact($path, $active = 'active') 
    {
        return call_user_func('Route::is', $path) ? $active : '';
    }

    public static function calculateTax($percent, $total) {
        return round($percent * ($total / 100), 2);
    }
}
