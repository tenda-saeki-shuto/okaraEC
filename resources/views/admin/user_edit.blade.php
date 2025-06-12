<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ユーザー情報編集</title>

    <style>
        #drop-area {
            border: 2px dashed #ccc;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            color: #999;
            margin-bottom: 20px;
        }
        #drop-area.highlight {
            border-color: #6c6;
        }
        .preview-image {
            position: relative;
            display: inline-block;
            margin: 10px;
        }
        .preview-image img {
            max-width: 200px;
            display: block;
        }
        .remove-btn {
            position: absolute;
            top: 0;
            right: 0;
            background: red;
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            cursor: pointer;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        {{ view('admin.admin_header') }}
    </header>
    <h1>ユーザー情報編集</h1>
    @if (session('message'))
        <div class="text-red-600 font-bold">
            {{ session('message') }}
        </div>
    @endif
    <form action="{{ route('user.update', $user) }}" method="POST">
        @method('PATCH')
        @csrf
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div><br>

        <!-- 郵便番号 -->
        <div>
            <x-input-label for="postal_code" :value="__('postal_code')" />
            <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" :value="old('postal_code')" required autofocus autocomplete="postal_code" />
            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
            <p>※ハイフンなしで入力してください</p>
        </div>

        <br>

        <!-- 都道府県 -->
        <div>
        <label for="prefecture_id">prefecture</label><br>
        <select name="prefecture_id" id="prefecture_id" required>
            <option value="">選択してください</option>
            @foreach($prefecture as $pref)
            <option value="{{ $pref->id }}"
                {{ old('prefecture_id') == $pref->id ? 'selected' : '' }}>
                {{ $pref->name }}
            </option>
            @endforeach
        </select>
        @error('prefecture_id')
            <span class="text-red-600">{{ $message }}</span>
        @enderror
        </div><br>

        <!-- 住所 -->
        <div>
            <x-input-label for="address" :value="__('address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div><br>

        <!-- 電話番号 -->
        <div>
            <x-input-label for="tel" :value="__('tel')" />
            <x-text-input id="tel" class="block mt-1 w-full" type="text" name="tel" :value="old('tel')" required autofocus autocomplete="tel" />
            <x-input-error :messages="$errors->get('tel')" class="mt-2" />
            <p>※ハイフンなしで入力してください</p>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <p>※パスワードは8文字から20文字で入力してください
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Update') }}
            </x-primary-button>
        </div>
    </form>
</body>













    <script>
    const dropArea = document.getElementById('drop-area');
    const input = document.getElementById('image');
    const preview = document.getElementById('preview');

    // ドラッグイベント
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, e => {
            e.preventDefault();
            dropArea.classList.add('highlight');
        }, false);
    });
    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, e => {
            e.preventDefault();
            dropArea.classList.remove('highlight');
        }, false);
    });

    // ドロップ処理
    dropArea.addEventListener('drop', e => {
        const files = e.dataTransfer.files;
        handleFiles(files);
    });

    // ファイル選択時
    input.addEventListener('change', () => {
        handleFiles(input.files);
    });

    function handleFiles(files) {
        [...files].forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = e => {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'preview-image';

                    const img = document.createElement('img');
                    img.src = e.target.result;

                    const btn = document.createElement('button');
                    btn.textContent = '×';
                    btn.className = 'remove-btn';
                    btn.onclick = () => wrapper.remove();

                    wrapper.appendChild(img);
                    wrapper.appendChild(btn);
                    preview.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            }
        });
    }
    </script>




</html>
