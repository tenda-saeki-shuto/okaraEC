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
    @include('user.user_header')

    <div class="max-w-5xl mx-auto mt-8 p-6">
        <h1 class="text-3xl font-semibold text-center border-b-4 border-yellow-700 pb-4 mb-10">現在のカートの中</h1>

        <div class="w-full bg-white p-6 sm:p-8 rounded-xl space-y-8">
            @if(!$carts->isEmpty())
                <div class="max-w-4xl mx-auto overflow-hidden rounded-xl shadow border border-gray-200 bg-white"> 
                    <table class="w-full text-left table-auto border-collapse font-bold"> 
                        <thead>
                            <tr class="bg-[#E2725B] text-white text-xl border-b-2 border-gray-200">
                                <th class="px-6 py-4 rounded-tl-xl border-r border-[#d45b43]">商品名</th>
                                <th class="px-6 py-4 text-center border-r border-[#d45b43]">単価</th>
                                <th class="px-6 py-4 text-center border-r border-[#d45b43]">数量</th>
                                <th class="px-6 py-4 text-center rounded-tr-xl">小計</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                            <?php $total=0; ?>
                            @foreach($carts as $cart)
                                <tr class="text-lg"> 
                                    <th class="px-6 py-4 border-r border-gray-200">{{ $cart->items->name }}</th>
                                    <td class="px-6 py-4 text-center border-r border-gray-200 item_price">{{ $cart->items->price }}円</td>
                                    <td class="p-1 text-center border-r border-gray-200">
                                        <div class="flex items-center justify-center">
                                            <select class="item_count flex-1 m-1 p-2 border border-gray-300 rounded-md" id="{{ $cart->item_id }}">
                                                @for($i=1; $i<=$cart->items->stock; $i++)
                                                    @if($cart->count == $i)
                                                        <option value="{{ $cart->count }}" selected="selected">{{ $cart->count }}</option>
                                                    @else
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endif
                                                @endfor
                                            </select>
                                            <form action="{{ route('cart_item_delete', ['id'=>$cart->item_id]) }}" method="post" class="ml-2">
                                                @csrf
                                                <button type="submit" class="px-3 py-1 bg-red-500 rounded-lg text-white font-black hover:bg-red-600 transition delete-btn text-lg">削除</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center item_sum">{{ $cart->items->price * $cart->count }}円</td>
                                </tr>
                                <?php $total+= $cart->items->price * $cart->count; ?>
                            @endforeach
                        </tbody>
                        <tfoot class="text-gray-800 text-lg font-semibold bg-orange-50 border-t-2 border-gray-200">
                            <tr>
                                <th colspan="3" class="px-6 py-4 text-right rounded-bl-xl border-r border-gray-200">合計金額（税込）</th>
                                <td class="px-6 py-4 text-center text-lg rounded-br-xl">{{ $total }}円</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0 mt-10 justify-center">
                    <a href="{{ route('items') }}" class="bg-white text-yellow-700 border-2 border-yellow-700 rounded-lg py-3 px-8 font-bold hover:bg-yellow-700 hover:text-white transition">商品一覧へ</a>
                    <a href="{{ route('insert_payment') }}" class="bg-white text-yellow-700 border-2 border-yellow-700 rounded-lg py-3 px-8 font-bold hover:bg-yellow-700 hover:text-white transition inline-block">購入手続きへ</a>
                </div>
            @else
                <div class="flex flex-col justify-center items-center">
                    <p class="text-2xl mt-10 text-center text-gray-700">カートに商品がありません。</p>
                    <a href="{{ route('items') }}" class="text-center w-[20%] mt-10 bg-white text-yellow-700 border-2 border-yellow-700 rounded-lg py-3 px-8 font-bold hover:bg-yellow-700 hover:text-white transition">商品一覧へ</a>                    
                </div>
            @endif
        </div>
    </div>
    <script>
        //要素の取得
       const item_count = document.querySelectorAll('.item_count');

        $(function(){
            item_count.forEach((itemElement)=>{ 
                const $item = $(itemElement);
                $item.on('change', function() {
                    // 値が変更されたプルダウンが属するtrを取得
                    let row = $(this).closest('tr');
                    // 行の中の .item_price を取得
                    let priceText = row.find('.item_price').text();
                    // 数値に変換
                    let price = parseInt(priceText.replace('円', ''));

                    const changedItem = this; 
                    const id = changedItem.id;  //カートID
                    const count = changedItem.value;  //変更後の数量
                    $.ajax({
                        headers: {
                        // POSTのときはトークンの記述がないと"419 (unknown status)"になるので注意
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type:'POST',
                        // ルーティングで設定したURL
                        url:'/change_cart_count_ajax',
                        data:{
                            id: id,
                            count: count,

                        } 
                    }).done(function (results){
                        // 成功したときのコールバック
                        let newSum = price * results['count'];
                        // 小計の上書き
                        row.find('.item_sum').text(newSum + '円');

                        // 合計金額を更新（サーバーから返された合計金額）
                        $('#total_amount').text(results['total'] + '円');
                    
                    }).fail(function(jqXHR, textStatus, errorThrown){
                        // 失敗したときのコールバック
                        console.log('fail');
                    });
                });
            });
        });
    </script>
</body>
</html>