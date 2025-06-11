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

    <div class="flex flex-col items-center mt-20 w-full">
        
        
        <h1 class="text-3xl font-bold mb-5">現在のカートの中</h1>
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
                    <td class="p-1">
                        <div class="flex">
                            <select class="item_count flex-1 m-1" id="{{ $cart->id }}">
                                @for($i=1; $i<=10; $i++)
                                    @if($cart->count === $i)
                                        <option value="{{ $cart->count }}" selected="selected">{{ $cart->count }}</option>
                                    @else
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endif
                                @endfor
                            </select>
                            <form action="{{ route('cart_item_delete', ['id'=>$cart->id]) }}" method="post">
                                @csrf
                                <button class="px-4 bg-sky-500 rounded-xl text-white font-black flex-1 delete-btn">削除</button>
                            </form>
                        </div>
                    </td>
                    <td class="text-center">{{ $cart->items->price * $cart->count }}円</td>
                </tr>

                <!-- 合計金額の更新 -->
                <?php $total+= $cart->items->price * $cart->count; ?>
                @endforeach
            </tbody>
            <tfoot class="font-bold">
                <tr>
                    <th scope="row" colspan="3" class="text-right">合計金額（税込）</th>
                    <td class="text-center">{{ $total }}円</td>
                </tr>
            </tfoot>
        </table>
        <button class="py-3 px-8 bg-sky-500 rounded-2xl text-white font-black text-xl mt-5"><a href="{{ route('confirm_payment') }}">購入手続きへ</a></button>
    </div>

    <script>
        //要素の取得
       const item_count = document.querySelectorAll('.item_count');
        $(function(){
            item_count.forEach((itemElement)=>{ 
                const $item = $(itemElement);
                $item.on('change', function() {
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
                            url:'/change_cart_count/' + id + '/' + count, 
                            // dataType: 'json',
                        }).done(function (results){
                            // 成功したときのコールバック
                            console.log('OK');
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