<!doctype html>
<html>
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white font-sans text-gray-800 m-0 p-0">

    <div class="max-w-xl mx-auto mt-20 p-6">

        <h1 class="text-3xl font-semibold text-center border-b-4 border-yellow-700 pb-4 mb-10">
            ログイン
        </h1>

        <!-- セッションステータス -->
        @if (session('status'))
            <div class="mb-4 text-green-600 font-semibold">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="bg-white border border-gray-200 shadow-md rounded-xl p-8" novalidate>
            @csrf

            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-lg font-semibold text-gray-700 mb-2">メールアドレス</label>
                <input id="email" name="email" type="email" autofocus
                       class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-700"
                       value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-lg font-semibold text-gray-700 mb-2">パスワード</label>
                <input id="password" name="password" type="password"
                       class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-700">
                @error('password')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mb-6">
                <input id="remember_me" type="checkbox" name="remember"
                       class="rounded border-gray-300 text-yellow-700 shadow-sm focus:ring-yellow-700">
                <label for="remember_me" class="ml-2 text-sm text-gray-700">
                    ログイン情報を記憶する
                </label>
            </div>

            <!-- 戻る・新規登録・ログインボタン -->
            <div class="flex gap-4 mt-6">
                <a href="{{ route('top') }}"
                   class="flex-1 bg-gray-100 text-gray-700 border border-gray-400 py-3 rounded-lg font-bold hover:bg-gray-200 transition text-center block">
                    戻る
                </a>

                <button type="submit"
                        class="flex-1 bg-yellow-700 text-white py-3 rounded-lg font-bold hover:bg-yellow-800 transition">
                    ログイン
                </button>
            </div>

            <!-- パスワード再発行リンク -->
            <div class="mt-6 text-center">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 hover:underline" href="{{ route('password.request') }}">
                        パスワードをお忘れですか？
                    </a>
                @endif
            </div>
        </form>

        <!-- ★ 新規登録完全リンク -->
        <div class="mt-6 text-center">
            <a href="{{ route('register') }}" class="text-lg text-green-700 font-semibold underline">
                新規登録はこちら
            </a>
        </div>


    </div>
</body>
</html>
