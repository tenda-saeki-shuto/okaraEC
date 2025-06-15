<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>カード情報入力</title>
</head>
<body>
    <!-- ヘッダー入れる -->
    @include('user.user_header')
    
    <div class="container">
        <h1>クレジットカード情報入力</h1>
        <form action="{{ route('register_card') }}" method="post">
            @csrf
            <div class="contents">
                <!-- カード番号 -->
                <div>
                    <label for="numlber">カード番号　　　　　</label>
                    <input type="text" name="card_number">
                </div>
                
                <!-- カード有効期限 -->
                <div>
                    <label for="numlber">カード有効期限　　　</label>
                    <input type="text" size="5" name="month">
                    <span>/</span>
                    <input type="text" size="5" name="year">
                </div>
                
                <!-- セキュリティコード -->
                <div>
                    <label for="numlber">セキュリティコード　</label>
                    <input type="password" size="5" name="securityCode">
                </div>
            </div>
            <button type="submit">完了</button>
            <a href="{{ route('revise_insert_payment') }}" class="w-48 bg-sky-500 text-white no-underline px-6 py-2 rounded-xl block font-black text-xl mt-5">戻る</a>
        </form>
    </div>
    
</body>
</html>
