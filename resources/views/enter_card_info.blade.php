<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/credit_style.css') }}">
    @yield('google_fonts')
    <title>Document</title>
</head>
<body>
    <!-- ヘッダー入れる -->
    
    <div class="container">
        <h1>クレジットカード情報入力</h1>
        <form action="" method="post">
            <div class="contents">
                <!-- カード番号 -->
                <div>
                    <label for="numlber">カード番号　　　　　</label>
                    <input type="text">
                </div>
                
                <!-- カード有効期限 -->
                <div>
                    <label for="numlber">カード有効期限　　　</label>
                    <input type="text" size="5">
                    <span>/</span>
                    <input type="text" size="5">
                </div>
                
                <!-- セキュリティコード -->
                <div>
                    <label for="numlber">セキュリティコード　</label>
                    <input type="password" size="5">
                </div>
            </div>
            <button type="submit">完了</button>
        </form>
    </div>
    
</body>
</html>
