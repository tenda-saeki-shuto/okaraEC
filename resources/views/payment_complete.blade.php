<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('/css/cart.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>カートの中身</title>
</head>
<body>
    <!-- ヘッダー入れる -->
    @include('user.user_header')
    
    <p class="text-3xl font-bold mt-5 mb-5 ml-[10%]">以下の内容で注文完了しました。</p>
    <p class="text-3xl font-bold mt-5 mb-5 ml-[10%]">ありがとうございました。</p>
    @foreach($orders as $order)
    <h2 class="text-2xl font-bold mt-5 mb-5 ml-[10%]">注文番号：{{ $order->order_code }}</h1>
    <div class="flex flex-col items-center w-full">
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
                    @foreach($order->orderDetails as $detail)
                    <tr>
                        <th>{{ $detail->item_name }}</th>
                        <td class="text-center">{{ $detail->price }}円</td>
                        <td class="text-center">{{ $detail->count }}</td>
                        <td class="text-center">{{ $detail->price * $detail->count }}円</td>
                    </tr>
                    <tr>
                        <th>クーポン</th>
                        <th>-500円</th>
                        <th>1</th>
                        <th>-500円</th>
                    </tr>
                    @endforeach

                <!-- 合計金額の更新 -->
                <?php $total+= ($detail->price * $detail->count) - 500; ?>
        @endforeach
            </tbody>
            <tfoot class="font-bold">
                <tr>
                    <th scope="row" colspan="3" class="text-right">合計金額（税込）</th>
                    <td class="text-center">{{ $total }}円</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <a href="{{ route('insert_payment') }}" class="no-underline px-6 py-2 bg-sky-500 rounded-xl text-white font-black text-xl mt-10 ml-[80%] inline-block">トップへ</a>
</body>
</html>