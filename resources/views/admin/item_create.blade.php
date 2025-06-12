<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録</title>
</head>
<body>
    <header>
        {{ view('admin.admin_header') }}
    </header>
    <h1>商品登録</h1>
    @if (session('message'))
        <div class="text-red-600 font-bold">
            {{ session('message') }}
        </div>
    @endif
    <div class="container">
        <form action="{{ route('item.store') }}" method="POST">
            @csrf
            @include('admin.item_from')
            <button type="submit">登録</button>
        </form>
    </div>

</body>
</html>