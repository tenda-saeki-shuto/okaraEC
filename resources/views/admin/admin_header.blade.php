<header class="text-gray-600 body-font">
  <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
    <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
      <span class="ml-3 text-xl">＿＿サイト管理者用ページ</span>
    </a>
    <nav class="md:mr-auto md:ml-4 md:py-1 md:pl-4 md:border-l md:border-gray-400	flex flex-wrap items-center text-base justify-center">
      <a class="mr-5 hover:text-gray-900" href="{{ route('item.index') }}">商品関連</a>
      <a class="mr-5 hover:text-gray-900" href="{{ route('recipe.index') }}">レシピ関連</a>
      <a class="mr-5 hover:text-gray-900" href="{{ route('quiz.index') }}">クイズ関連</a>
      <a class="mr-5 hover:text-gray-900" href="{{ route('user.index') }}">ユーザー関連</a>
      <a class="mr-5 hover:text-gray-900" href="">注文関連</a>
      <form method="POST" action="{{ route('admin.login.destroy') }}">
          @method('DELETE')
          @csrf
          <button class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">ログアウト
          </button>
      </form>
    </nav>
  </div>
</header>