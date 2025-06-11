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
    
    <div class="flex flex-col items-center justify-arouind h-screen w-[60%]">    
        <h1 class="text-3xl font-bold mb-5 mt-20">決済情報入力</h1>
        
        <div class="mb-20 w-[60%] items-start flex flex-col">
            <div class="mb-10" id="showing">
                <h2 class="text-xl font-bold mb-2">お届け先</h2>
                <div>
                    <label class="text-lg">郵便番号</label>
                    @foreach($user_info as $info)
                    <p>{{ $info->addresses->postal_code }}</p>
                    @endforeach
                </div>
                <div class="mt-4">
                    <label class="text-lg">都道府県</label>
                    <p>{{ $user_prefecture }}</p>
                </div>
                <div class="mt-4">
                    <label for="address" class="text-lg w-full">住所　　</label>
                    @foreach($user_info as $info)
                    <p>{{ $info->addresses->address }}</p>
                    @endforeach
                </div>
                <button class="py-3 px-8 bg-sky-500 rounded-2xl text-white font-black text-xl mt-5" id="change_address_btn">お届け先変更</button>
            </div>
            
            
            <!-- お届け先変更ボタンが押されたら表示 -->
            <div class="mb-10 hidden" id="hidden_contents">
                <h2 class="text-xl font-bold mb-2">お届け先</h2>
                <div>
                    <label class="text-lg">郵便番号</label>
                    <input type="text" name="postal_code">
                    @error('postal_code')
                    <p class="text-red-500">{{$message}}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="prefecture" class="text-lg">都道府県</label>
                    <select name="prefecture" id="prefecture">
                        @foreach($prefectures as $prefecture)
                        <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
                        @endforeach
                    </select>
                    @error('prefecture')
                    <p class="text-red-500">{{$message}}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="address" class="text-lg w-full">住所　　</label>
                    <input type="text" name="address">
                    @error('address')
                    <p class="text-red-500">{{$message}}</p>
                    @enderror
                </div>
                <button class="py-3 px-8 bg-sky-500 rounded-2xl text-white font-black text-xl mt-5" id="back_btn">変更</button>
            </div>
            
            
            <div class="mb-10">
                <h2 class="text-xl font-bold mb-2">支払情報</h2>
                <p class="text-lg">クレジットカード</p>
                <p class="text-lg">カード情報末尾 1234</p>
                <button class="py-3 px-8 bg-sky-500 rounded-2xl text-white font-black text-xl mt-5"><a href="{{ route('enter_card_info') }}" class="underline no-underline">カード情報変更</a></button>
            </div>
            
            <form action="{{ route('payment_confirm') }}" method="post">
                @csrf
                <div class="mb-10">
                    <h2 class="text-xl font-bold mb-2">クーポン</h2>
                    <div class="border-2 border-solid mb-5 p-3 border-stone-950">
                        <input type="radio" name="coupon" value="1" id="1"><label for="1" class="text-lg ml-1">新規登録記念クーポン</label><br>
                    </div>
                    <div class="border-2 border-solid p-3 border-stone-950">
                        <input type="radio" name="coupon" value="2" id="2"><label for="2" class="text-lg ml-1">500円引きクーポン</labe>
                    </div>
                </div>
                <button class="py-3 px-8 bg-sky-500 rounded-2xl text-white font-black text-xl mt-5">注文確認</button>
            </form>
        </div>
    </div>




    <script>
        let user_address = document.querySelector("#showing");
        let change_address = document.querySelector("#hidden_contents");
        let change_btn = document.querySelector("#change_address_btn");
        let back_btn = document.querySelector("#back_btn");
        
        // お届け先変更ボタンを押したときの処理
        change_btn.addEventListener('click', function(){
            // user_addressにhiddenクラスを追加し、デフォルトの住所表示を消す
            // お届け先入力フォームを出す
            user_address.classList.toggle("hidden");
            change_address.classList.toggle("hidden");
        });

        
        $(function(){
            // 変更ボタンを押したときの処理
            back_btn.addEventListener('click', function(){
                // DBに登録されているお届け先住所を更新する（ordersテーブルのaddress、postal_code、prefectureを更新）
                // コントローラーにユーザーID、郵便番号、都道府県、住所を渡す
            
                const user_id;  //セッションからユーザーIDの取得
                const postal_code = ;  //入力された郵便番号の取得
                const prefecture = ;  //入力された都道府県の取得
                const address = ;  // 入力された住所の取得

                $.ajax({
                    headers: {
                    // POSTのときはトークンの記述がないと"419 (unknown status)"になるので注意
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'post',
                    // ルーティングで設定したURL
                    url:'/change_address/' + id, 
                    dataType: 'json',
                    data: {
                        user_id: user_id,
                        postal_code: postal_code,
                        prefecture: prefecture,
                        address: address,
                    }
                }).done(function (results){
                    // 成功したときのコールバック
                    console.log('OK');
                }).fail(function(jqXHR, textStatus, errorThrown){
                    // 失敗したときのコールバック
                    console.log('fail');
                });


                // user_addressにhiddenクラスを追加し、デフォルトの住所表示を消す
                // お届け先入力フォームを出す
                user_address.classList.toggle("hidden");
                change_address.classList.toggle("hidden");

            });
        });

    </script>
</body>
</html>