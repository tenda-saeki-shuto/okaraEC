<header class="w-full bg-[#f9e8d1] shadow-sm flex items-center justify-between p-4 h-28">
    @section('google_fonts')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p&display=swap" rel="stylesheet">
    @endsection

    <div class="w-full h-28">
        <nav class="w-full flex justify-between items-center font-['M_PLUS_1p'] text-lg px-6 h-28">
            <!-- 左エリア -->
            <div class="flex space-x-4">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="border-b-4 border-transparent text-[#7c5b3e] hover:text-[#c98b50] hover:border-[#c96d50] transition-all duration-300 ease-in-out inline-block">
                            ログアウト
                        </button>
                    </form>
                @else
                    <div>
                        <a href="{{ route('login') }}"
                            class="border-b-4 border-transparent text-[#7c5b3e] hover:text-[#c98b50] hover:border-[#c96d50] transition-all duration-300 ease-in-out inline-block">
                            ログイン
                        </a>
                    </div>
                    @if(Route::has('register'))
                    <div>
                        <a href="{{ route('register') }}"
                            class="border-b-4 border-transparent text-[#7c5b3e] hover:text-[#c98b50] hover:border-[#c96d50] transition-all duration-300 ease-in-out inline-block">
                            新規登録
                        </a>
                    </div>
                    @endif
                @endauth
            </div>

            <!-- 右エリア -->
            <div id="navMenu" class="nav-right flex items-center space-x-4 whitespace-nowrap text-lg hidden lg:flex">
                <a href="{{ route('items') }}" class="border-b-4 border-transparent text-[#7c5b3e] hover:text-[#c98b50] hover:border-[#c96d50] transition-all duration-300 ease-in-out inline-block">商品一覧&nbsp;&nbsp;</a>
                <a href="{{ route('recipes') }}" class="border-b-4 border-transparent text-[#7c5b3e] hover:text-[#c98b50] hover:border-[#c96d50] transition-all duration-300 ease-in-out inline-block">レシピ&nbsp;&nbsp;</a>
                <a href="{{route('user.quiz')}}" class="border-b-4 border-transparent text-[#7c5b3e] hover:text-[#c98b50] hover:border-[#c96d50] transition-all duration-300 ease-in-out inline-block">クイズ&nbsp;&nbsp;</a>
                <a href="{{ route('contact.form') }}" class="border-b-4 border-transparent text-[#7c5b3e] hover:text-[#c98b50] hover:border-[#c96d50] transition-all duration-300 ease-in-out inline-block">お問い合わせフォーム&nbsp&nbsp</a>
                <a href="{{ route('view.mypage') }}" class="border-b-4 border-transparent text-[#7c5b3e] hover:text-[#c98b50] hover:border-[#c96d50] transition-all duration-300 ease-in-out inline-block">マイページ</a>
                <a href="{{ route('cart') }}"><img src="{{ asset('img/cart.png') }}" alt="カート" class="w-10 h-10"></a>
                <a href="{{ route('top') }}"><img src="{{ asset('img/home.png') }}" alt="ホーム" class="w-10 h-10"></a>
            </div>

            <!-- 画面サイズが小さくなった場合の表示 -->
            <div class="relative z-50 lg:hidden">
                <!-- ハンバーガーアイコン -->
                <button id="menuToggle" aria-label="メニュー" aria-controls="morphMenu" aria-expanded="false" class="fixed top-5 right-5 w-12 h-12 z-50 bg-transparent border-none cursor-pointer flex items-center justify-center">
                    <svg class="w-full h-full" viewBox="0 0 100 100">
                    <path class="line line1" d="M 20,29 H 80 C 80,29 94.5,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
                    <path class="line line2" d="M 20,50 H 80" />
                    <path class="line line3" d="M 20,71 H 80 C 80,71 94.5,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
                    </svg>
                </button>

                <!-- メニュー本体 -->
                <nav id="morphMenu" class="fixed top-0 left-0 w-full h-screen bg-[#f9e8d1] bg-opacity-75 clip-circle-small transition-[clip-path] duration-700 ease-in-out overflow-hidden z-40 pointer-events-none" aria-hidden="true">
                    <div class="flex flex-col items-center justify-center h-full text-[#a07146] font-bold space-y-6 text-2xl">
                        <a href="{{ route('items') }}" class="hover:text-[#c98b50] transition">商品一覧&nbsp;&nbsp;</a>
                        <a href="{{ route('recipes') }}" class="hover:text-[#c98b50] transition">レシピ&nbsp;&nbsp;</a>
                        <a href="{{route('user.quiz')}}" class="hover:text-[#c98b50] transition">クイズ&nbsp;&nbsp;</a>
                        <a href="{{ route('contact.form') }}" class="hover:text-[#c98b50] transition">お問い合わせフォーム&nbsp&nbsp</a>
                        <a href="{{ route('view.mypage') }}" class="hover:text-[#c98b50] transition">マイページ</a>
                        <a href="{{ route('cart') }}" class="hover:text-[#c98b50] transition">カート</a>
                        <a href="{{ route('top') }}" class="hover:text-[#c98b50] transition">ホーム</a>
                    </div>
                </nav>
            </div>
        </nav>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const button = document.getElementById('menuToggle');
  const menu = document.getElementById('morphMenu');

  button.addEventListener('click', () => {
    const expanded = button.getAttribute('aria-expanded') === 'true';

    button.classList.toggle('active');
    menu.classList.toggle('clip-circle-small');
    menu.classList.toggle('clip-circle-large');
    menu.classList.toggle('pointer-events-none');

    button.setAttribute('aria-expanded', !expanded);
    menu.setAttribute('aria-hidden', expanded);
    document.body.style.overflow = expanded ? '' : 'hidden';
  });

  // ホバーで日本語が出るアニメーション
  const links = document.querySelectorAll('.morph-link');
  links.forEach(link => {
    link.addEventListener('mouseenter', () => {
      link.querySelector('.jp').classList.remove('translate-y-full');
    });
    link.addEventListener('mouseleave', () => {
      link.querySelector('.jp').classList.add('translate-y-full');
    });
  });
});
</script>
