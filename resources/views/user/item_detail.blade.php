<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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

    <title>商品詳細</title>

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
            <button class="favorite-btn" data-item-id="{{$item->id}}">
                <i class="fa fa-heart {{ $item->is_favorited ? 'text-danger' : 'text-secondary' }}"></i>
            </button>
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



            <form action="{{ route('cart.add')}}" method="POST">
                @csrf
                <input type="hidden" name="item_id" value="{{$item->id}}">
                <div class="flex items-center mb-4 text-right">
                    <label for="quantity" class="mr-2">数量:</label>
                    <select name="count" class="border rounded">
                        @if ($item->stock < 10)
                            @for ($i = 1; $i <= $item->stock; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        @else
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        @endif
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
    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">成功！</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    //お気に入り処理
    $(document).on('click', '.favorite-btn', function (e) {
    e.preventDefault();
    const button = $(this);
    const itemId = button.data('item-id');
    const icon = button.find('i');

    $.ajax({
        url: '/favorite/toggle',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        contentType: 'application/json',
        data: JSON.stringify({ item_id: itemId }),
        success: function (response) {
            if (response.liked) {
                icon.removeClass('text-secondary').addClass('text-danger');
            } else {
                icon.removeClass('text-danger').addClass('text-secondary');
            }
        },
        //エラー処理、ログインしていなかったらログイン画面にリダイレクト
        error: function () {
            window.location.href = '/login?redirect=' + encodeURIComponent(window.location.pathname);

        }
    });
    });
</script>
</html>
