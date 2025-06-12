<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Address;
use App\Models\Prefecture;


class ProfileController extends Controller
{
    public function index()
    {
        $profile = User::where('id', 4)->first();
        var_dump($profile->id);
        return view("profile.edit", compact("profile"));
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        // dd($request->all());
        $prefecture = Prefecture::all();
        return view('profile.edit', [
            'user' => $request->user(),
            'prefecture'=> $prefecture,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());
        // dd($request->validated());
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->save();
        // $address = $request->validated('address','postal_code');
        // dd($request->validated('postal_code'));
        $request->user()->address->update([
            'postal_code'=> $request->validated('postal_code'),
            'prefecture_id'=> $request->validated('prefecture_id'),
            'address'=> $request->validated('address'),
        ]);

        return Redirect::route('userinfo.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show()
    {
        $user = Auth::user()->load([
            'address.prefecture' //ネストされたリレーションの一括読み込み
        ]);

        //パスワードを除いて表示する
        return view('user.mypage', compact('user'));
    }
}


