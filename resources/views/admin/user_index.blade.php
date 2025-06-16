<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>ユーザー一覧</title>
</head>

@include('admin.admin_header')

<body>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-20">
                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">ユーザー一覧</h1>
                @if (session('message'))
                    <div class="text-red-600 font-bold">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            <div class="lg:w-5/6 w-full mx-auto overflow-auto">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                        <tr>
                            <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                ID</th>
                            <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                名前</th>
                            <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Email</th>
                            <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                TEL</th>
                            <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                最終更新</th>
                            <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                退会</th>
                            <th
                                class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                　　　</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="border-t-2 border-gray-200 px-4 py-3">{{ $user->id }}</td>
                                <td class="border-t-2 border-gray-200 px-4 py-3">{{ $user->name }}</td>
                                <td class="border-t-2 border-gray-200 px-4 py-3">{{ $user->email }}
                                <td class="border-t-2 border-gray-200 px-4 py-3">{{ $user->tel }}
                                <td class="border-t-2 border-gray-200 px-4 py-3">{{ $user->updated_at }}
                                <td class="border-t-2 border-gray-200 px-4 py-3">{{ $user->deleted_at }}
                                <td class="border-t-2 border-gray-200 w-10 text-center">
                                    <a href="{{ route('user.edit', $user) }}">編集</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
</body>

</html>