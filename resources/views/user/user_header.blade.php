<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<header class="header">
    @section('google_fonts')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p&display=swap" rel="stylesheet">
    @endsection
    <link rel="stylesheet" href="{{ asset('user_stylesheet/style.css') }}">
    <div class="header-inner">
        <nav class="header-nav">
            <!-- 左エリア -->
            <div class="nav-left">
            @auth
                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit" class="btn-link hover-underline">ログアウト</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover-underline">ログイン&nbsp&nbsp</a>
                @if(Route::has('register'))
                <a href="{{ route('register') }}" class="hover-underline">新規登録</a>
                @endif
            @endauth
            </div>

            <!-- 右エリア -->
            <div class="nav-right">
                <a href="/">商品一覧&nbsp&nbsp</a>
                <a href="/">レシピ&nbsp&nbsp</a>
                <a href="/">クイズ&nbsp&nbsp</a>
                <a href="/">お問い合わせフォーム&nbsp&nbsp</a>
                <a href="{{ route('view.mypage') }}">マイページ</a>
                <a href="/">home</a><img src="{{ asset('img/home.png') }}" alt="ホーム" class="w-10 h-10"></a>
                <a href="/"><img src="{{ asset('img/cart.png') }}" alt="カート" class="w-10 h-10"></a>
            </div>
        </nav>
    </div>
</header>
