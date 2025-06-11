<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('user_stylesheet/style.css') }}">

    <title>決済情報入力</title>
</head>
<body class="h-screen flex flex-col items-center">
    <!-- ヘッダー入れる -->
    @include('user.user_header')

    <div class="flex flex-col items-center justify-arouind h-screen w-full">    
        <h1 class="text-3xl font-bold mb-5 mt-20">決済情報入力</h1>

        <div class="mb-20 w-[40%] items-start flex flex-col">
            <div class="mb-10">
                <h2 class="text-xl font-bold mb-2">お届け先</h2>
                <div>
                    <label for="address" class="text-lg">郵便番号</label>
                    <input type="text">
                </div>
                <div class="mt-4">
                    <label for="address" class="text-lg w-full">住所　　</label>
                    <input type="text">
                </div>
            </div>
       

            <div class="mb-10">
                <h2 class="text-xl font-bold mb-2">支払情報</h2>
                <p class="text-lg">クレジットカード</p>
                <p class="text-lg">カード情報末尾 1234</p>
                <button class="py-3 px-8 bg-sky-500 rounded-2xl text-white font-black text-xl mt-5">カード情報変更</button>
            </div>

            <div class="mb-10">
                <h2 class="text-xl font-bold mb-2">クーポン</h2>
                <input type="radio" name="coupon"><span class="text-lg">5%割引</span><br>
                <input type="radio" name="coupon"><span class="text-lg">10%割引</span>
            </div>

            <div>
                <button class="py-3 px-8 bg-sky-500 rounded-2xl text-white font-black text-xl mt-5">注文確認</button>
            </div>
        </div>
    </div>
</body>
</html>