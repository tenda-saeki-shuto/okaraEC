<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\prefectures;
use App\Models\Address;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $prefectures = prefectures::orderBy('id')->get();
        return view('auth.register', compact('prefectures'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8', 'max:20', Rules\Password::defaults()],
            'postal_code' => ['required', 'regex:/^\d{7}$/'], //郵便番号
            'prefecture_id' => ['required', 'exists:prefectures,id'],  // 都道府県
            'address' => ['required'], //住所
            'tel' => ['required', 'regex:/^\d{11}$/'], //電話番号
        ]);

        //userの登録
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //addressの登録
        $address = Address::create([
            'user_id' => $user->id,
            'postal_code' => $request->postal_code,
            'prefecture_id' => $request->prefecture_id,
            'address' => $request->address,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}

    // public function create() {
    //     //都道府県をすべて取得
    //     $prefectures=Prefecture::orderBy('name')->get();

    //     //登録フォームのviewに渡す
    //     return view('auth.register'.compact('prefectures'));

    // }

    // public function store(Request $request)
    // {
    //     $validated=""
    // }

