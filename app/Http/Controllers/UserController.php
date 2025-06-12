<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Container\Attributes\Auth as AttributesAuth;

class UserController extends Controller
{
    public function withdrawal(Request $request)
    {

        if ($request->input('confirm') === 'true') {
            $user = Auth::user();
            $user->delete();
            Auth::logout();
            return redirect(route('/'));
        } else {
            return redirect(route('view.mypage'));
        }
    }
}
