<header class="w-full bg-[#f9e8d1] shadow-sm">
    @section('google_fonts')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p&display=swap" rel="stylesheet">
    @endsection

    <div class="w-full py-5">
        <nav class="w-full flex justify-between items-center font-['M_PLUS_1p'] text-lg px-6">
            <!-- 左エリア -->
            <div class="flex items-center space-x-4">
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="text-[#7c5b3e] hover:text-[#c98b50] transition duration-300 ease-in-out">
                            ログアウト
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="text-[#a07146] hover:text-[#c98b50] transition duration-300 ease-in-out underline">
                        ログイン
                    </a>
                    @if(Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="text-[#a07146] hover:text-[#c98b50] transition duration-300 ease-in-out underline">
                            新規登録
                        </a>
                    @endif
                @endauth
            </div>

            <!-- 右エリア -->
            <div class="nav-right flex items-center space-x-4 whitespace-nowrap text-lg sm:text-base xs:text-sm"> <!-- 追記: 文字サイズをレスポンシブに調整 & 改行防止 -->
                <a href="{{ route('items') }}">商品一覧&nbsp;&nbsp;</a>
                <a href="{{ route('recipes') }}">レシピ&nbsp;&nbsp;</a>
                <a href="{{route('user.quiz')}}">クイズ&nbsp;&nbsp;</a>
                <a href="{{ route('contact.form') }}">お問い合わせフォーム&nbsp&nbsp</a>
                <a href="{{ route('view.mypage') }}">マイページ</a>
                <a href="{{ route('cart') }}"><img src="{{ asset('img/cart.png') }}" alt="カート" class="w-10 h-10"></a>
                <a href="{{ route('top') }}"><img src="{{ asset('img/home.png') }}" alt="ホーム" class="w-10 h-10"></a>
            </div>

        </nav>
    </div>
</header>
