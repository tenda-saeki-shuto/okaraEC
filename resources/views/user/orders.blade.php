<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>注文履歴</title>
</head>
<body class="bg-white font-sans text-gray-800 m-0 p-0">
    @include('user.user_header')

    <div class="max-w-5xl mx-auto mt-8 p-6">
        <h1 class="text-3xl font-semibold text-center border-b-4 border-yellow-700 pb-4 mb-10">注文履歴</h1>

        <div class="w-full bg-white p-6 sm:p-8 rounded-xl space-y-8">
            @if($orders_list->isNotEmpty())
                <div class="max-w-4xl mx-auto overflow-hidden rounded-xl shadow border border-gray-200 bg-white">
                    <table class="w-full text-left table-auto border-collapse font-bold">
                        <thead>
                            <tr class="bg-[#E2725B] text-white text-xl border-b-2 border-gray-200">
                                <th class="px-6 py-4 rounded-tl-xl border-r border-[#d45b43]">注文日</th>
                                <th class="px-6 py-4 text-center border-r border-[#d45b43]">注文番号</th>
                                <th class="px-6 py-4 text-center border-r border-[#d45b43]">合計金額</th>
                                <th class="px-6 py-4 text-center rounded-tr-xl">定期購入</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300 text-lg">
                            @foreach ($orders_list as $order)
                                <tr class="hover:bg-gray-100 cursor-pointer {{ $order->is_regular ? 'bg-green-50' : '' }}"
                                    onclick="window.location='{{ route('orders.show', ['order' => $order->id]) }}'">
                                    <td class="px-6 py-4 border-r border-gray-200">
                                        <a href="{{ route('orders.show', ['order' => $order->id]) }}" class="text-blue-600 underline">
                                            {{ \Carbon\Carbon::parse($order->dateTime)->format('Y年m月d日') }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-center border-r border-gray-200">{{ $order->order_code }}</td>
                                    <td class="px-6 py-4 text-center border-r border-gray-200">{{ $order->total_price }}円</td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $order->is_regular ? 'はい' : 'いいえ' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="flex flex-col justify-center items-center">
                    <p class="text-2xl mt-10 text-center text-gray-700">注文履歴がありません。</p>
                    <a href="{{ route('items') }}" class="text-center w-[20%] mt-10 bg-white text-yellow-700 border-2 border-yellow-700 rounded-lg py-3 px-8 font-bold hover:bg-yellow-700 hover:text-white transition">商品一覧へ</a>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
