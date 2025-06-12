<!doctype html>
<html>
    <head>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <header>
        <link rel="stylesheet" href="{{ asset('user_stylesheet/mypage_style.css') }}">
    </header>

    <body>
        @include("user.user_header")

        <h1>登録情報</h1>
        <!-- 本来は以下にDBから取得したユーザー情報が表示される -->
     

        
        <div class="image-row">
            <!-- お気に入り画面に遷移 -->
            <form action="#">
                <div class="image-container">
                    <button><img src="{{ asset('img/like.png') }}"></button>
                    <p>お気に入り</p>
                </div>
            </form>

            <!-- 定購入一覧に遷移 -->
            <form>
                <div class="image-container">
                    <button><img src="{{ asset('img/buy.png') }}"></button>
                    <p>定期購入一覧</p>
                </div>
            </form>

            <!-- クーポン -->
            <form action="#">
                <div class="image-container">
                    <button><img src="{{ asset('img/coupon.png') }}"></button>
                    <p>クーポン</p>
                </div>
            </form>

            <!-- 購入履歴 -->
            <form action="#">
                <div class="image-container">
                    <button><img src="{{ asset('img/history.png') }}"></button>
                    <p>購入履歴</p>
                </div>
            </form>
        </div>

        <!-- 退会ボタン -->
        <form action="">
            <button class="withdrawal">退会</button>
        </form>



    </body>
</html>




<!-- ・表示する領域だけ表示（マイページのユーザー情報） -->
