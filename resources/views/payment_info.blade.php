<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>決済情報入力</title>
</head>
<body class="h-screen flex flex-col items-center">
    <!-- ヘッダー入れる -->
    @include('user.user_header')
    
    <div class="flex flex-col items-center justify-arouind w-[60%] my-10 pb-10">    
        <h1 class="text-3xl font-bold mb-5">決済情報入力</h1>
        <!-- お届け先情報 -->
        <div class="w-[60%] items-start flex flex-col">
            <div class="mb-10" id="showing">
                <h2 class="text-xl font-bold mb-2">お届け先</h2>
                <div>
                    <label class="text-lg border-b-2 border-black">郵便番号</label>
                    <p id="default_postal_code" class="mt-2">{{ session('postal_code') }}</p>
                </div>
                <div class="mt-4">
                    <label class="text-lg border-b-2 border-black">都道府県</label>
                    <p id="default_prefecture" class="mt-2">{{ session('prefecture') }}</p>
                </div>
                <div class="mt-4">
                    <label for="address" class="text-lg w-full border-b-2 border-black">住所</label>
                    <p id="default_address" class="mt-2">{{ session('address') }}</p>
                </div>
                <button type="button" class="w-48 bg-sky-500 h-10 rounded-xl text-white font-black text-xl mt-5" id="change_address_btn">お届け先変更</button>
            </div>
            
            
            <!-- お届け先変更ボタンが押されたら表示するフォーム -->
            <!-- お届け先 -->
            <div class="mb-10 hidden" id="hidden_contents">
                <h2 class="text-xl font-bold mb-2">お届け先</h2>
                <div>
                    <label class="text-lg">郵便番号</label>
                    <input type="text" id="postal_code" value="{{ session('postal_code') }}">
                    <!-- エラー表示 -->
                    <p class="text-red-500" id="postal_code_error"></p>
                </div>
                <div class="mt-4">
                    <label for="prefecture" class="text-lg">都道府県</label>
                    <select id="prefecture">
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
                    <label for="address" class="text-lg w-full">住所　　</label>
                    <input type="text" id="address" value="{{ session('address') }}">
                    <!-- エラー表示 -->
                    <p class="text-red-500" id="address_error"></p>
                </div>
                <button type="button" id="change_btn" class="w-48 bg-sky-500 h-10 rounded-xl text-white font-black text-xl mt-5">変更</button>
                <button type="button" id="back_btn" class="w-48 bg-sky-500 h-10 rounded-xl text-white font-black text-xl mt-5">戻る</button>
            </div>
            
            
            <!-- 支払情報 -->
            <div class="mb-10">
                <h2 class="text-xl font-bold mb-2">支払情報</h2>
                <p class="text-lg border-b-2 border-black w-40">クレジットカード</p>
                @if(isset($shown_num))
                <p class="text-lg mt-2">カード情報末尾{{ $shown_num }}</p>
                <a href="{{ route('enter_card_info') }}" class="w-48 bg-sky-500 text-white no-underline px-6 py-2 rounded-xl block font-black text-xl mt-5">カード情報変更</a>
                @else
                <p class="mb-2 mt-2">クレジットカードが登録されていません。</p>
                <p>以下のボタンから登録してください。</p>
                <a href="{{ route('enter_card_info') }}" class="w-48 bg-sky-500 text-white no-underline px-6 py-2 rounded-xl block font-black text-xl mt-5 text-center">カード登録</a>
                @endif
            </div>
            
            <!-- クーポン -->
            <div class="mb-10">
                <h2 class="text-xl font-bold mb-2">クーポン</h2>
                <form action="{{ route('payment_confirm') }}" method="post">
                    @csrf
                    @if($coupons && count($coupons) > 0)
                        @foreach($coupons as $coupon)
                            <div class="border-2 border-solid mb-5 p-3 border-stone-950 inline-block w-auto flex items-center">
                                @if($coupon->coupon_id == session('coupon_id'))
                                    <input type="radio" class="coupon" name="coupon" value="{{ $coupon->coupon_id }}" id="{{ $coupon->coupon_id }}" class="align-middle" checked>
                                @else
                                    <input type="radio" class="coupon" name="coupon" value="{{ $coupon->coupon_id }}" id="{{ $coupon->coupon_id }}" class="align-middle">    
                                @endif
                                <label for="{{ $coupon->coupon_id }}" class="text-lg ml-1">{{ $coupon->coupons->name }}</label>
                            </div>
                            @endforeach
                            <button type="button" id="unuse_coupon_btn" class="w-auto px-3 bg-sky-500 h-10 rounded-xl text-white font-black text-xl">選択を外す</button>
                    @else
                        <p>クーポンがありません。</p>
                    @endif
                    <div>
                        <button type="submit" id="submit_btn" class="w-48 bg-sky-500 h-10 rounded-xl text-white font-black text-xl mt-10">注文確認</button>
                    </div>
                </form>
            </div>
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

        // inputタグ
        let $postal_code = $("#postal_code");
        let $prefecture = $("#prefecture");
        let $address = $("#address");

        // エラー表示
        let $postal_code_error = $("#postal_code_error");
        let $address_error = $("#address_error");
        
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