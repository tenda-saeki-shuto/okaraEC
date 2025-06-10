<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>商品一覧</title>
</head>
<body>
    <header>
        {{-- @include('user.header') --}}
    </header>
    <h1 class="text-center text-3xl">商品一覧</h1>
    {{-- カテゴリ --}}
    <div class="text-right">
    <form action="" method="GET" class="mb-4">
        <label for="category" class="mb-4">カテゴリ</label>
        <select name="category" id="category" class="form-select">
            <option value="">全て</option>
            <option value="1">スイーツ</option>
            <option value="2">ドリンク</option>
            {{-- @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach --}}
        </select>
    </form>



    </div>


</body>
</html>
