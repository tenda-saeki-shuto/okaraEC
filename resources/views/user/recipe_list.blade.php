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

        #recipes > a.block {
            width: 400px;
            min-height: 400px;
            padding: 0 auto;
            display: block;
        }

        /* 画像の固定サイズ */
        #recipes img {
            width: 300px;
            height: 200px;
            object-fit: cover;
            border-radius: 0.5rem; /* rounded-lg相当 */
        }

        /* テキストのフォントサイズ固定 */
        #recipes h2 {
            font-size: 1.25rem;
            margin-top: 0.5rem;
        }
        #recipes p {
            font-size: 0.875rem; 
        }

        #recipes {
            padding-left: 20rem;   
            padding-right: 20rem;  
            grid-template-columns: repeat(3, 1fr);
            justify-content: center;
            gap: 1rem 0rem; /* 上下間隔1rem、左右間隔0.3remに狭く */
        }
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
            <!-- カテゴリがある間それを表示 -->
            <option value="" {{ empty(request('category')) ? 'selected' : '' }}>全て</option>
            @foreach ($category as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach

        </select>
    </form>
    </div>


        <div id="recipes" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 ml-4 mr-4 mb-4">
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
                    <a href="/recipes/${recipe.id}" class="block">
                        <div class="bg-white p-4 rounded-lg shadow aspect-[1/1]">
                            <img src="/storage/${recipe.img}" alt="${recipe.title}"
                            class="w-full h-48 object-cover rounded">
                            <h2 class="text-lg font-semibold mt-2">${recipe.title}</h2>
                            <p class="text-sm text-gray-600">${recipe.content.substring(0, 50)}…</p>
                            <p class="mt-1 text-sm text-gray-500">所要時間：${recipe.time}分</p>
                        </div>
                    </a>
                `;
            });
            //指定した要素の中身を新しいHTML文字列で置き換える
            $('#recipes').html(html);
        },
        error: function () {
            alert('レシピ一覧の取得に失敗しました。');
        }
    });
}

    // 初期表示で「すべて」に設定
    $(document).ready(function () {
        $('#category').val('');

        //最初に全レシピを取得して表示
        fetchRecipes();
        
        //カテゴリが変更されたら再読み込み
        $('#category').on('change', function () {
            const categoryId = $(this).val();
            fetchRecipes(categoryId);
        });
    });
</script>
</html>
