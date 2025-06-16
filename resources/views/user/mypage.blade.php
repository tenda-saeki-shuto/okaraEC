<!doctype html>
<html>
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white font-sans text-gray-800 m-0 p-0">
    @include("user.user_header")

    <div class="max-w-5xl mx-auto mt-8 p-6">
        <h1 class="text-3xl font-semibold text-center border-b-4 border-yellow-700 pb-4 mb-10">登録情報</h1>

        <!-- 修正：ユーザー情報部分をテーブルに変更 -->
        <div class="bg-white border border-gray-200 shadow-md rounded-xl p-8 mb-10">
            <table class="w-full text-xl table-fixed border-separate border-spacing-y-4">
                <tbody>
                    <tr>
                        <th class="w-1/3 text-center text-gray-700 font-semibold bg-gray-50 py-3 px-4 rounded-l-lg">名前</th>
                        <td class="w-1/3 text-left text-gray-900 bg-gray-100 py-3 px-4 rounded-r-lg">{{$user->name}}</td>
                    </tr>
                    <tr>
                        <th class="text-center text-gray-700 font-semibold bg-gray-50 py-3 px-4 rounded-l-lg">郵便番号</th>
                        <td class="text-left text-gray-900 bg-gray-100 py-3 px-4 rounded-r-lg">{{$user->address->postal_code ?? '未登録'}}</td>
                    </tr>
                    <tr>
                        <th class="text-center text-gray-700 font-semibold bg-gray-50 py-3 px-4 rounded-l-lg">都道府県</th>
                        <td class="text-left text-gray-900 bg-gray-100 py-3 px-4 rounded-r-lg">{{$user->address->prefecture->name ?? '未登録'}}</td>
                    </tr>
                    <tr>
                        <th class="text-center text-gray-700 font-semibold bg-gray-50 py-3 px-4 rounded-l-lg">住所</th>
                        <td class="text-left text-gray-900 bg-gray-100 py-3 px-4 rounded-r-lg">{{$user->address->address ?? '未登録'}}</td>
                    </tr>
                    <tr>
                        <th class="text-center text-gray-700 font-semibold bg-gray-50 py-3 px-4 rounded-l-lg">Email</th>
                        <td class="text-left text-gray-900 bg-gray-100 py-3 px-4 rounded-r-lg">{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th class="text-center text-gray-700 font-semibold bg-gray-50 py-3 px-4 rounded-l-lg">TEL</th>
                        <td class="text-left text-gray-900 bg-gray-100 py-3 px-4 rounded-r-lg">{{ $user->tel }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- 修正：ユーザー情報変更ボタンを維持 -->
            <div class="flex justify-end mt-10">
                <form action="">
                    <button type="submit"
                            class="bg-white text-yellow-700 border-2 border-yellow-700 rounded-lg py-3 px-8 font-bold hover:bg-yellow-700 hover:text-white transition">
                        ユーザー情報変更
                    </button>
                </form>
            </div>
        </div>

        <!-- アイコン群 -->
        <div class="flex flex-wrap justify-center gap-12 px-6 mb-10">
            <form action="#">
                <div class="flex flex-col items-center w-36 text-center cursor-pointer hover:-translate-y-1 hover:shadow-lg transition">
                    <img src="{{ asset('img/like.png') }}" alt="お気に入り" class="w-24 h-24 object-contain" />
                    <p class="mt-2 text-lg text-black">お気に入り</p>
                </div>
            </form>

            <form action="#">
                <div class="flex flex-col items-center w-36 text-center cursor-pointer hover:-translate-y-1 hover:shadow-lg transition">
                    <img src="{{ asset('img/buy.png') }}" alt="定期購入一覧" class="w-24 h-24 object-contain" />
                    <p class="mt-2 text-lg text-black">定期購入一覧</p>
                </div>
            </form>

            <form action="#">
                <div class="flex flex-col items-center w-36 text-center cursor-pointer hover:-translate-y-1 hover:shadow-lg transition">
                    <img src="{{ asset('img/coupon.png') }}" alt="クーポン" class="w-24 h-24 object-contain" />
                    <p class="mt-2 text-lg text-black">クーポン</p>
                </div>
            </form>

            <form action="#">
                <div class="flex flex-col items-center w-36 text-center cursor-pointer hover:-translate-y-1 hover:shadow-lg transition">
                    <img src="{{ asset('img/history.png') }}" alt="購入履歴" class="w-24 h-24 object-contain" />
                    <p class="mt-2 text-lg text-black">購入履歴</p>
                </div>
            </form>
        </div>

        <!-- 修正：退会ボタンをやや下に配置し、右寄せで固定 -->
        <div class="flex justify-end mt-40 mr-8">
            <form action="">
                <button type="submit"
                        class="bg-white text-red-700 border-2 border-red-700 rounded-lg py-3 px-8 font-bold hover:bg-red-700 hover:text-white transition w-48">
                        退会
                </button>
            </form>
        </div>
    </div>
</body>
