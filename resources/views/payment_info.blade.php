<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>注文情報入力</title>
</head>
<body class="bg-white font-sans text-gray-800 m-0 p-0">
    <!-- ヘッダー入れる -->
    @include('user.user_header')
    
    <div class="max-w-5xl mx-auto mt-8 p-6 h-200">    
        <h1 class="text-3xl font-semibold text-center border-b-4 border-yellow-700 pb-4 mb-10">注文情報入力</h1>

        <div class="w-full bg-white p-6 sm:p-8 rounded-xl shadow-lg">
            <!-- お届け先情報 -->
            <!-- <div class="w-[60%] items-start flex flex-col"> -->
                <div id="showing" class="space-y-4 mb-5">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-700 border-b-2 border-yellow-700 pb-2 mb-4">お届け先</h2>
                    <div>
                        <label class="block text-gray-700 text-lg font-semibold mb-1">郵便番号</label>
                        <p id="default_postal_code" class="text-lg text-gray-900">{{ session('postal_code') }}</p>
                    </div>
                    <div class="mt-4">
                        <label class="block text-gray-700 text-lg font-semibold mb-1">都道府県</label>
                        <p id="default_prefecture" class="text-lg text-gray-900">{{ session('prefecture') }}</p>
                    </div>
                    <div class="mt-4">
                        <label for="address" class="block text-gray-700 text-lg font-semibold mb-1">住所</label>
                        <p id="default_address" class="text-lg text-gray-900">{{ session('address') }}</p>
                    </div>
                    <button type="button" class="bg-white text-yellow-700 border-2 border-yellow-700 rounded-lg py-3 px-8 font-bold hover:bg-yellow-700 hover:text-white transition" id="change_address_btn">お届け先変更</button>
                </div>
                
                
                <!-- お届け先変更ボタンが押されたら表示するフォーム -->
                <!-- お届け先 -->
                <div id="hidden_contents" class="hidden space-y-4 mb-5">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-700 border-b-2 border-yellow-700 pb-2 mb-4">お届け先</h2>
                    <div>
                        <label for="postal_code" class="block text-gray-700 text-lg font-semibold mb-1">郵便番号</label>
                        <input type="text" id="postal_code" value="{{ session('postal_code') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 text-lg text-gray-900">
                        <!-- エラー表示 -->
                        <p id="postal_code_error" class="text-red-500 text-xs mt-1"></p>
                    </div>
                    <div class="mt-4 relative">
                        <label for="prefecture" class="block text-gray-700 text-lg font-semibold mb-1">都道府県</label>
                        <select id="prefecture"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 text-lg text-gray-900">
                            @foreach($prefectures as $prefecture)
                                @if($prefecture->id == session('prefecture_id'))
                                    <option value="{{ $prefecture->id }}" selected>{{ $prefecture->name }}</option>
                                @else
                                    <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-4">
                        <label for="address" class="block text-gray-700 text-lg font-semibold mb-1">住所</label>
                        <input type="text" id="address" value="{{ session('address') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 text-lg text-gray-900">
                        <!-- エラー表示 -->
                        <p id="address_error" class="text-red-500 text-xs mt-1"></p>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0 mt-6">
                        <button type="button" id="change_btn" class="bg-white text-yellow-700 border-2 border-yellow-700 rounded-lg py-3 px-8 font-bold hover:bg-yellow-700 hover:text-white transition">変更</button>
                        <button type="button" id="back_btn" class="bg-white text-yellow-700 border-2 border-yellow-700 rounded-lg py-3 px-8 font-bold hover:bg-yellow-700 hover:text-white transition">戻る</button>
                    </div>
                </div>
                
                
                <!-- 支払情報 -->
                <div class="space-y-4 mb-5">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-700 border-b-2 border-yellow-700 pb-2 mb-4">支払情報</h2>
                    <p class="block text-gray-900 text-lg font-semibold mb-1">クレジットカード</p>
                    @if(isset($shown_num))
                    <p class="text-lg text-gray-900">カード情報末尾 **** **** **** {{ $shown_num }}</p>
                    <a href="{{ route('enter_card_info') }}" class="bg-white text-yellow-700 border-2 border-yellow-700 rounded-lg py-3 px-8 font-bold hover:bg-yellow-700 hover:text-white transition inline-block">カード情報変更</a>
                    @else
                    <p class="mb-2 mt-2 text-gray-900 text-lg">クレジットカードが登録されていません。</p>
                    <p class="text-lg text-gray-900">以下のボタンから登録してください。</p>
                    <a href="{{ route('enter_card_info') }}" class="bg-white text-yellow-700 border-2 border-yellow-700 rounded-lg py-3 px-8 font-bold hover:bg-yellow-700 hover:text-white transition inline-block">カード登録</a>
                    @endif
                </div>
                
                <!-- クーポン -->
                <div class="space-y-4">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-700 border-b-2 border-yellow-700 pb-2 mb-4">クーポン</h2>
                    <form action="{{ route('payment_confirm') }}" method="post">
                        @csrf
                        @if(count($coupons) > 0 && $total >= 2000)
                        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach($coupons as $coupon)
                            <div class="border-2 border-solid rounded-md mb-5 p-3 border-gray-600 inline-block w-70 flex items-center ">
                                @if($coupon->coupon_id == session('coupon_id'))
                                    <input type="radio" class="coupon" name="coupon" value="{{ $coupon->coupon_id }}" id="{{ $coupon->coupon_id }}" class="align-middle" checked>
                                @else
                                    <input type="radio" class="coupon" name="coupon" value="{{ $coupon->coupon_id }}" id="{{ $coupon->coupon_id }}" class="align-middle">    
                                @endif
                                <label for="{{ $coupon->coupon_id }}" class="text-lg ml-2">{{ $coupon->coupons->name }}</label>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" id="unuse_coupon_btn" class="bg-white text-yellow-700 border-2 border-yellow-700 rounded-lg py-3 px-8 font-bold hover:bg-yellow-700 hover:text-white transitionmt-4">選択を外す</button>
                        @else
                            <p class="text-lg text-gray-900">使用できるクーポンがありません。</p>
                        @endif
                        <div class="pt-8 flex items-center w-full space-x-8">
                            <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0 mt-6">
                                <a href="{{ route('cart') }}" class="bg-white text-yellow-700 border-2 border-yellow-700 py-3 px-8 rounded-lg px-8 font-bold hover:bg-yellow-700 hover:text-white transition inline-block">カートへ戻る</a>
                                @if(isset($shown_num))
                                <button type="submit" class="bg-white text-yellow-700 border-2 border-yellow-700 py-3 px-8 rounded-lg px-8 font-bold hover:bg-yellow-700 hover:text-white transition inline-block">確認</button>
                                @else
                                <button type="button" id="submit_btn" class="bg-white text-yellow-700 border-2 border-yellow-700 py-3 px-8 rounded-lg px-8 font-bold hover:bg-yellow-700 hover:text-white transition inline-block">確認</button>
                            </div>
                        </div>
                        <p id="submit_error" class="text-red-500 text-sm mt-2 block"></p>
                        @endif
                    </form>
                </div>
            <!-- </div> -->
        </div>
    </div>

    <script>
        // クラストグル用の要素
        let $user_address = $("#showing");
        let $change_address = $("#hidden_contents");

        // ボタン要素
        let $change_address_btn = $("#change_address_btn");
        let $change_btn = $("#change_btn");
        let $back_btn = $("#back_btn");
        let $unuse_coupon_btn = $("#unuse_coupon_btn");
        let $submit_btn = $("#submit_btn");

        // inputタグ
        let $postal_code = $("#postal_code");
        let $prefecture = $("#prefecture");
        let $address = $("#address");

        // エラー表示
        let $postal_code_error = $("#postal_code_error");
        let $address_error = $("#address_error");
        let $submit_error = $("#submit_error");
        
        // お届け先変更ボタンを押したときの処理
        $change_address_btn.on('click', function(){
            // user_addressにhiddenクラスを追加し、デフォルトの住所表示を消す
            // お届け先入力フォームを出す
            $user_address.toggleClass('hidden');
            $change_address.toggleClass('hidden');
        });
        
        // お届け先変更フォームで戻るボタンを押したときの処理
        $back_btn.on('click', function(){
            // user_addressにhiddenクラスを追加し、デフォルトの住所表示を消す
            // お届け先入力フォームを出す
            $user_address.toggleClass('hidden');
            $change_address.toggleClass('hidden');
        });

        // クレジットカード情報を登録せずに「注文確認」ボタンを押した際の処理
        $submit_btn.on('click', function(){
            // エラー表示
            $submit_error.html('クレジットカードを登録してください。');
        });

        $(function(){
            // 「変更」ボタンを押したときの処理
            $change_btn.on('click', function(){
                // 入力値の取得
                let postal_code_value = $postal_code.val();  //入力された郵便番号の取得
                let prefecture_id = $prefecture.val(); //入力された都道府県のIDを取得
                let address_value = $address.val();  // 入力された住所の取得
               
                // ajax通信
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url:'/validate_address', 
                    data: {
                        postal_code: postal_code_value,
                        prefecture_id: prefecture_id,
                        address: address_value,
                    }
                }).done(function (results){
                    // セッション情報の上書き
                    // 表示を更新
                    $('#default_postal_code').text(results.postal_code);
                    $('#default_address').text(results.address);
                    $('#default_prefecture').text(results.prefecture);

                    // フォーム切り替え
                    $user_address.toggleClass('hidden');
                    $change_address.toggleClass('hidden');

                }).fail(function(jqXHR){
                    // バリデーションのエラーを出す
                    if (jqXHR.status === 422) {
                        const errors = jqXHR.responseJSON.errors;

                        // 既存エラーをクリア
                        $postal_code_error.text('');
                        $address_error.text('');

                        // エラーがあれば表示
                        if(errors.postal_code){
                            $postal_code_error.text(errors.postal_code[0]);
                        }

                        if(errors.address){
                            $address_error.text(errors.address[0]);
                        }
                    }
                });
            });

            //クーポン選択を外すボタンを押したときの処理(セッションのcoupon_idを消し、すべてのラジオボタンのcheckedを外す) 
            $unuse_coupon_btn.on('click', function(){
                // ajax通信
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url:'/unuse_coupon', 
                }).done(function (results){
                    $('.coupon').prop('checked', false);
                    
                }).fail(function(jqXHR){
                    console.log('fail');
                });
            });

        });
    </script>
</body>
</html>