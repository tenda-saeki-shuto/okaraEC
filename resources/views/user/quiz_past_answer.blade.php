<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>回答</title>
</head>
<body>
    <header>
        @include('user.user_header')
    </header>

    <div class="text-center text-lg my-2">{{$message}}</div>
    <div class="text-center text-2xl font-semibold my-4">{{$answer->content}}</div>

</body>
</html>
