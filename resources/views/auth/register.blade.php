<!doctype html>
<html>
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans text-gray-800 m-0 p-0">

    <div class="max-w-xl mx-auto mt-20 p-6">
        <h1 class="text-3xl font-semibold text-center border-b-4 border-yellow-700 pb-4 mb-10">
            新規登録
        </h1>

        <form method="POST" action="{{ route('register') }}"
              class="bg-white border border-gray-200 shadow-md rounded-xl p-8">
            @csrf

            <!-- 名前 -->
            <div class="mb-4">
                <label for="name" class="block text-lg font-semibold text-gray-700 mb-2">氏名</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" autofocus
                    class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-700">
                @error('name')
                    <!-- バリデーションエラー表示 -->
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- 郵便番号 -->
            <div class="mb-4">
                <label for="postal_code" class="block text-lg font-semibold text-gray-700 mb-2">郵便番号</label>
                <input id="postal_code" name="postal_code" type="text" value="{{ old('postal_code') }}" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-700">
                <p class="text-sm text-gray-500 mt-1">※ハイフンなしで入力してください</p>
                @error('postal_code')
                    <!-- バリデーションエラー表示 -->
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- 都道府県 -->
            <div class="mb-4">
                <label for="prefecture_id" class="block text-lg font-semibold text-gray-700 mb-2">都道府県</label>
                <select name="prefecture_id" id="prefecture_id" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-700">
                    <option value="">選択してください</option>
                    @foreach($prefecture as $pref)
                        <option value="{{ $pref->id }}" {{ old('prefecture_id') == $pref->id ? 'selected' : '' }}>
                            {{ $pref->name }}
                        </option>
                    @endforeach
                </select>
                @error('prefecture_id')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- 住所 -->
            <div class="mb-4">
                <label for="address" class="block text-lg font-semibold text-gray-700 mb-2">住所</label>
                <input id="address" name="address" type="text" value="{{ old('address') }}" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-700">
                @error('address')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- 電話番号 -->
            <div class="mb-4">
                <label for="tel" class="block text-lg font-semibold text-gray-700 mb-2">電話番号</label>
                <input id="tel" name="tel" type="text" value="{{ old('tel') }}" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-700">
                <p class="text-sm text-gray-500 mt-1">※ハイフンなしで入力してください</p>
                @error('tel')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-lg font-semibold text-gray-700 mb-2">メールアドレス</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-700">
                @error('email')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- パスワード -->
            <div class="mb-4">
                <label for="password" class="block text-lg font-semibold text-gray-700 mb-2">パスワード</label>
                <input id="password" name="password" type="password" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-700">
                <p class="text-sm text-gray-500 mt-1">※7文字〜20文字で入力してください</p>
                @error('password')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- パスワード確認 -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-lg font-semibold text-gray-700 mb-2">パスワード確認</label>
                <input id="password_confirmation" name="password_confirmation" type="password" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-700">
                @error('password_confirmation')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- ボタンエリア -->
            <div class="flex flex-col sm:flex-row sm:justify-between items-center gap-4 mt-6">
                <!-- 戻るボタン -->
                <a href="{{ route('top') }}"
                    class="w-full sm:w-1/3 bg-gray-100 text-gray-700 border border-gray-400 py-3 rounded-lg font-bold hover:bg-gray-200 transition text-center block">
                    戻る
                </a>

                <!-- 登録ボタン -->
                <button type="submit"
                    class="w-full sm:w-1/3 bg-yellow-700 text-white py-3 rounded-lg font-bold hover:bg-yellow-800 transition">
                    登録
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-lg text-yellow-700 font-semibold underline">
                ログインはこちら
            </a>
        </div>

        </div>
    </div>
</body>
</html>
