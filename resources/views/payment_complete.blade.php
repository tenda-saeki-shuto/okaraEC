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
    <h2 class="text-2xl font-bold mt-5 mb-5 ml-[10%]">注文番号：{{ $order_code }}</h1>
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
                @foreach($order_details as $order_detail)
                    <tr>
                        <th>{{ $order_detail->item_name }}</th>
                        <td class="text-center">{{ $order_detail->price }}円</td>
                        <td class="text-center">{{ $order_detail->count }}</td>
                        <td class="text-center">{{ $order_detail->price * $order_detail->count }}円</td>
                    </tr>
                    <!-- 合計金額の更新 -->
                    <?php $total+= ($order_detail->price * $order_detail->count); ?>
                @endforeach
                @foreach($coupon_info as $coupon)
                    <tr>
                        <th>クーポン</th>
                        <td class="text-center">-{{ $coupon->discount }}円</td>
                        <td class="text-center">1</td>
                        <td class="text-center">-{{ $coupon->discount * 1 }}円</td>
                    </tr>
                    <!-- クーポンの計算 -->
                    <?php $total-= $coupon->discount * 1; ?>
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
    <form action="{{ route('done_payment') }}" method="post">
        @csrf
        <button type="submit">トップへ</button>
    </form>
</body>
</html>