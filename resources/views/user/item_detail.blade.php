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
            <img src="{{ asset('img/cookie.png') }}" alt="クッキー" id="main-image" class="w-full max-w-[600px] h-auto aspect-[4/3] object-cover rounded-lg mb-4 mx-auto">
            <!-- サブ画像4つ -->
            <div class="w-full max-w-[70%] mx-auto grid grid-cols-2 place-items-center sm:grid-cols-4 gap-4 place-items-center sub_images">
                <img src="{{ asset('img/mattch_dounut.png') }}" alt="抹茶ドーナツ" class="h-25 w-25 md:h-45 w-45 object-cover rounded-lg mb-4 transition-transform duration-300 hover:scale-105 cursor-pointer">
                <img src="{{ asset('img/mattcha_cookie.png') }}" alt="抹茶クッキー" class="h-25 w-25 md:h-45 w-45 object-cover rounded-lg mb-4 transition-transform duration-300 hover:scale-105 cursor-pointer">
                <img src="{{ asset('img/cookie.png') }}" alt="クッキー" class="h-25 w-25 md:h-45 w-45 object-cover rounded-lg mb-4 transition-transform duration-300 hover:scale-105 cursor-pointer">
                <img src="{{ asset('img/mince.png') }}" alt="ハンバーグ" class="h-25 w-25 md:h-45 w-45 object-cover rounded-lg mb-4 transition-transform duration-300 hover:scale-105 cursor-pointer">
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
            <!-- 表示された商品がカート内にない場合 -->
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
            <!-- 表示された商品がカート内にある場合 -->
            <form action="{{ route('cart.update', ['id'=>$cart_item->item_id])}}" method="POST">
                @csrf
                <div class="flex flex-col md:flex-row items-start md:items-center gap-2 md:gap-x-4">
                    <div>
                        <label class="text-lg">カート内数量:</label>
                        <select name="count" class="border rounded">
                            @for($i = 1; $i <= 50; $i++)
                                @if($cart_item->count == $i)
                                <option value="{{ $cart_item->count }}" selected>{{ $cart_item->count }}</option>
                                @else
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endif
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

            <!-- 栄養情報 -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-2">
                <!-- エネルギー -->
                <div class="bg-gray-100 p-4 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-center">エネルギー</h3>
                    <p class="text-center text-2xl font-bold">{{$item->nutritionFacts->energy }}kcal</p>
                </div>

                <!-- タンパク質 -->
                <div class="bg-gray-100 p-4 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-center">タンパク質</h3>
                    <p class="text-center text-2xl font-bold">{{$item->nutritionFacts->protein}}g</p>
                </div>

                <!-- 脂質 -->
                <div class="bg-gray-100 p-4 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-center">脂質</h3>
                    <p class="text-center text-2xl font-bold">{{$item->nutritionFacts->fat}}g</p>
                </div>

                <!-- 炭水化物 -->
                <div class="bg-gray-100 p-4 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-center">炭水化物</h3>
                    <p class="text-center text-2xl font-bold">{{$item->nutritionFacts->carb}}g</p>
                </div>

                <!-- 食物繊維 -->
                <div class="bg-gray-100 p-4 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-center">食物繊維</h3>
                    <p class="text-center text-2xl font-bold">{{$item->nutritionFacts->fiber}}g</p>
                </div>

                <!-- 食塩相当量 -->
                <div class="bg-gray-100 p-4 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-center">食塩相当量</h3>
                    <p class="text-center text-2xl font-bold">{{$item->nutritionFacts->salt_eqv}}mg</p>
                </div>
            </div>

            <!-- アレルギー情報 -->
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

            {{-- 定期購入
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors duration-300 mr-5 ml-8 w-30">
                定期購入
            </button> --}}
        </div>
    </div>

    {{-- 追加後のメッセージ表示 --}}
    @if (session('success'))
    <div id="popup-message" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded shadow-lg z-50 transition-opacity duration-500" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @elseif(session('error'))
    <div id="popup-message" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded shadow-lg z-50 transition-opacity duration-500" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
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

    // メインとサブ画像の切り替え
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
</script>

    <script>
        // 2秒後にフェードアウト
        setTimeout(() => {
            const popup = document.getElementById('popup-message');
            if (popup) {
                popup.style.opacity = '0';
                setTimeout(() => popup.remove(), 500); // フェードアウト後に削除
            }
        }, 2000);
    </script>
</html>
