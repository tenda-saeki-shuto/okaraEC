<header class="header">
  <link rel="stylesheet" href="{{ asset('user_stylesheet/style.css') }}">
  <nav class="header-nav">
    <!-- 左エリア -->
    <div class="nav-left">
      @auth
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
          @csrf
          <button type="submit" class="btn-link hover-underline">ログアウト</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="hover-underline">ログイン/</a>
        @if(Route::has('register'))
          <a href="{{ route('register') }}" class="hover-underline">新規登録</a>
        @endif
      @endauth
    </div>

    <!-- 右エリア -->
    <div class="nav-right">
      <a href="/">商品一覧</a>
      <a href="/">レシピ</a>
      <a href="/">クイズ</a>
      <a href="/">お問い合わせフォーム</a>
      <a href="/">マイページ</a>
      <a href="/"><img src="{{ asset('img/home.png') }}" alt="ホーム" weight=40px height=40px></a>
      <a href="/"><img src="{{ asset('img/cart.png') }}" alt="カート" weight=40px height=40px></a>
    </div>
  </nav>
</header>
