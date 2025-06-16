<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>カード情報入力</title>
</head>
<body>
    <!-- ヘッダー入れる -->
    @include('user.user_header')
    
    <div class="container">
        <h1>クレジットカード情報入力</h1>
        <form action="{{ route('register_card') }}" method="post">
            @csrf
            <div class="contents">
                <!-- カード番号 -->
                <div>
                    <label for="numlber">カード番号　　　　　</label>
                    <input type="text" name="card_number" value="{{ old('card_number') }}">
                    <!-- エラー表示 -->
                    @if($errors->has('card_number'))
                    <p class="text-red-500">{{ $errors->first('card_number') }}</p>
                    @endif
                </div>
                
                <!-- カード有効期限 -->
                <div>
                    <label for="numlber">カード有効期限　　　</label>
                    <input type="text" size="5" name="month" placeholder="月" value="{{ old('month') }}">
                    <span>/</span>
                    <input type="text" size="5" name="year" placeholder="年" value="{{ old('year') }}">
                    @if($errors->has('month'))
                    <p class="text-red-500">{{ $errors->first('month') }}</p>
                    @endif
                    @if($errors->has('year'))
                    <p class="text-red-500">{{ $errors->first('year') }}</p>
                    @endif
                </div>
                
                <!-- セキュリティコード -->
                <div>
                    <label for="numlber">セキュリティコード　</label>
                    <input type="password" size="5" name="cvc">
                    @if($errors->has('cvc'))
                    <p class="text-red-500">{{ $errors->first('cvc') }}</p>
                    @endif
                </div>
            </div>
            <button type="submit" class="w-48 bg-sky-500 text-white no-underline px-6 py-2 rounded-xl block font-black text-xl mt-5">完了</button>
            <a href="{{ route('revise_insert_payment') }}" class="w-48 bg-sky-500 text-white no-underline px-6 py-2 rounded-xl block font-black text-xl mt-5 text-center">戻る</a>
        </form>
    </div>
    
</body>
</html>
