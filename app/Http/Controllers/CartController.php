<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Item;
use App\Models\UserCoupon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // $user_idにはセッションに保存されているユーザーIDを入れる
        $user_id = Auth::id();
        // カートに入っている商品の情報を取得
        $carts = Cart::with(['items:id,name,price,stock'])->where('user_id', $user_id)->get();

        // 今日の日付を取得
        $today = new Carbon('today');
        
        // ユーザーが保有しているクーポン（有効なもの）を取得する
        $validCoupons = UserCoupon::where('user_id', $user_id)->get();
        

        return view('cart', compact('carts', 'validCoupons'));
    }

    public function delete($id)
    {
        $cart_item = Cart::where('item_id',$id)->first();
        $cart_item->delete();
        // 削除したらカート画面にリダイレクト
        return redirect()->route('cart');
    }

    public function ajaxUpdate(Request $request)
    {
        $user_id = Auth::id();
        // カート情報を取得し更新
        $cart = Cart::with(['items:id,price'])->where('user_id', $user_id)->where('item_id', $request->id)->first();
        $cart->count = $request->count;
        $cart->save();
        // $total = $cart->items->price * $cart->count;

        // 合計金額の計算
        $total = 0;
        $allCart = Cart::with(['items:id,price'])->where('user_id', $user_id)->get();
        foreach($allCart as $cart_item){
            $total += $cart_item->count * $cart_item->items->price;
        }

        return response()->json([
            'message' => '数量を更新しました',
            'count' => $cart->count,
            'total' => $total,
        ]);
    }

    public function update($id, Request $request)
    {
        $user_id = Auth::id();
        // カート情報を取得し更新
        $cart = Cart::where('user_id', $user_id)->where('item_id', $id)->first();
        $cart->count = $request->count;
        $cart->save();
        return redirect()->route('item_detail', ['id'=>$id]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer',
            'count' => 'required|integer|min:1'
        ]);

        //ユーザー情報を取得
        $user = Auth::user();

        try {
            Cart::create([
                'user_id' => $user->id,
                'item_id' => $request->item_id,
                'count' => $request->count
            ]);

            return redirect()->back()->with('success', 'カートに追加しました');
        } catch (\Exception $e) {
            return redirect(route('login'));
        }
    }
}


// cartsテーブルからuser_idが現在ログインしているユーザーのidと一致するものを取り出す
