<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        // $user_idにはセッションに保存されているユーザーIDを入れる
        $user_id = 1;
        $carts = Cart::with(['items:id,name,price'])->where('user_id', $user_id)->get();
        // dd($carts);
        return view('cart', compact('carts'));
    }

    public function delete($id)
    {
        $cart_item = Cart::find($id);
        $cart_item->delete();
        // 削除したらカート画面にリダイレクト
        return redirect()->route('cart');
    }

    public function update($id, $count)
    {

        // DB処理を追加
        // カート情報を取得し更新
        $cart = Cart::find($id);
        $cart->count = $count;
        $cart->save();


        return response()->json([
        'message' => '数量を更新しました',
        'id' => $id,
        'new_count' => $count
    ]);
    }
}


// cartsテーブルからuser_idが現在ログインしているユーザーのidと一致するものを取り出す

