<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function create()
    {
        return view('admin.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'admin_id' => ['required'],
            'password' => ['required'],
        ]);
        // $credentials['password'] = Hash::make($credentials['password']);
        // dd(Hash::make($request->password));
        // dd($credentials);
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/admin/top')->with([
                'message' => 'ログインしました'
            ]);
        }

        return back()->withErrors([
            'message' => 'IDかパスワードが間違っています',
        ])->onlyInput('admin_id');
    }

    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return to_route('admin.login');
    }

}
