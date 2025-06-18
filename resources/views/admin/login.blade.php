<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>管理者ログイン</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center">

    <div class="bg-white w-full max-w-sm p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">管理者ログイン</h1>

        {{-- 共通エラーメッセージ --}}
        @error('message')
            <div class="mb-4 bg-red-50 border border-red-200 text-red-500 text-sm p-2 rounded text-center">
                {{ $message }}
            </div>
        @enderror

        <form method="POST" action="/admin/login" class="space-y-4">
            @csrf

            {{-- Admin ID --}}
            <div>
                <label for="admin_id" class="block text-sm font-medium text-gray-700 mb-1">Admin ID</label>
                <input type="text" name="admin_id" id="admin_id"
                    class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
                @error('admin_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- パスワード --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">パスワード</label>
                <input type="password" name="password" id="password"
                    class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ログインボタン --}}
            <div>
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                    ログイン
                </button>
            </div>
        </form>
    </div>

</body>
</html>
