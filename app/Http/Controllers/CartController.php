<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

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
            return redirect()->back()->with('error', 'カートへの追加に失敗しました。もう一度お試しください');
        }
    }
}


// cartsテーブルからuser_idが現在ログインしているユーザーのidと一致するものを取り出す
