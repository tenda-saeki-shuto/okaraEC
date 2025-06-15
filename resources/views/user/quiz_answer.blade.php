<!DOCTYPE html>
<html lang="ja">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>クイズ正解</title>
</head>
<body class="bg-gray-100 text-gray-800">
    <header>
        @include('user.user_header')
    </header>

    <div class="bg-yellow-300 text-center text-xl font-bold py-4">今月のクイズ（回答）</div>
    <div class="text-center text-lg my-2">{{$message}}</div>
    <div class="text-center text-2xl font-semibold my-4">{{$answer->content}}</div>

    @if($is_answer === 1 && Auth::check())
        <div class="bg-yellow-300 text-center text-xl font-bold py-4">クーポンゲット！！</div>
        <div class="bg-green-200 p-4 rounded-lg shadow-md text-center max-w-md mx-auto">
            <img src="{{$coupon->img}}" alt="クーポン画像" class="mx-auto mb-4 w-32 h-32 object-contain">
            <h2 class="text-xl font-bold">{{$coupon->name}}を獲得</h2>
            <p class="mt-2">{{$coupon->content}}</p>
        </div>
    @elseif($is_answer === 1 && !Auth::check())
        <div class="bg-yellow-100 text-center text-lg font-semibold py-4">
            正解です！ログイン・新規登録するとクーポンがもらえます🎁<br>
            <a href="{{ route('login') }}" class="text-blue-600 underline">ログインはこちら</a>
            <a href="{{ route('register') }}" class="hover-underline">新規登録</a>
        </div>
    @endif


    <div class="text-center mt-6">
        <button onclick="location.href='{{route('top')}}'" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            トップへ
        </button>
    </div>
</body>
</html>
