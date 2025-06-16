<!DOCTYPE html>
<html lang="ja">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8" />
    <title>送信完了</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f9fafb; /* お問い合わせページの背景に合わせる */
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">

    @include("user.user_header")

    <div class="max-w-5xl mx-auto mt-12 px-6">
    <h1 class="text-3xl font-semibold text-center border-b-4 border-yellow-700 pb-4 mb-10">
        送信完了
    </h1>

    <div class="bg-white rounded-xl p-8 shadow-md text-center">
        <p class="text-lg text-gray-700 mb-8">
            メッセージは送信されました。<br>ありがとうございます。
        </p>

        <a href="{{ route('top') }}">
            <button type="button" 
                class="bg-yellow-700 text-white rounded-lg py-3 px-8 font-bold hover:bg-yellow-800 transition">
                トップページへ戻る
            </button>
        </a>
    </div>
</div>

</body>
</html>
