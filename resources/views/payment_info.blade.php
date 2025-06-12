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
        
        <div class="w-[60%] items-start flex flex-col">
            <div class="mb-10" id="showing">
                <h2 class="text-xl font-bold mb-2">お届け先</h2>
                <div>
                    <label class="text-lg">郵便番号</label>
                    @foreach($user_info as $info)
                    <p id="default_postal_code">{{ $info->addresses->postal_code }}</p>
                    @endforeach
                </div>
                <div class="mt-4">
                    <label class="text-lg">都道府県</label>
                    <p id="default_prefecture">{{ $user_prefecture }}</p>
                </div>
                <div class="mt-4">
                    <label for="address" class="text-lg w-full">住所</label>
                    @foreach($user_info as $info)
                    <p id="default_address">{{ $info->addresses->address }}</p>
                    @endforeach
                </div>
                <button class="w-48 bg-sky-500 h-10 rounded-xl text-white font-black text-xl mt-5" id="change_address_btn">お届け先変更</button>
            </div>
            
            
            <!-- お届け先変更ボタンが押されたら表示 -->
            <div class="mb-10 hidden" id="hidden_contents">
                <h2 class="text-xl font-bold mb-2">お届け先</h2>
                <div>
                    <label class="text-lg">郵便番号</label>
                    <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}">
                    <!-- エラー表示 -->
                    <p class="text-red-500" id="postal_code_error"></p>
                </div>
                <div class="mt-4">
                    <label for="prefecture" class="text-lg">都道府県</label>
                    <select name="prefecture" id="prefecture">
                        @foreach($prefectures as $prefecture)
                        <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4">
                    <label for="address" class="text-lg w-full">住所</label>
                    <input type="text" name="address" id="address" value="{{ old('address') }}">
                    <!-- エラー表示 -->
                    <p class="text-red-500" id="address_error"></p>
                </div>
                <button class="w-48 bg-sky-500 h-10 rounded-xl text-white font-black text-xl mt-5" id="change_btn">変更</button>
            </div>
            
            
            <div class="mb-10">
                <h2 class="text-xl font-bold mb-2">支払情報</h2>
                <p class="text-lg">クレジットカード</p>
                <p class="text-lg">カード情報末尾 1234</p>
                <a href="{{ route('enter_card_info') }}" class="no-underline px-6 py-2 bg-sky-500 rounded-xl text-white block font-black text-xl mt-5">カード情報変更</a>
            </div>
            
            <div class="mb-10">
                <h2 class="text-xl font-bold mb-2">クーポン</h2>
                <div class="border-2 border-solid mb-5 p-3 border-stone-950">
                    <input type="radio" name="coupon" value="1" id="1"><label for="1" class="text-lg ml-1">新規登録記念クーポン</label><br>
                </div>
                <div class="border-2 border-solid p-3 border-stone-950">
                    <input type="radio" name="coupon" value="2" id="2"><label for="2" class="text-lg ml-1">500円引きクーポン</labe>
                </div>
            </div>
            <button class="w-48 bg-sky-500 h-10 rounded-xl text-white font-black text-xl mt-5">注文確認</button>
        </div>
    </div>

    <script>
        // クラストグル用の要素
        let user_address = document.querySelector("#showing");
        let change_address = document.querySelector("#hidden_contents");
        let change_address_btn = document.querySelector("#change_address_btn");
        let change_btn = document.querySelector("#change_btn");

        // inputタグ
        let postal_code = document.querySelector("#postal_code");
        let prefecture = document.querySelector("#prefecture");
        let address = document.querySelector("#address");

        // デフォルトの表示
        let default_postal_code = document.querySelector("#default_postal_code");
        let default_prefecture = document.querySelector("#default_prefecture");
        let default_address = document.querySelector("#default_address");
        
        // お届け先変更ボタンを押したときの処理
        change_address_btn.addEventListener('click', function(){
            // user_addressにhiddenクラスを追加し、デフォルトの住所表示を消す
            // お届け先入力フォームを出す
            user_address.classList.toggle("hidden");
            change_address.classList.toggle("hidden");
        });
        
        $(function(){
            // 変更ボタンを押したときの処理
            change_btn.addEventListener('click', function(){
                
                // 入力値の取得
                postal_code_value = postal_code.value;  //入力された郵便番号の取得
                prefecture_num = prefecture.selectedIndex; //入力された都道府県の番号を取得
                prefecture_name = prefecture.options[prefecture_num].innerText; //入力された都道府県の取得
                address_value = address.value;  // 入力された住所の取得
                
                // inputへの入力がある場合
                if(postal_code != null  && address != null){
                    // ajax通信
                    $.ajax({
                        headers: {
                            // POSTのときはトークンの記述がないと"419 (unknown status)"になるので注意
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type:'post',
                        // ルーティングで設定したURL
                        url:'/validate_address', 
                        data: {
                            postal_code: postal_code_value,
                            prefecture: prefecture_name,
                            address: address_value,
                        }
                    }).done(function (results){
                        // 表示の書き換え
                        default_postal_code.textContent = postal_code_value;
                        default_prefecture.textContent = prefecture_name;
                        default_address.textContent = address_value;

                        // user_addressにhiddenクラスを追加し、デフォルトの住所表示を消す
                        // お届け先入力フォームを出す
                        user_address.classList.toggle("hidden");
                        change_address.classList.toggle("hidden");

                    }).fail(function(jqXHR, textStatus, errorThrown){
                        // バリデーションのエラーを出す
                        if (jqXHR.status === 422) {
                            const errors = jqXHR.responseJSON.errors;

                            // 既存エラーをクリア
                            document.getElementById('postal_code_error').textContent = '';
                            document.getElementById('address_error').textContent = '';

                            // エラーがあれば表示
                            if(errors.postal_code){
                                document.getElementById('postal_code_error').textContent = errors.postal_code[0];
                            }

                            if(errors.address){
                                document.getElementById('address_error').textContent = errors.address[0];
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>