<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>カード情報入力</title>
</head>
<body class="bg-white font-sans">
    <!-- ヘッダー入れる -->
    @include('user.user_header')
    
    <div class="max-w-5xl mx-auto mt-12 px-6">
        <h1 class="text-3xl font-semibold text-center border-b-4 border-yellow-700 pb-4 mb-10">クレジットカード情報入力</h1>
        <div class="bg-white rounded-xl p-8 shadow-md">
            <form action="{{ route('register_card') }}" method="post" class="space-y-6">
                @csrf
                <div class="flex flex-col items-center">
                    <div class="space-y-2">
                        <!-- カード番号 -->
                        <div class="flex flex-col md:flex-row md:items-start gap-2 md:gap-4 text-start">
                            <label for="card_number" class="md:w-40 pt-2 font-medium text-left md:text-center text-xl">カード番号</label>
                            <div class="flex-1">
                                <input type="text" id="card_number" name="card_number" value="{{ old('card_number') }}"
                                    class="w-[70%] border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2">
                                <!-- エラー表示 -->
                                @if($errors->has('card_number'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('card_number') }}</p>
                                @endif
                            </div>
                        </div>
                        
                        <!-- カード有効期限 -->
                        <div class="flex flex-col md:flex-row md:items-start gap-2 md:gap-4 text-start">
                            <label for="month" class="md:w-40 pt-2 font-medium text-left md:text-center text-xl">カード有効期限</label>
                            <div class="flex-1">
                                <input type="text" id="month" name="month" placeholder="月" value="{{ old('month') }}"
                                    class="w-[30%] border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2">
                                <span class="text-xl">/</span>
                                <input type="text" id="year" name="year" placeholder="年" value="{{ old('year') }}"
                                    class="w-[30%] border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2">
                                @if($errors->has('month'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('month') }}</p>
                                @endif
                                @if($errors->has('year'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('year') }}</p>
                                @endif
                            </div>
                        </div>
                        
                        <!-- セキュリティコード -->
                        <div class="flex flex-col md:flex-row md:items-start gap-2 md:gap-4 text-start">
                            <label for="cvc" class="md:w-40 pt-2 font-medium text-left md:text-center text-xl">セキュリティコード</label>
                            <div class="flex-1">
                                <input type="password" id="cvc" name="cvc"
                                    class="w-[30%] border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2">
                                @if($errors->has('cvc'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('cvc') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    </div>
                <!-- 「完了ボタン」「戻るボタン」 -->
                <div class="flex flex-col text-center space-y-2 justify-around w-[80%] mx-auto sm:flex-row sm:space-y-0">
                    <a href="{{ route('revise_insert_payment') }}" class="bg-yellow-700 text-white rounded-lg py-3 px-8 font-bold hover:bg-yellow-800 transition inline-block">戻る</a>
                    <button type="submit" class="bg-yellow-700 text-white rounded-lg py-3 px-8 font-bold hover:bg-yellow-800 transition inline-block">完了</button>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>
