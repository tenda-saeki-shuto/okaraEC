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
use App\Models\Prefecture;
use App\Models\Address;
use App\Models\UserCoupon;
use App\Models\Coupon;
use Carbon\Carbon;

use App\Http\Controllers\Traits\HandlesGuestQuiz;


class RegisteredUserController extends Controller
{
    use HandlesGuestQuiz;

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $prefecture = Prefecture::orderBy('id')->get();
        return view('auth.register', compact('prefecture'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:7', 'max:20'],
            'postal_code' => ['required', 'digits:7'], //郵便番号
            'prefecture_id' => ['required', 'exists:prefectures,id'],  // 都道府県
            'address' => ['required'], //住所
            'tel' => ['required', 'regex:/^\d{10,11}$/']
        ]);

        //userの登録
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'tel' => $request->tel,
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

        //ゲストクイズ処理
        $this->handleGuestQuizAfterLogin();


        $redirect = session('redirect_after_login', route('top'));
        session()->forget('redirect_after_login');

        //新規登録後のクーポン発行
        $now = Carbon::now(); //今の日付
        $base_day = $now->day; //今の日にち
        $two_months_later = $now->copy()->addMonths(2); //2か月後の日付
        $valid_at = $base_day > $two_months_later->daysInMonth //2か月後に日にちがなければ
            ? $two_months_later->endOfMonth() //月末に
            : $two_months_later->day($base_day); //そうでなければその日に

        $coupon = Coupon::find(1);

        //クーポン追加
        UserCoupon::create(
            [
                'user_id' => $user->id,
                'coupon_id' => $coupon->id,
                'valid_at' => $valid_at
            ]
        );

        //セッションに新規登録でクーポンを発行したことを保存
        session()->flash('coupon_register', 'クーポンを獲得しました');


        return redirect($redirect);
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
