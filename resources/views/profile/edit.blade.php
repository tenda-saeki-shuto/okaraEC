<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <h1 class="text-3xl font-semibold text-center border-b-4 border-yellow-700 pb-4 mb-10">
                登録情報編集
            </h1>

            <div class="bg-white border border-gray-200 shadow-md rounded-xl p-8 mb-10">
                {{-- ここにユーザー情報のテーブルや編集フォーム --}}
                @include('profile.partials.update-profile-information-form')

                {{-- 例: パスワード変更フォームも同様に --}}
                <div class="mt-10">
                    @include('profile.partials.update-password-form')
                </div>

            </div>

            {{-- 必要なら他のリンクやアイコン群 --}}
        </div>
    </div>
</x-app-layout>
