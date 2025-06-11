<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>レシピ一覧</title>

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
    <h1>レシピ一覧</h1>
    @if (session('message'))
        <div class="text-red-600 font-bold">
            {{ session('message') }}
        </div>
    @endif
    <a href="{{ route('recipe.create') }}">+新規追加</a>

    <div class="max-w-7xl mx-auto px-6">
        <table>
            <thead>
                <tr>
                    <th scope="col">レシピ名</th>
                    <th scope="col">説明文</th>
                    <th scope="col">画像</th>
                    <th scope="col">最終更新</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($recipes as $recipe)
                <tr>
                    <th scope="row">{{ $recipe->title }}</th>
                    <td>{{ $recipe->content }}</td>
                    <td>{{ $recipe->img }}</td>
                    <td>{{ $recipe->updated_at }}</td>
                    <td><a href="{{ route('recipe.edit', $recipe) }}">編集</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>