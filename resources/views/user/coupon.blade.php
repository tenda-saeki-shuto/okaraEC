<!DOCTYPE html>
<html lang="ja">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>取得クーポン</title>
</head>
<body>
    <header>
        @include('user.user_header')
    </header>

    <div class="p-4">
        @if($user_coupons->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($user_coupons as $user_coupon)
                    <div class="bg-white rounded-lg shadow-md p-4 text-center">
                        {{-- <img src="{{ asset('img/' . $user_coupon->coupons->img) }}" alt="クーポン画像" class="w-full h-auto rounded-md mb-2"> --}}
                        <div class="text-lg font-semibold text-gray-800">{{ $user_coupon->coupons->name }}</div>
                        <div class="text-sm text-gray-600 mt-1">{{ $user_coupon->coupons->content }}</div>
                        <div class="text-xs text-gray-500 mt-2">
                            有効期限: {{ \Carbon\Carbon::parse($user_coupon->valid_at)->format('Y年n月j日') }}
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-gray-700 mb-4">クーポンを取得していません</div>
            <div class="text-center">
                <a href="{{ route('user.quiz') }}" class="text-blue-500 underline">クイズ</a>に正解してクーポンゲット！！
            </div>
        @endif

        <div class="mt-8 text-center">
            <button onclick="location.href='{{ route('view.mypage') }}'" class="bg-blue-300 hover:bg-blue-400 text-white font-semibold py-2 px-4 rounded">
                マイページへ
            </button>
        </div>
    </div>

</body>
</html>
