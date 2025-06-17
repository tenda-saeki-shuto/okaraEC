<!DOCTYPE html>
<html lang="ja">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>退会ページ</title>
</head>
<body class="bg-white min-h-screen text-gray-800">
    @include('user.user_header')

    <div class="flex items-center justify-center mt-24 px-4">
        <div class="w-full max-w-xl text-center">
            <h2 class="text-2xl font-semibold mb-4">本当に退会しますか？</h2>
            <p class="text-base text-gray-600 mb-8">
                退会するとすべてのデータが削除され、元に戻すことはできません。
            </p>
            <form action="{{ route('withdrawal.confirm') }}" method="POST" class="flex flex-wrap justify-center gap-6">
                @csrf
                <button type="submit" name="confirm" value="true"
                    class="px-6 py-3 bg-red-500 text-white rounded-full shadow hover:bg-red-600 transition whitespace-nowrap">
                    はい、退会します
                </button>
                <button type="submit" name="confirm" value="false"
                    class="px-6 py-3 bg-gray-400 text-white rounded-full shadow hover:bg-gray-500 transition whitespace-nowrap">
                    いいえ、やめておきます
                </button>
            </form>
        </div>
    </div>
</body>
</html>
