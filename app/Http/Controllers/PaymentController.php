<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prefecture;
use App\Models\User;
use App\Models\Address;
use App\Models\UserCoupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart;
use App\Models\CreditCard;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{

    public function index(){
        // セッションに登録されているユーザーの情報を取得する
        $user_id = Auth::id();

        // ビューに渡すデータの取得
        // ログインしているユーザーの郵便番号・都道府県・住所・支払情報・所有しているクーポン
        $prefectures=Prefecture::all(); //全ての都道府県の名前

        // usersテーブルから郵便番号、住所、都道府県IDを取得
        $user_info = User::with(['addresses:id,user_id,postal_code,address,prefecture_id'])->where('id', $user_id)->first();
        $postal_code = $user_info->addresses->postal_code;
        $address = $user_info->addresses->address;
        $prefecture_id = $user_info->addresses->prefecture_id;
        // 都道府県IDから都道府県名を取得
        $prefecture = Prefecture::find($prefecture_id)->name;

        // 住所情報をセッションに保存
        session()->put('postal_code', $postal_code);
        session()->put('address', $address);
        session()->put('prefecture', $prefecture);
        session()->put('prefecture_id', $prefecture_id);

        // クレジットカード情報を取得
        $card_info = CreditCard::where('user_id',$user_id)->first();
        if(isset($card_info->card_number)){
            $card_num = $card_info->card_number;
            // カードの下４桁を取得
            $shown_num = substr($card_num, 12, 5);
        }else{
            $shown_num = null;
        }

        // カートに入っている商品の合計額を取得
        $cart_items = Cart::with(['items:id,price'])->where('user_id',$user_id)->get();
        $total = 0;
        foreach($cart_items as $cart_item){
            $total += $cart_item->count * $cart_item->items->price;
        }
        

        // 今日の日付を取得
        $today = new Carbon('today');

        // ユーザーが保有しているクーポンを取得(user_couponsテーブル)
        $coupons = UserCoupon::with(['coupons:id,name,content,discount,img'])->where('user_id',$user_id)->where('valid_at', '>', $today)->get();
        return view('payment_info', compact('prefectures', 'shown_num', 'coupons', 'total'));
    }

    // カード情報入力画面で「完了」が押された際の処理
    public function registerCard(Request $request){
        $user_id = Auth::id();
        //全ての都道府県の名前を取得
        $prefectures=Prefecture::all();

        // 今日の日付を取得
        $today = new Carbon('today');

        // ユーザーが保有しているクーポンを取得(user_couponsテーブル)
        $coupons = UserCoupon::with(['coupons:id,name,content,discount,img'])->where('user_id',$user_id)->where('valid_at', '>', $today)->get();
        
        // credit_cardsテーブルの書き換え
        // バリデーションを行う
        $validated_data = $request->validate([
            'card_number' => ['required', 'regex:/^[0-9]+$/', 'digits_between:13,19'],
            'month' => ['required', 'regex:/^[0-9]+$/', 'integer', 'between:1,12'],
            'year' => ['required', 'regex:/^[0-9]+$/', 'integer', 'min:0', 'max:99'],
            'cvc' => ['required', 'regex:/^[0-9]+$/', 'digits_between:3,4']
        ]);

        // 有効期限のチェック
        $month = $request->input('month');
        $year = $request->input('year');
        // yearの形4桁に変換
        if ($year < 100) {
            $year += 2000;
        }
        $expiration = \Carbon\Carbon::createFromDate($year, $month, 1)->endOfMonth();
        $now = now();

        if ($expiration->lt($now)) {
            // 有効期限が切れている場合
            return back()->withErrors(['month' => 'クレジットカードの有効期限が切れています。'])->withInput();
        }else{
            // 有効期限が切れていない場合
            $card_number = $request->card_number;
            $card_info = CreditCard::where('user_id', $user_id)->first();
            if($card_info == null){
                // credit_cardsテーブルにユーザーのクレカ情報がなければ、新規レコードを登録する
                $card = new CreditCard();
                $card->user_id = $user_id;
                $card->card_number = $card_number;
                $card->save();
            }else{
                // ユーザーのクレカ情報があれば、更新する
                $card_info->card_number = $card_number;
                $card_info->save();
            }

            // カートに入っている商品の合計額を取得
            $cart_items = Cart::with(['items:id,price'])->where('user_id',$user_id)->get();
            $total = 0;
            foreach($cart_items as $cart_item){
                $total += $cart_item->count * $cart_item->items->price;
            }
            
            // 表示する下４桁を取得
            $shown_num = substr($card_number, 12, 5);
            return view('payment_info', compact('prefectures', 'coupons', 'shown_num', 'total'));
        }
    }
    
    // 決済情報入力で「選択を外す」ボタンが押された際の処理
    public function unuseCoupon(){
        session()->forget('coupon_id');
         return response()->json([
            'status' => 'success',
            'coupon_id' => session('coupon_id'), // null になっているはず
        ]);
    }

    // 決済情報入力画面で「注文確認」ボタンが押されたときの処理
    public function confirm(Request $request)
    {
        // ログインしているユーザーのIDを取得
        $user_id = Auth::id();
        // ユーザーのカートに入っている商品のデータを取得(cartsテーブル)
        $carts = Cart::with(['items:id,name,price'])->where('user_id', $user_id)->get();

        // クレジットカード情報を取得
        $card_info = CreditCard::where('user_id',$user_id)->first();
        $card_num = $card_info->card_number;
        // カードの下４桁を取得
        $shown_num = substr($card_num, 12, 5);

        // 決済情報入力画面で選択されたクーポンの情報を取得し、セッションに保存
        $coupon_id = $request->coupon;
        $coupon = Coupon::where('id',$coupon_id)->first();
        session()->put('coupon_id', $coupon_id);

        // 決済情報入力画面で入力されたお届け先を取得(postal_code, prefecture(id), address, coupon(id))
        $postal_code = $request->postal_code;
        $prefecture = $request->prefecture;
        $address = $request->address;

        return view('payment_confirm', compact('carts', 'shown_num', 'coupon', 'postal_code', 'prefecture', 'address'));
    }

    // 決済確認画面で「戻る」ボタンが押された際に決済情報入力画面にクーポンと住所の情報を送る処理
    public function changePaymentInfo(Request $request){
        $user_id = Auth::id();

        // クレジットカード情報を取得
        $card_info = CreditCard::where('user_id',$user_id)->first();
        if(isset($card_info->card_number)){
            $card_num = $card_info->card_number;
            // カードの下４桁を取得
            $shown_num = substr($card_num, 12, 5);
        }else{
            $shown_num = null;
        }

        // 合計金額
        $cart_items = Cart::with(['items:id,price'])->where('user_id',$user_id)->get();
        $total = 0;
        foreach($cart_items as $cart_item){
            $total += $cart_item->count * $cart_item->items->price;
        }

        $prefectures=Prefecture::all(); //全ての都道府県の名前

        // 今日の日付を取得
        $today = new Carbon('today');

        // ユーザーが保有しているクーポンを取得(user_couponsテーブル)
        $coupons = UserCoupon::with(['coupons:id,name,content,discount,img'])->where('user_id',$user_id)->where('valid_at', '>', $today)->get();
        return view('payment_info', compact('prefectures', 'coupons', 'shown_num', 'total'));
    }


    // 決済情報確認画面で確定が押された際のDB処理(ordersテーブルにレコードを追加)
    public function showOrders(){
        // ログインしているユーザーのIDを取得
        $user_id = Auth::id();

        // クレジットカード情報
        $card = CreditCard::where('user_id', $user_id)->first();

        // 住所情報
        $address = Address::with(['prefecture:id,name'])->where('user_id', $user_id)->first();
        
        // ユーザー情報
        $user = User::where('id', $user_id)->first();

        // ordersテーブルの更新
        $order = new Order();
        $order->user_id = $user_id;
        $order->order_code = 12345678;
        $order->dateTime = Carbon::now();
        $order->status = 1;
        $order->is_regular = 0;
        $order->payment = 'クレジットカード'; //credit_cardsテーブルのcard_number
        $order->postal_code = $address->postal_code;  //addressesテーブルのpostal_code
        $order->prefecture = $address->prefecture->name;  //addressesテーブルのprefecture
        $order->address = $address->address;  //addressesテーブルのaddress
        $order->email = $user->email;  //usersテーブルのemail
        $order->tel = $user->tel;  //usersテーブルのtel
        $order->save();

        // order_detailsテーブルの更新
        $carts = Cart::with(['items:id,name,price'])->where('user_id', $user_id)->get();
        foreach($carts as $cart){
            $order_detail = new OrderDetail();
            $order_detail->order_id = $order->id;
            $order_detail->item_name = $cart->items->name;
            $order_detail->price = $cart->items->price;
            $order_detail->count = $cart->count;
            $order_detail->save();
        }

        // クーポン情報を取り出す
        $coupon_id = session('coupon_id');
        $coupon_info = Coupon::where('id', $coupon_id)->get();

        // ビューに返す注文情報を取得
        $orders = Order::with(['orderDetails:id,order_id,item_name,price,count'])
        ->where('user_id', $user_id)
        ->orderBy('created_at', 'desc')
        ->take(1) //直近の注文のみ取得
        ->get();
        foreach($orders as $order_record){
            $order_details = $order_record->orderDetails;
            // 注文番号の取得
            $order_code = $order_record->order_code;
        }

        // セッション情報の削除
        session()->forget(['postal_code', 'address', 'prefecture', 'prefecture_id']);

        // カートの中を消す
        Cart::where('user_id', $user_id)->delete();

        return view('payment_complete', compact('order_code', 'order_details', 'coupon_info'));
    }



    public function validateAddress(Request $request){
        // 郵便番号と住所のバリデーションを行う
        $validated_data = $request->validate([
            'postal_code' => ['required', 'regex:/^\d{7}$/'], //郵便番号
            'address' => ['required'], //住所
            'prefecture_id' => ['required']  // 都道府県
        ]);
        // 都道府県IDから都道府県名を取得
        $prefecture = Prefecture::find($validated_data['prefecture_id'])->name;

        // セッション情報の上書き
        session()->put('postal_code', $validated_data['postal_code']);
        session()->put('address', $validated_data['address']);
        session()->put('prefecture', $prefecture);
        session()->put('prefecture_id', $validated_data['prefecture_id']);

        return response()->json([
            'postal_code' => session('postal_code'),
            'address' => session('address'),
            'prefecture' => session('prefecture'),
            'prefecture_id' => session('prefecture_id'),
        ]);
    }

    // 決済完了画面で「トップへ」が押された際の処理
    public function donePayment(){
        $user_id = Auth::id();
        
        // クーポンのセッションを消す
        session()->forget('coupon_id');

        // トップ画面にリダイレクトする
        return redirect()->route('top');
    }
}
