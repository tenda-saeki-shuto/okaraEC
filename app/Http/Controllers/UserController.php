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


class UserController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index()
    {
        $users = User::all();

        $prefectureData = [];
        foreach ($users as $user) {
            // dd($user->address->prefecture->name); // $user->prefecture で確認可能
            // $address = Address::where('user_id', $user->id)->first();
            // $pref = Prefecture::where('id', $address->prefecture_id)->first();
            // $prefectureData[$user->id] = $pref->name;
        }
        return view('admin.user_index', compact('users', 'prefectureData'));
    }

    public function edit(User $user)
    {
        $prefecture = Prefecture::orderBy('id')->get();
        return view('admin.user_edit', compact('user', 'prefecture'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
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


    //退会処理
    public function withdrawal(Request $request)
    {

        if ($request->input('confirm') === 'true') {
            $user = Auth::user();
            $user->delete();
            Auth::logout();
            return redirect(route('top'));
        } else {
            return redirect(route('view.mypage'));
        }
    }
}
