<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>ユーザー情報編集</title>
</head>

@include('admin.admin_header')

<body>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col px-6 w-full">
                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">
                    ユーザー情報編集
                </h1>
                @if (session('message'))
                    <div class="text-red-600 font-bold">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            <form action="{{ route('user.update', $user) }}" method="POST">
                @method('PATCH')
                @csrf
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div><br>

                <!-- 郵便番号 -->
                <div>
                    <x-input-label for="postal_code" :value="__('postal_code')" />
                    <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code"
                        :value="old('postal_code')" required autofocus autocomplete="postal_code" />
                    <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                    <p>※ハイフンなしで入力してください</p>
                </div>

                <br>

                <!-- 都道府県 -->
                <div>
                    <x-input-label for="prefecture_id" :value="__('prefecture')" />
                    <select name="prefecture_id" id="prefecture_id" class="block mt-1 w-full" required>
                        <option value="">選択してください</option>
                        @foreach($prefecture as $pref)
                            <option value="{{ $pref->id }}" {{ old('prefecture_id') == $pref->id ? 'selected' : '' }}>
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
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                        :value="old('address')" required autofocus autocomplete="address" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div><br>

                <!-- 電話番号 -->
                <div>
                    <x-input-label for="tel" :value="__('tel')" />
                    <x-text-input id="tel" class="block mt-1 w-full" type="text" name="tel" :value="old('tel')" required
                        autofocus autocomplete="tel" />
                    <x-input-error :messages="$errors->get('tel')" class="mt-2" />
                    <p>※ハイフンなしで入力してください</p>
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    <p>※パスワードは8文字から20文字で入力してください
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-4">
                        {{ __('Update') }}
                    </x-primary-button>
                </div>
        </div>
    </section>
</body>

</html>