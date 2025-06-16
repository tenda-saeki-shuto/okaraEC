<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('/css/cart.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>注文履歴の詳細</title>
</head>
<body class="h-screen flex flex-col w-full items-center">
    <!-- ヘッダー入れる -->
    @include('user.user_header')
    
    <div class="container w-[70%]">
        <h1 class="text-3xl font-bold mb-5 mt-20">注文履歴の詳細</h1>        

        
            <div class="mb-5 mt-5">
                <h2 class="text-2xl font-bold">お届け先</h2>
                <div>
                    <label class="text-lg">郵便番号</label>
                    <p>〒{{ $order_list->postal_code }}</p>
                </div>
                <div class="mt-4">
                    <label for="prefecture" class="text-lg">住所</label>
                    <p>{{ $order_list->prefecture }}{{ $order_list->address }}</p>
                </div>
            </div>
    
            <div class="mb-5">
                <h2 class="text-2xl font-bold mb-3">支払い情報</h2>
                <p>{{ $order_list->payment }}</p>
            </div>

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
                    @foreach($order_list->orderDetails as $order)
                        <tr>
                            <td class="text-center">{{ $order->item_name }}</td>
                            <td class="text-center">{{ $order->price }}円</td>
                            <td class="text-center">{{ $order->count }}</td>
                            <td class="text-center">{{ $order->price * $order->count }}円</td>
                        </tr>

                    @endforeach
                </tbody>
                <tfoot class="font-bold">
                    <tr>
                        <th scope="row" colspan="3" class="text-right">合計金額（税込）</th>
                        <td class="text-center">{{ $order_list->total_price }}円</td>
                    </tr>
                </tfoot>
            </table>

            <br>
            <a href="{{ route('orders') }}" class="w-auto p-3 bg-sky-500 h-10 rounded-xl text-white font-black text-xl mt-10">戻る</a>
    </div>
</body>
</html>