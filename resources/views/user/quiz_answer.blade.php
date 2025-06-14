<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>クイズ正解</title>
</head>
<body>
    <div>今月のクイズ（回答）</div>
    <div>{{$massage}}</div>
    <div>{{$answer->content}}</div>

    @if($is_answer === true)
    <div>クーポンゲット</div>
    <div>
        <img src="{{$coupon->img}}" alt="クーポン画像">
        <h2>{{$coupon->name}}</h2>
        <p>{{$coupon->content}}</p>
    </div>
    @endif

    <button onclick="location.href='{{route('user.quiz')}}'">トップへ</button>
</body>
</html>
