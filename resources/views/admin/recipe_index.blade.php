<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>レシピ一覧</title>
</head>

@include('admin.admin_header')

<body>
    <h1>レシピ一覧</h1>
    @if (session('message'))
        <div class="text-red-600 font-bold">
            {{ session('message') }}
        </div>
    @endif
    <a href="{{ route('recipe.create') }}">+新規追加</a>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-20">
                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">レシピ一覧</h1>
            </div>
            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                        <tr>
                            <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                レシピ名</th>
                            <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                説明文</th>
                            <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                画像</th>
                            <th
                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                最終更新
                            </th>
                            <th
                                class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                　　　
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recipes as $recipe)
                            <tr>
                                <td class="border-t-2 border-gray-200 px-4 py-3">{{ $recipe->title }}</td>
                                <td class="border-t-2 border-gray-200 px-4 py-3">{{ $recipe->content }}</td>
                                <td class="border-t-2 border-gray-200 px-4 py-3 text-lg text-gray-900">{{ $recipe->img }}
                                <td class="border-t-2 border-gray-200 w-10 text-center">
                                    {{ $recipe->updated_at }}
                                </td>
                                <td class="border-t-2 border-gray-200 w-10 text-center">
                                    <a href="{{ route('recipe.edit', $recipe) }}">編集</a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="px-4 py-3">Start</td>
                            <td class="px-4 py-3">5 MbMbMbMbMbMbMbMbMbMbMbMbMbMbMbMbMbMbMbMbMbMbMbMbMbMb/s</td>
                            <td class="px-4 py-3">15 GB</td>
                            <td class="px-4 py-3 text-lg text-gray-900">Free</td>
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3">Pro</td>
                            <td class="border-t-2 border-gray-200 px-4 py-3">25 Mb/s</td>
                            <td class="border-t-2 border-gray-200 px-4 py-3">25 GB</td>
                            <td class="border-t-2 border-gray-200 px-4 py-3 text-lg text-gray-900">$24</td>
                            <td class="border-t-2 border-gray-200 w-10 text-center">
                                <input name="plan" type="radio">
                            </td>
                        </tr>
                        <tr>
                            <td class="border-t-2 border-gray-200 px-4 py-3">Business</td>
                            <td class="border-t-2 border-gray-200 px-4 py-3">36 Mb/s</td>
                            <td class="border-t-2 border-gray-200 px-4 py-3">40 GB</td>
                            <td class="border-t-2 border-gray-200 px-4 py-3 text-lg text-gray-900">$50</td>
                            <td class="border-t-2 border-gray-200 w-10 text-center">
                                <input name="plan" type="radio">
                            </td>
                        </tr>
                        <tr>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">Exclusive</td>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">48 Mb/s</td>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">120 GB</td>
                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-lg text-gray-900">$72</td>
                            <td class="border-t-2 border-b-2 border-gray-200 w-10 text-center">
                                <input name="plan" type="radio">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex pl-4 mt-4 lg:w-2/3 w-full mx-auto">
                <a class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0">Learn More
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>
                <button
                    class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Button</button>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4">
        <table class="border-collapse border border-slate-500">
            <thead>
                <tr>
                    <th class="border border-slate-600" scope="col">レシピ名</th>
                    <th class="border border-slate-600" scope="col">説明文</th>
                    <th class="border border-slate-600" scope="col">画像</th>
                    <th class="border border-slate-600" scope="col">最終更新</th>
                    <th class="border border-slate-600" scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recipes as $recipe)
                    <tr>
                        <th scope="row">{{ $recipe->title }}</th>
                        <td class="border border-slate-700">{{ $recipe->content }}</td>
                        <td class=" border border-slate-700">{{ $recipe->img }}</td>
                        <td class="border border-slate-700">{{ $recipe->updated_at }}</td>
                        <td class="border border-slate-700"><a href="{{ route('recipe.edit', $recipe) }}">編集</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>