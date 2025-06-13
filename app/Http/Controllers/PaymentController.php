<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prefecture;
use App\Models\User;
use App\Models\Address;
use App\Models\UserCoupon;
use App\Models\Order;
use App\Models\Cart;
use App\Models\CreditCard;


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
        // ログインしているユーザーのIDを取得
        $user_id = 1;
        // ユーザーのカートに入っている商品のデータを取得(cartsテーブル)
        $carts = Cart::with(['items:id,name,price'])->where('user_id', $user_id)->get();

        // クレジットカード情報を取得
        $card_info = CreditCard::where('user_id',$user_id)->get();
        foreach($card_info as $info){
            $card_num = $info->card_number;
        }
        // カードの下４桁を取得
        $shown_num = substr($card_num, 12, 5);

        // 決済情報入力画面で選択されたクーポンの情報を取得
        $coupon = $request->coupon;

        // 決済情報入力画面で入力されたお届け先を取得(postal_code, prefecture(id), address, coupon(id))
        $postal_code = $request->postal_code;
        $prefecture = $request->prefecture;
        $address = $request->address;

        return view('payment_confirm', compact('carts', 'shown_num', 'coupon', 'postal_code', 'prefecture', 'address'));
    }

    // 決済確認画面で「戻る」ボタンが押された際に決済情報入力画面にクーポンと住所の情報を送る処理
    public function changePaymentInfo(Request $request){
        $postal_code = $request->postal_code;
        $user_prefecture = $request->prefecture;
        $address = $request->address;
        $prefectures=Prefecture::all(); //全ての都道府県の名前
        return view('payment_info', compact('postal_code', 'user_prefecture', 'address', 'prefectures'));
    }


    // 決済情報確認画面で確定が押された際のDB処理
    public function executePayment(){

    }



    public function validateAddress(Request $request){
        // 郵便番号と住所のバリデーションを行う
        $validated_data = $request->validate([
            'postal_code' => ['required', 'regex:/^\d{7}$/'], //郵便番号
            'address' => ['required'], //住所
        ]);
    }
}
