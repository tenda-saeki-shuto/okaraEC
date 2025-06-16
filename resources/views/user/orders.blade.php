<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('/css/cart.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>注文履歴</title>
</head>
<body class="h-screen flex flex-col w-full items-center">
    <!-- ヘッダー入れる -->
    @include('user.user_header')
    
    <div class="container w-[70%]">
        <h1 class="text-3xl font-bold mb-5 mt-20">注文履歴</h1>
        <p class="text-lg mb-5">※定期購入は緑色で表示しています</p>
        
        <h2 class="text-2xl font-bold mb-3">注文確認</h2>
        <!-- テーブル入れる -->
         <table>
            <thead>
                <tr class="bg-gray-200">
                    <th>注文日</th>
                    <th>注文番号</th>
                    <th>合計金額</th>
                </tr>
            </thead>
            <tbody>
                <!-- 合計金額の初期値を設定 -->
                @foreach($orders_list as $order)
                    <tr>
                    <td>
                        <a href="{{ route('orders.show', ['order' => $order->id]) }}" class="text-blue-600 underline">
                            {{ \Carbon\Carbon::parse($order->dateTime)->format('Y年m月d日') }}
                        </a>
                    </td>
                    <td class="text-center">{{ $order->order_code }}</td>
                    <td class="text-center">{{ $order->total_price }}円</td>
                    </tr>
                @endforeach
            </tbody>
        </table>           
    </div>
</body>
</html>