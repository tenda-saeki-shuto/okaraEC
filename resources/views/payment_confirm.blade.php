<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('/css/cart.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>決済情報入力</title>
</head>
<body class="h-screen flex flex-col w-full items-center">
    <!-- ヘッダー入れる -->
    @include('user.user_header')
    
    <div class="container w-[70%]">
        <h1 class="text-3xl font-bold mb-5 mt-20">決済確認</h1>
        <p class="text-lg mb-5">以下の内容で注文します（まだ注文は確定していません）</p>
        

        <h2 class="text-2xl font-bold mb-3">注文確認</h2>
        <!-- テーブル入れる -->
         <table>
            <thead>
                <tr class="bg-gray-200">
                    <th>商品名</th>
                    <th>単価</th>
                    <th>数量</th>
                    <th>小計</th>
                </tr>
            </thead>
            <tbody>
                <!-- 合計金額の初期値を設定 -->
                <?php $total=0; ?>
                @foreach($carts as $cart)
                    <tr>
                        <th>{{ $cart->items->name }}</th>
                        <td class="text-center">{{ $cart->items->price }}円</td>
                        <td class="text-center">{{ $cart->count }}</td>
                        <td class="text-center">{{ $cart->items->price * $cart->count }}円</td>
                    </tr>
                    <!-- 合計金額の更新 -->
                    <?php $total+= $cart->items->price * $cart->count; ?>
                @endforeach
                @if($coupon != null)
                    <tr>
                        <th scope="row" colspan="3" class="text-right">クーポン</th>
                        <td class="text-center">-{{ $coupon->discount }}円</td>
                    </tr>
                    <!-- クーポンの計算 -->
                    <?php $total-= $coupon->discount; ?>
                @endif
            </tbody>
            <tfoot class="font-bold">
                <tr>
                    <th scope="row" colspan="3" class="text-right">合計金額（税込）</th>
                    <td class="text-center">{{ $total }}円</td>
                </tr>
            </tfoot>
        </table>
            <div class="mb-5 mt-5">
                <h2 class="text-2xl font-bold">お届け先</h2>
                <div>
                    <label class="text-lg">郵便番号</label>
                    <p>{{ session('postal_code') }}</p>
                    <input type="hidden" name="postal_code" value="{{ $postal_code }}">
                </div>
                <div class="mt-4">
                    <label for="prefecture" class="text-lg">都道府県</label>
                    <p>{{ session('prefecture') }}</p>
                    <input type="hidden" name="prefecture" value="{{ $prefecture }}">
                </div>
                <div class="mt-4">
                    <label for="address" class="text-lg w-full">住所</label>
                    <p>{{ session('address') }}</p>
                    <input type="hidden" name="address" value="{{ $address }}">
                </div>
            </div>
    
            <div class="mb-5">
                <h2 class="text-2xl font-bold mb-3">支払い情報</h2>
                <p>クレジットカード</p>
                <p>カード情報末尾{{ $shown_num }}</p>
            </div>
            <a href="{{ route('revise_insert_payment') }}" class="w-auto p-3 bg-sky-500 h-10 rounded-xl text-white font-black text-xl mt-10">戻る</a>
            <a href="{{ route('show_orders') }}" class="w-auto p-3 bg-sky-500 h-10 rounded-xl text-white font-black text-xl mt-10">確定</a>
    </div>
</body>
</html>