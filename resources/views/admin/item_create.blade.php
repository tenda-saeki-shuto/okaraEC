<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>商品登録</title>
</head>

@include('admin.admin_header')

<body>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col px-6 w-full">
                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">
                    商品登録
                </h1>
                @if (session('message'))
                    <div class="text-red-600 font-bold">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            <form method="POST" action="{{ route('item.store') }}" enctype="multipart/form-data">
                @csrf
                @include('admin.item_from')
                <button type="submit">登録</button>
            </form>
        </div>
    </section>
</body>

</html>