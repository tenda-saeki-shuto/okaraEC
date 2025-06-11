<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品詳細</title> {{---ここに商品名を表示したい--}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        @include('user.user_header')
    </header>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">商品詳細</h1>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <img src="{{ asset('images/sample.jpg') }}" alt="商品画像" class="w-full h-64 object-cover rounded-lg mb-4">
            <h2 class="text-2xl font-semibold mb-2">
                おからクッキー
            </h2> {{-- ここに商品名を表示したい --}}
            <p class="text-gray-700 mb-4">
                小麦粉をおからに置き換えることで、カロリーや糖質を抑えたおからクッキー。糖質制限やダイエット中の人に人気です。
            </p> {{-- ここに商品説明を表示したい --}}
            <p class="text-xl font-bold text-red-600 mb-4">
                ¥500
            </p> {{-- ここに価格を表示したい --}}
            <p class="mb-4">栄養素情報</p>
            {{-- ここに栄養素を表示したい --}}
            <ul class="list-disc pl-5 mb-4">
                <li>エネルギー: 200kcal</li>
                <li>タンパク質: 10g</li>
                <li>脂質: 5g</li>
                <li>炭水化物: 30g</li>
                <li>食物繊維: 15g</li>
                <li>食塩相当量: 200mg</li>
            </ul>
            <p class="mb-4">アレルギー情報</p>
            {{-- ここにアレルギー情報を表示したい --}}
            <form action="" method="POST">
                @csrf
                <input type="hidden" name="item_id" value="1"> {{-- 商品IDを設定 --}}
                <div class="flex items-center mb-4 text-right">
                    <label for="quantity" class="mr-2">数量:</label>
                    <select name="quantity" id="quantity" class="border rounded">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>

                <div class="position:right flex justify-end">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors duration-300 mr-5 ml-8 w-30">
                        定期購入
                    </button>
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition-colors duration-300 w-30">
                        カートに追加
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
