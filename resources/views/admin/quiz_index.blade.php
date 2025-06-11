<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>クイズ一覧</title>

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
    <h1>クイズ一覧</h1>
    @if (session('message'))
        <div class="text-red-600 font-bold">
            {{ session('message') }}
        </div>
    @endif
    <a href="{{ route('quiz.create') }}">+新規追加</a>

    <div class="max-w-7xl mx-auto px-6">
        <table>
            <thead>
                <tr>
                    <th scope="col">タイトル</th>
                    <th scope="col">問題文</th>
                    <th scope="col">画像</th>
                    <th scope="col">開始日</th>
                    <th scope="col">終了日</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($quizzes as $quiz)
                <tr>
                    <th scope="row">{{ $quiz->title }}</th>
                    <td>{{ $quiz->content }}</td>
                    <td>{{ $quiz->img }}</td>
                    <td>{{ $quiz->start }}</td>
                    <td>{{ $quiz->end }}</td>
                    <td><a href="{{ route('quiz.edit', $quiz) }}">編集</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>