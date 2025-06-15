<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>お気に入り一覧</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        #item_list {
            max-width: 1280px; /* 例：400px × 3列 + gap込みの幅を想定 */
            margin-left: auto;
            margin-right: auto;
            gap: 1rem 2rem;
        }
    </style>

</head>
<body>

    <header>
        @include('user.user_header')
    </header>

<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">お気に入り一覧</h1>

    {{-- お気に入り登録がある場合 --}}
    @if($items->isNotEmpty())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4">
            @foreach($items as $item)
                <a href="/item/{{$item->id}}" class="block no-underline">
                    <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow duration-300 aspect-[1/1]">
                        <img src="/images/{{$item->image}}" alt="{{$item->name}}" class="w-4/6 h-4/6 object-cover rounded-t-lg mx-auto">
                        <div class="text-xl font-bold mt-2 text-center relative">
                            {{ $item->name }}
                            @if ($item->is_frozen === 1)
                                <div class="bg-pink-300 text-center w-1/4 text-base rounded-full mx-auto mt-1">冷凍商品</div>
                            @endif
                        </div>
                        <p class="text-gray-600 text-center">¥{{ number_format($item->price) }}</p>
                        <div class="text-center mt-2">
                            <button type="button" class="favorite-btn" data-item-id="{{$item->id}}">
                                <i class="fa fa-heart {{$item->is_favorited ? 'text-danger' : 'text-secondary'}}"></i>
                            </button>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    {{-- お気に入り登録がない場合 --}}
    @else
        <div class="text-center mt-10">
            <p class="text-lg text-gray-600 mb-4">何も登録されていません</p>
            <button onclick="location.href='{{ route('items') }}'" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                商品一覧へ
            </button>
        </div>
    @endif
</div>


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
