<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

use App\Helper\Helper;

class LoginResponse implements LoginResponseContract
{

    /**
     * @inheritDoc
     */
    public function toResponse($request)
    {
        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            // : Helper::redirectIfAuth();
            : redirect()->intended(config('fortify.home')); // This is the line you want to modify so the application behaves the way you want.
    }
}