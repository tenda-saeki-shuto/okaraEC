<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('/css/cart.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>決済情報入力</title>
</head>
<body class="h-screen flex flex-col w-full items-center">
    <!-- ヘッダー入れる -->
    @include('user.user_header')
    
    <div class="container w-[80%]">
        <h1 class="text-3xl font-bold mb-5 mt-20">決済確認</h1>
        <p class="text-lg mb-5">以下の内容で注文します（まだ注文は確定押していません）</p>
        

        <h2 class="text-2xl font-bold mb-3">注文確認</h2>
        <!-- テーブル入れる -->
         <table class="mb-5">
            <thead>
                <tr class="bg-gray-200">
                    <th>商品名</th>
                    <th>単価</th>
                    <th>数量</th>
                    <th>小計</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th></th>
                    <td class="text-center">円</td>
                    <td class="p-1 text-center">1</td>
                    <td class="text-center">円</td>
                </tr>
            </tbody>
            <tfoot class="font-bold">
                <tr>
                    <th scope="row" colspan="3" class="text-right">合計金額（税込）</th>
                    <td class="text-center">円</td>
                </tr>
            </tfoot>
        </table>

        <div class="mb-5">
            <h2 class="text-2xl font-bold mb-3">支払い情報</h2>
            <p>クレジットカード</p>
            <p>カード情報末尾　1234</p>
        </div>

        <div class="mb-5">
            <h2 class="text-2xl font-bold">お届け先</h2>
            <p>○○県○○市00-0</p>
        </div>

        <div class="flex justify-around mb-10">
            <button>変更</button>
            <button>確定</button>
        </div>
    </div>

</body>
</html>