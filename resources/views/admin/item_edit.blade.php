<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品更新</title>
</head>
<body>
    <h1>商品更新</h1>
    @if (session('message'))
        <div class="text-red-600 font-bold">
            {{ session('message') }}
        </div>
    @endif
    <div class="container">
        <form action="{{ route('item.update', $item) }}" method="POST">
            @method('PATCH')
            @csrf
            @include('admin.item_from')
            <button type="submit">更新</button>
        </form>
    </div>

</body>
</html>