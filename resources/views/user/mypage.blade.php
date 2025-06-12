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
        <div class="box">
            <div class="row"><span class="label">名前：</span><span class="value">{{$user->name}}</span></div>
            <div class="row"><span class="label">郵便番号：</span><span class="value">{{$user->address->postal_code ?? '未登録'}}</span></div>
            <div class="row"><span class="label">都道府県：</span><span class="value">{{$user->address->address ?? '未登録'}}</span></div>
            <div class="row"><span class="label">住所：</span><span class="value">{{$user->address->prefecture->name ?? '未登録' }}</span></div>
            <div class="row"><span class="label">Email：</span><span class="value">{{ $user->email }}</span></div>
            <div class="row"><span class="label">TEL：</span><span class="value">{{ $user->tel }}</span></div>
            <form action="{{ route('userinfo.edit', $user) }}">
                <button type="submit" class="btn">ユーザー情報変更</button>
            </form>
        </div>


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
        <a href="{{route('withdraw')}}">
            <button class="withdrawal">退会</button>
        </a>



    </body>
</html>




<!-- ・表示する領域だけ表示（マイページのユーザー情報） -->
