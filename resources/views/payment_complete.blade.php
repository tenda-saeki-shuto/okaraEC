<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>カートの中身</title>
</head>
<body class="bg-white font-sans text-gray-800 m-0 p-0">
    <!-- ヘッダー入れる -->
    @include('user.user_header')

    <div class="max-w-5xl mx-auto mt-8 p-6">
        <div class="mx-10 flex flex-col items-start">
            <p class="text-3xl font-bold mt-5 mb-5">以下の内容で注文完了しました。</p>
            <p class="text-3xl font-bold mt-5 mb-5">ありがとうございました。</p>
            <h2 class="text-2xl font-bold mt-5 mb-5">注文番号：{{ $order_code }}</h1>
        </div>
        <div class="max-w-4xl mx-auto overflow-hidden rounded-xl shadow border border-gray-200 bg-white">
            <table class="w-full text-left table-auto border-collapse font-bold">
                <thead>
                    <tr class="bg-[#E2725B] text-white text-lg border-b-2 border-[#d45b43]">
                        <th class="px-6 py-4 rounded-tl-xl border-r border-[#d45b43]">商品名</th>
                        <th class="px-6 py-4 border-r border-[#d45b43]">単価</th>
                        <th class="px-6 py-4 border-r border-[#d45b43]">数量</th>
                        <th class="px-6 py-4 text-center rounded-tr-xl">小計</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- 合計金額の初期値を設定 -->
                    <?php $total=0; ?>
                    @foreach($order_details as $order_detail)
                        <tr class="text-lg">
                            <th class="px-6 py-4 border-r border-gray-200">{{ $order_detail->item_name }}</th>
                            <td class="px-6 py-4 text-center border-r border-gray-200">{{ $order_detail->price }}円</td>
                            <td class="px-6 py-4 text-center border-r border-gray-200">{{ $order_detail->count }}</td>
                            <td class="px-6 py-4 text-center">{{ $order_detail->price * $order_detail->count }}円</td>
                        </tr>
                        <!-- 合計金額の更新 -->
                        <?php $total+= ($order_detail->price * $order_detail->count); ?>
                    @endforeach
                    @foreach($coupon_info as $coupon)
                        @if($coupon != null)
                            <tr class="bg-orange-50 text-lg">
                                <th colspan="3" class="px-6 py-4 text-right font-medium border-r border-gray-200">クーポン</th>
                                <td class="px-6 py-4 text-center text-red-600 font-semibold">-{{ $coupon->discount }}円</td>
                            </tr>
                        @endif
                        <!-- クーポンの計算 -->
                        <?php $total-= $coupon->discount * 1; ?>
                    @endforeach
                </tbody>
                <tfoot class="text-gray-800 text-lg font-semibold border-t border-gray-200">
                    <tr>
                        <th colspan="3" class="px-6 py-4 text-right rounded-bl-lg border-r border-gray-200">合計金額（税込）</th>
                        <td class="px-6 py-4 text-center text-lg rounded-br-lg">{{ $total }}円</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="flex flex-col justify-center items-center mt-5">
            <form action="{{ route('done_payment') }}" method="post">
                @csrf
                <button type="submit" class="bg-white text-yellow-700 border-2 border-yellow-700 rounded-lg py-3 px-8 font-bold hover:bg-yellow-700 hover:text-white transition">トップへ</button>
            </form>
        </div>
    </div>
</body>
</html>