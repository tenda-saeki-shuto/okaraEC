<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('user_stylesheet/recipe_style.css') }}">

    <style>
        .favorite-btn i {
            font-size: 24px;
            transition: color 0.3s ease;
        }
        .text-danger {
            color: red;
        }
        .text-secondary {
            color: gray;
        }
    </style>

    <title>レシピ詳細</title>

</head>
<body>
    <header>
        @include('user.user_header')
    </header>
    <div class="container mx-auto p-4">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <!-- Flexboxを使用して画像と栄養素情報を横並びに配置 -->

            <div class="flex flex-col lg:flex-row gap-6">
                <!-- 左側：画像とタイトル -->
                <div class="lg:w-1/2 flex flex-col items-center">
                <!-- レシピ名 -->
                <p class="text-2xl font-bold mb-2 text-left w-full">{{ $recipe->title }}</p>
                <!-- 商品画像 -->
                <img src="{{ asset('images/sample.jpg') }}" alt="商品画像" class="w-full h-64 object-cover rounded-lg">
            </div>


                
                <div class="lg:w-1/2">
                    

                    <!-- 所要時間 -->
                    <h2 class="text-2xl font-semibold mb-2">
                       <p>所要時間：{{$recipe->time}}</p>
                    </h2>

                    <!-- 栄養情報 -->
                    <p class="heading text-2xl font-semibold mb-2">栄養素情報</p>

                    <!-- タイル風カードレイアウト -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- エネルギー -->
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <h3 class="text-xl font-semibold text-center">エネルギー</h3>
                            <p class="text-center text-2xl font-bold">{{ $recipe->recipeNutritionFacts->energy }} kcal</p>
                        </div>

                        <!-- タンパク質 -->
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <h3 class="text-xl font-semibold text-center">タンパク質</h3>
                            <p class="text-center text-2xl font-bold">{{ $recipe->recipeNutritionFacts->protein }} g</p>
                        </div>

                        <!-- 脂質 -->
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <h3 class="text-xl font-semibold text-center">脂質</h3>
                            <p class="text-center text-2xl font-bold">{{ $recipe->recipeNutritionFacts->fat }} g</p>
                        </div>

                        <!-- 炭水化物 -->
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <h3 class="text-xl font-semibold text-center">炭水化物</h3>
                            <p class="text-center text-2xl font-bold">{{ $recipe->recipeNutritionFacts->carb }} g</p>
                        </div>

                        <!-- 食物繊維 -->
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <h3 class="text-xl font-semibold text-center">食物繊維</h3>
                            <p class="text-center text-2xl font-bold">{{ $recipe->recipeNutritionFacts->fiber }} g</p>
                        </div>

                        <!-- 食塩相当量 -->
                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <h3 class="text-xl font-semibold text-center">食塩相当量</h3>
                            <p class="text-center text-2xl font-bold">{{ $recipe->recipeNutritionFacts->salt_eqv }} mg</p>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <!-- 説明文（画像の下に配置） -->
            <p class="text-gray-700 mb-4 text-left ">
                {{$recipe->content}}
            </p>

            <!-- 材料 -->
            <p class="heading text-2xl font-semibold mb-4">材料・分量</p>

            @if ($recipe->recipeIngredients->isNotEmpty())
            <!-- 追加：gridを使って2列レイアウト。モバイルは1列、幅広画面で2列表示 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-2">
                @foreach ($recipe->recipeIngredients as $ingredient)
                <div class="flex justify-between items-start p-3 bg-gray-50 rounded-md shadow-sm">
                    <!-- 名前：左寄せかつ折り返しOK -->
                    <span class="font-medium text-gray-800">
                    {{ $ingredient->name }}
                    </span>
                    <!-- 分量：左マージンを持たせて読みやすい -->
                    <span class="text-gray-600 ml-2">
                    {{ $ingredient->amount }}
                    </span>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-500">材料情報はありません。</p>
            @endif
            <br>

            <!-- 調理手順 -->
            <h2 class="heading text-2xl font-semibold mb-4">調理手順</h2>

            @if ($recipe->recipeSteps->isNotEmpty())
            <ol class="list-decimal list-inside space-y-6">
                @foreach ($recipe->recipeSteps as $step)
                <li>
                    <div class="flex items-start gap-x-4">
                    @if ($step->img)
                        <img
                        src="{{ asset('images/' . $step->img) }}"
                        alt="Step {{ $loop->iteration }}"
                        class="w-24 h-24 object-cover rounded-md flex-shrink-0"
                        >
                    @endif
                    <p class="text-gray-700 leading-relaxed whitespace-nowrap overflow-auto">
                        {{ $step->content }}
                    </p>
                    </div>
                </li>
                @endforeach
            </ol>
            @else
            <p class="text-gray-500">調理手順はありません。</p>
            @endif


        </div>


    <a href="{{ route('recipes') }}" class="inline-block mt-5 mb-6 bg-white text-yellow-700 border-2 border-yellow-700 rounded-lg py-3 px-8 font-bold hover:bg-yellow-700 hover:text-white transition">レシピ一覧へ戻る</a>




</body>
</html>
