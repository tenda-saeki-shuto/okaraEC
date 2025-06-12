<!DOCTYPE html>
<html lang="ja">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>退会ページ</title>
</head>
<body>

    <div class="mt-16 text-center">
        <h2 class="mb-6 text-xl font-bold text-gray-800">本当に退会しますか？</h2>
        <form action="{{ route('withdrawal.confirm') }}" method="POST" class="flex justify-center space-x-6">
        @csrf
        <button type="submit" name="confirm" value="true"
        class="px-6 py-3 bg-blue-400 text-white rounded-full shadow hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-300 transition">
            はい
        </button>
        <button type="submit" name="confirm" value="false"
        class="px-6 py-3 bg-blue-400 text-white rounded-full shadow hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-300 transition">
            いいえ
        </button>
        </form>
    </div>


</body>
</html>
