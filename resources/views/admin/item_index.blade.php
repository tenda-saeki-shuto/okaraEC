<!DOCTYPE html>
<html lang="ja">

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品一覧</title>

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

<body class="bg-color-green-600">
    <header>
        {{ view('admin.admin_header') }}
    </header>
    <h1></h1>
    @if (session('message'))
        <div class="text-red-600 font-bold">
            {{ session('message') }}
        </div>
    @endif
    <a href="{{ route('item.create') }}">+新規追加</a>
    <div class="max-w-7xl mx-auto px-6">
        <table border="1">
            <thead>
                <tr>
                    <th scope="col" >商品名</th>                    
                    <th scope="col" >説明</th>
                    <th scope="col">在庫</th>
                    <th scope="col">最終更新日</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($item_list as $item)
                <tr>
                    <th scope="row">{{ $item->name }}</th>                    
                    <td>{{ $item->content }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td><a href="{{ route('item.edit', $item) }}">編集</a></td>
                </tr>
            @endforeach
            <div class="mb-4">
                {{ $item_list->links() }}
            </div>
            </tbody>
        </table>
    </div>
</body>

</html>