<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>管理者トップ</title>
</head>

@include('admin.admin_header')

<body>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-20">
                @if (session('message'))
                    <div class="text-red-600 font-bold">
                        {{ session('message') }}
                    </div>
                @endif

                @auth('admin')
                    <div class="flex flex-wrap w-full mb-20 flex-col items-center text-center">
                        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">
                            管理者ログイン中
                        </h1>
                        <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">
                            管理者用ページです。
                            ユーザーページは
                            <a class="underline" href="{{ route('top') }}">こちら</a>。
                        </p>
                    </div>
                @endauth
            </div>
    </section>
</body>

</html>