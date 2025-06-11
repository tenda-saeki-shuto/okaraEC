<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品詳細</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        @include('user.user_header')
    </header>
    <div class="container mx-auto p-4">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <img src="{{ asset('images/sample.jpg') }}" alt="商品画像" class="w-full h-64 object-cover rounded-lg mb-4">
            <h2 class="text-2xl font-semibold mb-2">
                {{$item->name}}
            </h2>
            <p class="text-gray-700 mb-4">
                {{$item->content}}
            </p>
            <p class="text-xl font-bold text-red-600 mb-4">
                ¥{{$item->price}}
            </p>
            <p class="mb-4">栄養素情報</p>

            <ul class="list-disc pl-5 mb-4">
                <li>エネルギー: {{$item->nutritionFacts->energy }}kcal</li>
                <li>タンパク質: {{$item->nutritionFacts->protein}}g</li>
                <li>脂質: {{$item->nutritionFacts->fat}}g</li>
                <li>炭水化物: {{$item->nutritionFacts->carb}}g</li>
                <li>食物繊維: {{$item->nutritionFacts->fiber}}g</li>
                <li>食塩相当量: {{$item->nutritionFacts->salt_eqv}}mg</li>
            </ul>
            <p class="mb-4">アレルギー情報</p>
            @if ($item->itemAllergies && $item->itemAllergies->Allergies)
                @php
                    $allergies = $item->itemAllergies->Allergies;
                @endphp

                @if (is_iterable($allergies))
                    @foreach ($allergies as $allergy)
                        <span class="inline-block bg-yellow-200 text-yellow-800 px-2 py-1 rounded mr-2 mb-2">
                            {{ $allergy->name }}
                        </span>
                    @endforeach
                @else
                    <span class="inline-block bg-yellow-200 text-yellow-800 px-2 py-1 rounded mr-2 mb-2">
                        {{ $allergies->name }}
                    </span>
                @endif
            @else
                <p>アレルギー情報はありません。</p>
            @endif



            <form action="" method="POST">
                @csrf
                <input type="hidden" name="item_id" value="1">
                <div class="flex items-center mb-4 text-right">
                    <label for="quantity" class="mr-2">数量:</label>
                    <select name="count" class="border rounded">
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="position:right flex justify-end">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors duration-300 mr-5 ml-8 w-30">
                        定期購入
                    </button>
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition-colors duration-300 w-30">
                        カートに追加
                    </button>
                </div>
            </form>

        </div>
    </div>
</body>
</html>
