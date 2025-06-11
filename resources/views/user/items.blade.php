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
    <form method="GET" class="mb-4">
        <label for="category" class="mb-4">カテゴリ</label>
        <select name="category" id="category" class="border rounded px-2 py-1 w-28">
            <option value="" {{ empty(request('category')) ? 'selected' : '' }}>全て</option>
            @foreach ($category as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach

        </select>
    </form>
    </div>


        <div id="item_list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 ml-4 mr-4 mb-4">
                {{-- 商品一覧 JSで出力--}}
        </div>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    // プルダウン処理
    function fetchItems(categoryId = '') {
        $.ajax({
            url: '{{ route("items.filter") }}',
            type: 'GET',
            data: { category: categoryId },
            success: function (response) {
                let html = '';

                response.items.forEach(item => {
                    html += `
                        <a href="/item/${item.id}" class="block no-underline">
                            <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow duration-300 aspect-[1/1]">
                                <img src="/images/${item.image}" alt="${item.name}" class="w-4/6 h-4/6 object-cover rounded-t-lg">
                                <h2 class="text-xl font-bold mt-2">${item.name}</h2>
                                ${item.is_frozen === 1 ? '<div class="bg-pink-300 text-center w-1/4 text-base rounded-full">冷凍商品</div>' : ''}
                                <p class="text-gray-600">¥${Number(item.price).toLocaleString()}</p>
                            </div>
                        </a>
                    `;
                });

                $('#item_list').html(html);
            },
            error: function () {
                alert('商品情報の取得に失敗しました。');
            }
        });
    }

     // 初期表示で「すべて」に設定
    $(document).ready(function () {
    $('#category').val('');
    fetchItems();

    $('#category').on('change', function () {
        const categoryId = $(this).val();
        fetchItems(categoryId);
    });
});

</script>





{{-- お気に入り処理は後でやります --}}
</html>
