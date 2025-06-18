<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>注文履歴の詳細</title>
</head>
<body class="bg-white font-sans text-gray-800 m-0 p-0">
    @include('user.user_header')

    <div class="max-w-5xl mx-auto mt-8 p-6">
        <h1 class="text-3xl font-semibold text-center border-b-4 border-yellow-700 pb-4 mb-10">注文履歴の詳細</h1>

        <!-- お届け先情報 -->
        <div class="bg-white p-6 sm:p-8 rounded-xl shadow mb-10 space-y-6 border border-gray-200">
            <h2 class="text-2xl font-bold border-b border-gray-300 pb-2">お届け先</h2>
            <div class="text-xl">
                <p><span class="font-semibold">郵便番号：</span>〒{{ $order_list->postal_code }}</p>
                <p><span class="font-semibold">住所：</span>{{ $order_list->prefecture }}{{ $order_list->address }}</p>
            </div>
        </div>

        <!-- 支払い情報 -->
        <div class="bg-white p-6 sm:p-8 rounded-xl shadow mb-10 space-y-4 border border-gray-200">
            <h2 class="text-2xl font-bold border-b border-gray-300 pb-2">支払い情報</h2>
            <p class="text-xl">{{ $order_list->payment }}</p>
        </div>

        <!-- 注文確認 -->
        <div class="w-full bg-white p-6 sm:p-8 rounded-xl shadow border border-gray-200">
            <h2 class="text-2xl font-bold border-b border-gray-300 pb-2 mb-6">注文内容</h2>
            <table class="w-full text-left table-auto border-collapse font-bold">
                <thead>
                    <tr class="bg-[#E2725B] text-white text-xl border-b-2 border-gray-200">
                        <th class="px-6 py-4 rounded-tl-xl border-r border-[#d45b43]">商品名</th>
                        <th class="px-6 py-4 text-center border-r border-[#d45b43]">単価</th>
                        <th class="px-6 py-4 text-center border-r border-[#d45b43]">数量</th>
                        <th class="px-6 py-4 text-center rounded-tr-xl">小計</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300 text-lg">
                    @foreach($order_list->orderDetails as $order)
                        <tr>
                            <td class="px-6 py-4 border-r border-gray-200">{{ $order->item_name }}</td>
                            <td class="px-6 py-4 text-center border-r border-gray-200">{{ $order->price }}円</td>
                            <td class="px-6 py-4 text-center border-r border-gray-200">{{ $order->count }}</td>
                            <td class="px-6 py-4 text-center">{{ $order->price * $order->count }}円</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="text-gray-800 text-lg font-semibold bg-orange-50 border-t-2 border-gray-200">
                    <tr>
                        <th colspan="3" class="px-6 py-4 text-right rounded-bl-xl border-r border-gray-200">合計金額（税込）</th>
                        <td class="px-6 py-4 text-center text-lg rounded-br-xl">{{ $order_list->total_price }}円</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="flex justify-center mt-10">
            <a href="{{ route('orders') }}" class="bg-white text-yellow-700 border-2 border-yellow-700 rounded-lg py-3 px-8 font-bold hover:bg-yellow-700 hover:text-white transition">注文履歴一覧へ戻る</a>
        </div>
    </div>
</body>
</html>
