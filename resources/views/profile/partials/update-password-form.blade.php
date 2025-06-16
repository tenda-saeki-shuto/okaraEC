<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8" />
    <title>パスワード変更</title>
    <style>
        body {
            font-family: sans-serif;
        }

        #updatePopup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgb(141, 219, 177); /* 緑色 */
            color: white;
            padding: 16px 32px;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.25);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
            z-index: 1000;
            font-size: 1.2rem;
        }

        #updatePopup.show {
            opacity: 1;
            pointer-events: auto;
        }
    </style>
</head>
<body class="bg-white font-sans">

    <div class="max-w-5xl mx-auto mt-1 px-6">
        <div class="bg-white rounded-xl p-8 shadow-md">

            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- 現在のパスワード --}}
                <div class="flex flex-col md:flex-row md:items-start gap-2 md:gap-4 text-center">
                    <label for="current_password" class="md:w-40 pt-2 font-medium text-left md:text-center text-xl">現在のパスワード</label>
                    <div class="flex-1">
                        <input type="password" id="current_password" name="current_password"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2"
                            autocomplete="current-password">
                        @error('current_password', 'updatePassword')
                            <div class="text-red-500 text-sm mt-1 text-left">{{ $message }}</div>
                        @enderror
                        <p class="text-gray-500 text-sm mt-1 text-left">※7文字以上20文字以下で入力してください</p>
                    </div>
                </div>

                {{-- 新しいパスワード --}}
                <div class="flex flex-col md:flex-row md:items-start gap-2 md:gap-4 text-center">
                    <label for="password" class="md:w-40 pt-2 font-medium text-left md:text-center text-xl">新しいパスワード</label>
                    <div class="flex-1">
                        <input type="password" id="password" name="password"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2"
                            autocomplete="new-password">
                        @error('password', 'updatePassword')
                            <div class="text-red-500 text-sm mt-1 text-left">{{ $message }}</div>
                        @enderror
                        <p class="text-gray-500 text-sm mt-1 text-left">※7文字以上20文字以下で入力してください</p>
                    </div>
                </div>

                {{-- パスワード確認 --}}
                <div class="flex flex-col md:flex-row md:items-start gap-2 md:gap-4 text-center">
                    <label for="password_confirmation" class="md:w-40 pt-2 font-medium text-left md:text-center text-xl">確認用パスワード</label>
                    <div class="flex-1">
                        <p>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2"
                            autocomplete="new-password">
                        @error('password_confirmation' , 'updatePassword')
                            <div class="text-red-500 text-sm mt-1 text-left">{{ $message }}</div>
                        @enderror
                        <p class="text-gray-500 text-sm mt-1 text-left">※7文字以上20文字以下で入力してください</p>
                    </div>
                </div>

                {{-- 更新ボタンと戻るボタン --}}
                <div class="flex gap-4 justify-center pt-4">
                    <button type="submit"
                        class="bg-white text-yellow-700 border-2 border-yellow-700 rounded-lg py-3 px-8 font-bold hover:bg-yellow-700 hover:text-white transition">
                        更新する
                    </button>

                    <a href="{{ route('view.mypage') }}"
                        class="bg-white text-yellow-700 border-2 border-yellow-700 rounded-lg py-3 px-8 font-bold hover:bg-yellow-700 hover:text-white transition">
                        戻る
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- --- ポップアップ表示 --- --}}
    @if (session('status') === 'password-updated')
        <div id="updatePopup" class="show">更新しました</div>
    @else
        <div id="updatePopup"></div>
    @endif

    {{-- --- ポップアップ非表示処理２秒 --- --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const popup = document.getElementById('updatePopup');
            if (popup.classList.contains('show')) {
                setTimeout(() => {
                    popup.classList.remove('show');
                }, 2000);
            }
        });
    </script>

</body>
</html>
