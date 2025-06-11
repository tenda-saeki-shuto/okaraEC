<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prefecture;
use App\Models\User;
use App\Models\Address;
use App\Models\UserCoupon;


class PaymentController extends Controller
{

    public function index(){
        // セッションに登録されているユーザーの情報を取得する
        $user_id = 1;

        // ビューに渡すデータの取得
        // ログインしているユーザーの郵便番号・都道府県・住所・支払情報・所有しているクーポン
        $prefectures=Prefecture::all(); //全ての都道府県の名前

        // usersテーブルから郵便番号、住所、都道府県IDを取得
        $user_info = User::with(['addresses:id,user_id,postal_code,address,prefecture_id'])->where('id', $user_id)->get();

        // 都道府県IDから都道府県名を取得
        foreach($user_info as $info){
            $prefecture_id = $info->addresses->prefecture_id;        
        }
        $user_prefecture = Prefecture::find($prefecture_id)->name;

        // ユーザーが保有しているクーポンを取得(user_couponsテーブル)
        $coupon = UserCoupon::with(['coupons:id,name,content,discount,img,valid_date'])->where('user_id',$user_id)->where('available',1)->get();

        return view('payment_info', compact('prefectures', 'user_info', 'user_prefecture', 'coupon'));
    }



    public function confirm(Request $request)
    {
        // 郵便番号と住所のバリデーションを行う
        $validated_data = $request->validate([
            'postal_code' => ['required', 'regex:/^\d{7}$/'], //郵便番号
            'address' => ['required'], //住所
        ]);

        return view('payment_confirm', compact('validated_data'));
    }

    public function update($id){
        // お届け住所の変更処理
        return true;
    }
}
