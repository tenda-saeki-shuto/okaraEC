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
<body class="bg-white font-sans text-gray-800 m-0 p-0">
    @include('user.user_header')

    <div class="container mx-auto p-4">
        <div class="bg-white p-6 rounded-lg shadow-md flex flex-col">
            <!-- メイン画像 -->
            <img src="{{ asset('/storage/'. $item->img) }}" alt="クッキー" id="main-image" class="w-full max-w-[600px] h-auto aspect-[4/3] object-cover rounded-lg mb-4 mx-auto">
            <!-- サブ画像 -->
            <div class="w-full max-w-[70%] mx-auto grid grid-cols-2 place-items-center sm:grid-cols-4 gap-4 place-items-center sub_images">
                @foreach($item->itemPictures as $picture)
                <img src="{{ asset('/storage/'. $picture->img) }}" alt="抹茶ドーナツ" class="h-25 w-25 md:h-45 w-45 object-cover rounded-lg mb-4 transition-transform duration-300 hover:scale-105 cursor-pointer">
                @endforeach
            </div>
            <div class="items-center">
                <h2 class="text-3xl font-semibold mb-2 inline-block">
                    {{$item->name}}
                </h2>
                <button class="favorite-btn inline-block ml-5" data-item-id="{{$item->id}}">
                    <i class="fa fa-heart {{ $item->is_favorited ? 'text-danger' : 'text-secondary' }}"></i>
                </button>
            </div>
            <p class="text-gray-700 mb-4 mt-4 text-lg">
                {{$item->content}}
            </p>
            <p class="text-xl font-bold text-red-600 mb-4">
                ¥{{$item->price}}
            </p>
            @if(!isset($cart_item))
            <form action="{{ route('cart.add')}}" method="POST">
                @csrf
                <input type="hidden" name="item_id" value="{{$item->id}}">
                <div class="flex flex-col md:flex-row items-start md:items-center gap-2 md:gap-x-4">
                    <div>
                        <label class="text-lg">数量:</label>
                        <select name="count" class="border rounded">
                            @for ($i = 1; $i <= $item->stock; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="bg-white text-yellow-700 text-lg border-2 border-yellow-700 rounded-lg py-2 px-6 font-bold hover:bg-yellow-700 hover:text-white transition">
                            カートに追加
                        </button>
                    </div>
                </div>
            </form>
            @else
            <form action="{{ route('cart.update', ['id'=>$cart_item->item_id])}}" method="POST">
                @csrf
                <div class="flex flex-col md:flex-row items-start md:items-center gap-2 md:gap-x-4">
                    <div>
                        <label class="text-lg">カート内数量:</label>
                        <select name="count" class="border rounded">
                            @for($i = 1; $i <= 50; $i++)
                                <option value="{{ $i }}" {{ $cart_item->count == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="bg-white text-yellow-700 text-lg border-2 border-yellow-700 rounded-lg py-2 px-6 font-bold hover:bg-yellow-700 hover:text-white transition">
                            数量変更
                        </button>
                    </div>
                </div>
            </form>
            @endif

            <h3 class="mb-4 text-xl mt-5 font-semibold">栄養素情報</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-2">
                <div class="bg-gray-100 p-4 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-center">エネルギー</h3>
                    <p class="text-center text-2xl font-bold">{{$item->nutritionFacts->energy }}kcal</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-center">タンパク質</h3>
                    <p class="text-center text-2xl font-bold">{{$item->nutritionFacts->protein}}g</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-center">脂質</h3>
                    <p class="text-center text-2xl font-bold">{{$item->nutritionFacts->fat}}g</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-center">炭水化物</h3>
                    <p class="text-center text-2xl font-bold">{{$item->nutritionFacts->carb}}g</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-center">食物繊維</h3>
                    <p class="text-center text-2xl font-bold">{{$item->nutritionFacts->fiber}}g</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-center">食塩相当量</h3>
                    <p class="text-center text-2xl font-bold">{{$item->nutritionFacts->salt_eqv}}mg</p>
                </div>
            </div>

            <h3 class="mb-4 text-xl mt-5 font-semibold">アレルギー情報</h3>
            <div class="flex flex-wrap">
                @if ($item->itemAllergies && $item->itemAllergies->isNotEmpty())
                    @foreach ($item->itemAllergies as $itemAllergy)
                        @if ($itemAllergy->allergies)
                            <div class="inline-block bg-yellow-200 text-lg text-yellow-800 px-2 py-1 rounded mr-2 mb-2">
                                {{ $itemAllergy->allergies->name }}
                            </div>
                        @endif
                    @endforeach
                @else
                    <p class="text-lg">アレルギー情報はありません。</p>
                @endif
            </div>
        </div> <!-- ★この div の外側にボタンを移動 -->

        <!-- ★★★ ここから追記：枠の外・左寄せに戻るボタン配置 ★★★ -->
        <div class="mt-6 text-left">
            <a href="{{ route('items') }}"
               class="inline-block bg-white text-yellow-700 border-2 border-yellow-700 rounded-lg py-3 px-8 font-bold hover:bg-yellow-700 hover:text-white transition">
                商品一覧へ戻る
            </a>
        </div>
        <!-- ★★★ 追記ここまで ★★★ -->

    </div>

    @if (session('success'))
    <div id="popup-message" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded shadow-lg z-50 transition-opacity duration-500" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @elseif(session('error'))
    <div id="popup-message" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded shadow-lg z-50 transition-opacity duration-500" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    <!-- ★★ 削除済み：以前の戻るボタン配置（max-w-[600px]） -->
    {{-- 
    <div class="max-w-[600px] mx-auto mt-6">
        <a href="{{ route('items') }}"
        class="inline-block bg-white text-yellow-700 border-2 border-yellow-700 rounded-lg py-3 px-8 font-bold hover:bg-yellow-700 hover:text-white transition">
            商品一覧へ戻る
        </a>
    </div>
    --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
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
                error: function () {
                    window.location.href = '/login?redirect=' + encodeURIComponent(window.location.pathname);
                }
            });
        });

        $(function(){
            const $mainImage = $('#main-image');
            $('.sub_images img').click(function(){
                const newSrc = $(this).attr('src');
                const newAlt = $(this).attr('alt');
                $mainImage.fadeOut(200, function() {
                    $mainImage.attr('src', newSrc);
                    $mainImage.attr('alt', newAlt);
                    $mainImage.fadeIn(200);
                });
            });
        });

        setTimeout(() => {
            const popup = document.getElementById('popup-message');
            if (popup) {
                popup.style.opacity = '0';
                setTimeout(() => popup.remove(), 500);
            }
        }, 2000);
    </script>
</body>
</html>
