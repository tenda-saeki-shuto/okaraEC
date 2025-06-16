<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .text-danger {
            color: red;
        }
        .text-secondary {
            color: gray;
        }

        /* 枠と文字サイズを固定 */
        body {
            font-size: 16px; /* フォントサイズ固定 */
        }

        /* 固定幅は解除してコメント化しました */
        /*
        #recipes > a.block {
            width: 400px;
            min-height: 400px;
            padding: 0 auto;
            display: block;
        }
        */

        /* 画像の固定サイズは削除し下記で代替 */
        /*
        #recipes img {
            width: 300px;
            height: 200px;
            object-fit: cover;
            border-radius: 0.5rem; 
        }
        */

        /* テキストのフォントサイズ固定 */
        #recipes h2 {
            font-size: 1.25rem;
            margin-top: 0.5rem;
        }
        #recipes p {
            font-size: 0.875rem; 
        }

        /* padding左右の固定を削除し柔軟に対応するためコメント化 */
        /*
        #recipes {
            padding-left: 20rem;   
            padding-right: 20rem;  
            grid-template-columns: repeat(3, 1fr);
            justify-content: center;
            gap: 1rem 0rem;
        }
        */
    </style>
    <title>レシピ一覧</title>
</head>
<body>
    <header>
        @include('user.user_header')
    </header>
    <h1 class="text-center text-3xl">レシピ一覧</h1>
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

    <!-- 追記部分: レシピ一覧コンテナにレスポンシブpaddingとグリッド調整 -->
    <div id="recipes" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 px-4 md:px-8 lg:px-20 mb-4">
        {{-- レシピ一覧 JSで出力--}}
    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
// プルダウン処理
function fetchRecipes(categoryId = '') {
    $.ajax({
        url: '{{ route("recipes.filter") }}',
        type: 'GET',
        data: { category: categoryId },
        dataType: 'json',
        success: function (response) {
            console.log('AJAX response:', response);
            let html = '';

            response.recipes.forEach(recipe => {
                html += `
                    <!-- 追記部分: リンクにmax-w-fullとmax-w-mdで幅制限しつつ柔軟対応 -->
                    <a href="/recipes/${recipe.id}" class="block max-w-full max-w-md mx-auto">
                        <div class="bg-white p-4 rounded-lg shadow aspect-square">
                            <!-- 追記部分: 画像の幅をfull、高さはautoに -->
                            <img src="/storage/${recipe.img}" alt="${recipe.title}" class="w-full h-auto object-cover rounded">
                            <h2 class="text-lg font-semibold mt-2">${recipe.title}</h2>
                            <p class="text-sm text-gray-600">${recipe.content.substring(0, 50)}…</p>
                            <p class="mt-1 text-sm text-gray-500">所要時間：${recipe.time}分</p>
                        </div>
                    </a>
                `;
            });

            $('#recipes').html(html);
        },
        error: function () {
            alert('レシピ一覧の取得に失敗しました。');
        }
    });
}

$(document).ready(function () {
    $('#category').val('');

    fetchRecipes();
    
    $('#category').on('change', function () {
        const categoryId = $(this).val();
        fetchRecipes(categoryId);
    });
});
</script>
</html>
