<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    { // 商品名、種類名、最終更新日、在庫

        $user = Auth::user();
        $orders_list = Order::with('orderDetails')
            ->where('user_id', $user->id)
            ->get();

        foreach ($orders_list as $order) {
            $total = 0;
            foreach ($order->orderDetails as $detail) {
                $total += $detail->price * $detail->count;
            }
            $order->total_price = $total;
        }
        
        return view('user.orders', compact('orders_list'));
    }
    public function show($id)
    {
        $order = Order::with('orderDetails')->find($id); // 例：1件だけ取得

        // 合計金額計算
        $total = 0;
        foreach ($order->orderDetails as $detail) {
            $total += $detail->price * $detail->count;
        }
        $order->total_price = $total;

        // dd($order->payment);

        return view('user.order_detail', compact('order'));
    }

}
