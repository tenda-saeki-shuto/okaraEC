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
        @include('user.user_header')
    </header>
    <h1 class="text-center text-3xl">商品一覧</h1>
    {{-- カテゴリ --}}
    <div class="text-right mr-3 mt-4 mb-4">
    <form action="" method="GET" class="mb-4">
        <label for="category" class="mb-4">カテゴリ</label>
        <select name="category" id="category" class="form-select border rounded px-2 py-1">
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

        {{-- 商品一覧 --}}

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 ml-4 mr-4 mb-4">

        {{--このコメントアウトを消して下のデモを削除してください
        @foreach ($items as $item)
            <a href="{{ route('item_detail', ['id' => $item->id]) }}" class="block no-underline">
                <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow duration-300 aspect-[1/1]">
                    <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}" class="w-4/6 h-4/6 object-cover rounded-t-lg">
                    <h2 class="text-xl font-bold mt-2">{{ $item->name }}</h2>
                    <p class="text-gray-600">{{ $item->content }}</p>
                    <p class="text-gray-600">¥{{ number_format($item->price) }}</p>
                </div>
            </a>
        @endforeach
        --}}
        {{------------------ デモ ---------------------------------------------}}
        <a href="{{route('item_detail')}}" class="block no-underline">
            <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow duration-300 aspect-[1/1]">
                <img src="{{ asset('images/sample.jpg') }}" alt="商品画像" class="w-4/6 h-4/6 object-cover rounded-t-lg">
                <h2 class="text-xl font-bold mt-2">商品名</h2>
                <p class="text-gray-600">説明文</p>
                <p class="text-gray-600">¥1,000</p>
                <p>♡</p>
            </div>
        </a>
        <a href="{{route('item_detail')}}" class="block [text-decoration:none]">
            <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                <img src="{{ asset('images/sample.jpg') }}" alt="商品画像" class="w-full h-48 object-cover rounded-t-lg">
                <h2 class="text-xl font-bold mt-2">商品名</h2>
                <p class="text-gray-600">説明文</p>
                <p class="text-gray-600">¥1,000</p>
            </div>
        </a>
        <a href="{{route('item_detail')}}" class="block [text-decoration:none]">
            <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                <img src="{{ asset('images/sample.jpg') }}" alt="商品画像" class="w-full h-48 object-cover rounded-t-lg">
                <h2 class="text-xl font-bold mt-2">商品名</h2>
                <p class="text-gray-600">説明文</p>
                <p class="text-gray-600">¥1,000</p>
            </div>
        </a>
        <a href="{{route('item_detail')}}" class="block [text-decoration:none]">
            <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                <img src="{{ asset('images/sample.jpg') }}" alt="商品画像" class="w-full h-48 object-cover rounded-t-lg">
                <h2 class="text-xl font-bold mt-2">商品名</h2>
                <p class="text-gray-600">説明文</p>
                <p class="text-gray-600">¥1,000</p>
            </div>
        </a>
    </div>

</body>

{{-- お気に入り処理は後でやります --}}
</html>
