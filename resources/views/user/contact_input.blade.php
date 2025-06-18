<!DOCTYPE html>
<html lang="ja">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8" />
    <title>お問い合わせ</title>
    <style>
        body {
            font-family: sans-serif;
        }
    </style>
</head>
<body class="bg-white font-sans text-gray-800 m-0 p-0">

    @include('user.user_header')

    <div class="max-w-5xl mx-auto mt-8 p-6">

        <h1 class="text-3xl font-semibold text-center border-b-4 border-yellow-700 pb-4 mb-10">
            お問い合わせ
        </h1>

        <div class="bg-white rounded-xl p-8 shadow-md">

            @if(session('success'))
                <!-- 送信成功メッセージ表示 -->
                <p class="text-green-600 text-center font-semibold mb-4 ">{{ session('success') }}</p>
            @endif

            <form action="{{ route('contact.confirm') }}" method="POST" class="space-y-6">
                @csrf

                <!-- 名前 -->
                <div class="flex flex-col md:flex-row md:items-start gap-2 md:gap-4 text-center">
                    <label for="name" class="md:w-40 pt-2 font-medium text-left md:text-center text-xl">名前</label>
                    <div class="flex-1">
                        <input type="text" name="name" id="name" value="{{ request('name', old('name')) }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2">
                        @error('name')
                            <!-- バリデーションエラー表示 -->
                            <div class="text-red-500 text-sm mt-1 text-left">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="flex flex-col md:flex-row md:items-start gap-2 md:gap-4 text-center">
                    <label for="email" class="md:w-40 pt-2 font-medium text-left md:text-center text-xl">Email</label>
                    <div class="flex-1">
                        <input type="email" name="email" id="email" value="{{ request('email', old('email')) }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2">
                        @error('email')
                            <!-- バリデーションエラー表示 -->
                            <div class="text-red-500 text-sm mt-1 text-left">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- TEL -->
                <div class="flex flex-col md:flex-row md:items-start gap-2 md:gap-4 text-center">
                    <label for="tel" class="md:w-40 pt-2 font-medium text-left md:text-center text-xl">TEL</label>
                    <div class="flex-1">
                        <input type="text" name="tel" id="tel" value="{{ request('tel', old('tel')) }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2">
                        @error('tel')
                            <!-- バリデーションエラー表示 -->
                            <div class="text-red-500 text-sm mt-1 text-left">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- お問い合わせ内容 -->
                <div class="flex flex-col md:flex-row md:items-start gap-2 md:gap-4 text-center">
                    <label for="inquiry" class="md:w-40 pt-2 font-medium text-left md:text-center text-xl">お問い合わせ内容</label>
                    <div class="flex-1">
                        <textarea name="inquiry" id="inquiry" rows="5"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2">{{ request('inquiry', old('inquiry')) }}</textarea>
                        @error('inquiry')
                            <!-- バリデーションエラー表示 -->
                            <div class="text-red-500 text-sm mt-1 text-left">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- 送信ボタン -->
                <div class="text-center">
                    <button type="submit"
                        class="bg-yellow-700 text-white rounded-lg py-3 px-8 font-bold hover:bg-yellow-800 transition">
                        入力内容を確認する
                    </button>
                </div>

            </form>
        </div>
    </div>

</body>
</html>
