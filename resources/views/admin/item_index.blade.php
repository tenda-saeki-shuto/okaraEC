<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>商品一覧</title>
</head>

@include('admin.admin_header')

<body>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-20">
                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">商品一覧</h1>
                @if (session('message'))
                    <div class="text-red-600 font-bold">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="flex pl-4 mt-4 lg:w-2/3 w-full mx-auto">
                    <a class="flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded"
                        href="{{ route('item.create') }}">
                        +新規追加</a>
                </div>
            </div>
            <div class="lg:w-5/6 w-full mx-auto overflow-auto">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                        <tr>
                            <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                商品名</th>
                            <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                説明文</th>
                            <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                在庫</th>
                            <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                画像</th>
                            <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                最終更新</th>
                            <th
                                class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                　　　</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item_list as $item)
                            <tr>
                                <td class="border-t-2 border-gray-200 px-4 py-3">{{ $item->name }}</td>
                                <td class="border-t-2 border-gray-200 px-4 py-3">{{ $item->content }}</td>
                                <td class="border-t-2 border-gray-200 px-4 py-3">{{ $item->stock }}
                                <td class="border-t-2 border-gray-200 px-4 py-3">{{ $item->img }}
                                <td class="border-t-2 border-gray-200 w-10 text-center">
                                    {{ $item->updated_at }}
                                </td>
                                <td class="border-t-2 border-gray-200 w-10 text-center">
                                    <a href="{{ route('item.edit', $item) }}">編集</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>

</html>