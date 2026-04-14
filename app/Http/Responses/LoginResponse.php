<?php

namespace App\Http\Responses;

use App\Models\User;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = User::find(Auth::id());

        if ($user && $user->hasRole('admin')) {
            return redirect()->intended('/admin/dashboard');
        }

        return redirect()->intended(config('fortify.home'));
    }
}
