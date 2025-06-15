<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\UserCoupon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserCouponController extends Controller
{
    public function index()
    {
        //  ユーザーidを取得
        $user_id = Auth::user()->id;
        // ユーザーのクーポンとその情報を一括取得
        $user_coupons = UserCoupon::with('coupons')
            ->where('user_id', $user_id)
            ->get();


        return view('user.coupon', compact('user_coupons'));
    }
}
