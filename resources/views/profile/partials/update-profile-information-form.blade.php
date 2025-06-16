{{-- resources/views/profile/edit.blade.php --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8" />
    <title>プロフィール編集</title>
    <style>
        body {
            font-family: sans-serif;
        }
        /* --- ここからポップアップ用のスタイルを追加 --- */
        #updatePopup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color:rgb(141, 219, 177); /* 緑色 */
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
        /* --- ここまでポップアップ用のスタイル --- */
    </style>
</head>
<body class="bg-white font-sans">

    <div class="max-w-5xl mx-auto mt-1 px-6">
        <div class="bg-white rounded-xl p-8 shadow-md">

            {{-- メール認証再送フォーム --}}
            <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('PATCH')

                {{-- 名前 --}}
                <div class="flex flex-col md:flex-row md:items-start gap-2 md:gap-4 text-center">
                    <label for="name" class="md:w-40 pt-2 font-medium text-left md:text-center text-xl">名前</label>
                    <div class="flex-1">
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name ?? '') }}"
                            required autocomplete="name"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2">
                        @error('name')
                            <div class="text-red-500 text-sm mt-1 text-left">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- 郵便番号 --}}
                <div class="flex flex-col md:flex-row md:items-start gap-2 md:gap-4 text-center">
                    <label for="postal_code" class="md:w-40 pt-2 font-medium text-left md:text-center text-xl">郵便番号</label>
                    <div class="flex-1">
                        <input type="text" id="postal_code" name="postal_code"
                            value="{{ old('postal_code', $user->address->postal_code ?? '') }}" required
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2">
                        @error('postal_code')
                            <div class="text-red-500 text-sm mt-1 text-left">{{ $message }}</div>
                        @enderror
                        <p class="text-gray-500 text-sm mt-1 text-left">※ハイフンなしで入力してください</p>
                    </div>
                </div>

                {{-- 都道府県 --}}
                <div class="flex flex-col md:flex-row md:items-start gap-2 md:gap-4 text-center">
                    <label for="prefecture_id" class="md:w-40 pt-2 font-medium text-left md:text-center text-xl">都道府県</label>
                    <div class="flex-1">
                        <select id="prefecture_id" name="prefecture_id"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2" required>
                            <option value="">選択してください</option>
                            @foreach($prefecture as $pref)
                                <option value="{{ $pref->id }}"
                                    {{ old('prefecture_id', $user->address->prefecture_id ?? '') == $pref->id ? 'selected' : '' }}>
                                    {{ $pref->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('prefecture_id')
                            <div class="text-red-500 text-sm mt-1 text-left">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- 住所 --}}
                <div class="flex flex-col md:flex-row md:items-start gap-2 md:gap-4 text-center">
                    <label for="address" class="md:w-40 pt-2 font-medium text-left md:text-center text-xl">住所</label>
                    <div class="flex-1">
                        <input type="text" id="address" name="address"
                            value="{{ old('address', $user->address->address ?? '') }}" required
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2">
                        @error('address')
                            <div class="text-red-500 text-sm mt-1 text-left">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- 電話番号 --}}
                <div class="flex flex-col md:flex-row md:items-start gap-2 md:gap-4 text-center">
                    <label for="tel" class="md:w-40 pt-2 font-medium text-left md:text-center text-xl">電話番号</label>
                    <div class="flex-1">
                        <input type="text" id="tel" name="tel" value="{{ old('tel', $user->tel ?? '') }}" required
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2">
                        @error('tel')
                            <div class="text-red-500 text-sm mt-1 text-left">{{ $message }}</div>
                        @enderror
                        <p class="text-gray-500 text-sm mt-1 text-left">※ハイフンなしで入力してください</p>
                    </div>
                </div>

                {{-- メールアドレス --}}
                <div class="flex flex-col md:flex-row md:items-start gap-2 md:gap-4 text-center">
                    <label for="email" class="md:w-40 pt-2 font-medium text-left md:text-center text-xl">メールアドレス</label>
                    <div class="flex-1">
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2">
                        @error('email')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- メール未確認のとき --}}
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="flex flex-col md:flex-row md:items-start gap-2 md:gap-4 text-center">
                        <div class="md:w-40"></div>
                        <div class="flex-1 text-sm text-gray-800">
                            メールアドレスは未確認です。
                            <button form="send-verification" class="underline text-indigo-600 hover:text-indigo-900 ml-1">
                                確認メールを再送
                            </button>
                        </div>
                    </div>
                    @if(session('status') === 'verification-link-sent')
                        <p class="text-green-600 text-sm mt-1 text-left md:ml-40">
                            確認メールを再送しました。
                        </p>
                    @endif
                @endif

                {{-- 更新ボタンと戻るボタンのラッパー --}}
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

    {{-- --- ここから「更新しました」ポップアップ表示部分の追加 --- --}}
    @if(session('status') === 'profile-updated')
        <div id="updatePopup" class="show">
            更新しました
        </div>
    @else
        <div id="updatePopup"></div>
    @endif
    {{-- --- ここまでポップアップ表示部分 --- --}}

    {{-- --- ここから2秒後にポップアップ非表示にするJavaScriptを追加 --- --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const popup = document.getElementById('updatePopup');
            if (popup.classList.contains('show')) {
                setTimeout(() => {
                    popup.classList.remove('show');
                }, 2000); // 3秒後に非表示
            }
        });
    </script>
    {{-- --- ここまでJavaScript --- --}}

</body>
</html>
