<!DOCTYPE html>
<html lang="ja">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <title>お問い合わせ確認</title>
    <style>
        td {
            white-space: pre-wrap;
        }
    </style>
</head>

<body class="bg-white font-sans text-gray-800 m-0 p-0">
    @include("user.user_header")

    <div class="max-w-5xl mx-auto mt-8 p-6">
        <h1 class="text-3xl font-semibold text-center border-b-4 border-yellow-700 pb-4 mb-10">お問い合わせ確認</h1>

        <p class="text-center text-gray-700 mb-8 text-lg">以下の内容で送信しますか？</p>

        <!-- ユーザー入力内容（問い合わせ内容）の表示テーブル -->
        <div class="bg-white border border-gray-200 shadow-md rounded-xl p-8 mb-10 max-w-3xl mx-auto">

            <table class="w-full text-xl table-fixed border-separate border-spacing-y-4">
                <tbody>
                    <tr>
                        <th class="w-1/3 text-center font-semibold py-3 px-4 rounded-l-lg">名前</th>
                        <td class="w-1/3 text-left py-3 px-4 rounded-r-lg">{{ $contactData['name'] }}</td>
                    </tr>
                    <tr>
                        <th class="text-center text-gray-700 font-semibold py-3 px-4 rounded-l-lg">Email</th>
                        <td class="text-left text-gray-900 py-3 px-4 rounded-r-lg">{{ $contactData['email'] }}</td>
                    </tr>
                    <tr>
                        <th class="text-center text-gray-700 font-semibold py-3 px-4 rounded-l-lg">TEL</th>
                        <td class="text-left text-gray-900 py-3 px-4 rounded-r-lg">{{ $contactData['tel'] }}</td>
                    </tr>
                    <tr>
                        <th class="text-center text-gray-700 font-semibold py-3 px-4 rounded-l-lg">お問い合わせ内容</th>
                        <td class="text-left text-gray-900 py-3 px-4 rounded-r-lg text-lg">{!! nl2br(e($contactData['inquiry'])) !!}</td>
                    </tr>

                </tbody>
            </table>

            <!-- ボタンエリア -->
            <div class="flex justify-end space-x-6 mt-10">
                <!-- 戻る/入力内容保持 -->
                <form action="{{ route('contact.form') }}" method="GET">
                    <input type="hidden" name="name" value="{{ $contactData['name'] }}">
                    <input type="hidden" name="email" value="{{ $contactData['email'] }}">
                    <input type="hidden" name="tel" value="{{ $contactData['tel'] }}">
                    <input type="hidden" name="inquiry" value="{{ $contactData['inquiry'] }}">
                    <button type="submit"
                            class="bg-white text-yellow-700 border-2 border-yellow-700 rounded-lg py-3 px-8 font-bold hover:bg-yellow-700 hover:text-white transition">
                        戻る
                    </button>
                </form>

                <!-- 送信/入力内容保持 -->
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="name" value="{{ $contactData['name'] }}">
                    <input type="hidden" name="email" value="{{ $contactData['email'] }}">
                    <input type="hidden" name="tel" value="{{ $contactData['tel'] }}">
                    <input type="hidden" name="inquiry" value="{{ $contactData['inquiry'] }}">
                    <button type="submit"
                            class="bg-yellow-700 text-white border-2 border-yellow-700 rounded-lg py-3 px-8 font-bold hover:bg-yellow-800 transition">
                        入力内容を送信する
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
