<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>決済情報確認</title>
</head>
<body class="bg-white font-sans text-gray-800 m-0 p-0">
    <!-- ヘッダー入れる -->
    @include('user.user_header')
    
    <div class="max-w-5xl mx-auto mt-8 p-6"> 
        <h1 class="text-3xl font-semibold text-center border-b-4 border-yellow-700 pb-4 mb-10">決済確認</h1>
        <p class="text-lg mb-5">以下の内容で注文します（まだ注文は確定していません）</p>
        
        <div class="w-full bg-white p-6 sm:p-8 rounded-xl shadow-lg space-y-8">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-700 border-b-2 border-yellow-700 pb-2 mb-4">注文確認</h2>
            <div class="max-w-4xl mx-auto overflow-hidden mt-8 rounded-xl shadow border border-gray-200 bg-white"> 
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
                        <?php $total=0; ?>
                        @foreach($carts as $cart)
                            <tr class="text-lg even:bg-gray-50 odd:bg-white transform transition-all duration-200 hover:scale-[1.01] hover:shadow-lg relative z-0"> 
                                <th class="px-6 py-4 border-r border-gray-200">{{ $cart->items->name }}</th>
                                <td class="px-6 py-4 text-center border-r border-gray-200">{{ $cart->items->price }}円</td>
                                <td class="px-6 py-4 text-center border-r border-gray-200">{{ $cart->count }}</td>
                                <td class="px-6 py-4 text-center">{{ $cart->items->price * $cart->count }}円</td>
                            </tr>
                            <?php $total+= $cart->items->price * $cart->count; ?>
                        @endforeach
                        @if($coupon != null)
                            <tr class="bg-orange-50 text-lg">
                                <th colspan="3" class="px-6 py-4 text-right font-medium border-r border-gray-200">クーポン</th>
                                <td class="px-6 py-4 text-center text-red-600 font-semibold">-{{ $coupon->discount }}円</td>
                            </tr>
                            <?php $total-= $coupon->discount; ?>
                        @endif
                    </tbody>
                    <tfoot class="text-gray-800 text-lg font-semibold border-t border-gray-200">
                        <tr>
                            <th colspan="3" class="px-6 py-4 text-right rounded-bl-lg border-r border-gray-200">合計金額（税込）</th>
                            <td class="px-6 py-4 text-center text-lg rounded-br-lg">{{ $total }}円</td> 
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <div class="space-y-4">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-700 border-b-2 border-yellow-700 pb-2 mb-4">お届け先</h2>
                <div>
                    <label class="block text-gray-700 text-lg font-semibold mb-1">郵便番号</label>
                    <p class="text-lg text-gray-900">{{ session('postal_code') }}</p>
                    <input type="hidden" name="postal_code" value="{{ $postal_code }}">
                </div>
                <div class="mt-4">
                    <label for="prefecture" class="block text-gray-700 text-lg font-semibold mb-1">都道府県</label>
                    <p class="text-lg text-gray-900">{{ session('prefecture') }}</p>
                    <input type="hidden" name="prefecture" value="{{ $prefecture }}">
                </div>
                <div class="mt-4">
                    <label for="address" class="block text-gray-700 text-lg font-semibold mb-1">住所</label>
                    <p class="text-lg text-gray-900">{{ session('address') }}</p>
                    <input type="hidden" name="address" value="{{ $address }}">
                </div>
            </div>
        
            <div class="space-y-4">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-700 border-b-2 border-yellow-700 pb-2 mb-4">支払い情報</h2>
                <p class="block text-gray-900 text-lg font-semibold mb-1">クレジットカード</p>
                <p class="text-lg text-gray-900">カード情報末尾 **** **** **** {{ $shown_num }}</p>
            </div>
            
            <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0 mt-6">
                <a href="{{ route('revise_insert_payment') }}" class="w-auto p-3 bg-white text-yellow-700 border-2 border-yellow-700 rounded-lg py-3 px-8 font-bold hover:bg-yellow-700 hover:text-white transition text-xl text-center">戻る</a>
                <a href="{{ route('show_orders') }}" class="w-auto p-3 bg-white text-yellow-700 border-2 border-yellow-700 rounded-lg py-3 px-8 font-bold hover:bg-yellow-700 hover:text-white transition text-xl text-center">確定</a>
            </div>
        </div>
    </div>
</body>
</html>