<!DOCTYPE html>
<html lang="ja">

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ユーザ一覧</title>

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
    <div class="max-w-7xl mx-auto px-6">
        <table>
            <thead>
                <tr>
                    <th scope="col" >ID</th>                    
                    <th scope="col" >名前</th>
                    <th scope="col">都道府県</th>
                    <th scope="col">Email</th>
                    <th scope="col">TEL</th>

                </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>                    
                    <td>{{ $user->name }}</td>
                    <td>{{ $prefectureData[$user->id] }}</td>                   
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->updated_at }}</td>
                </tr>
            @endforeach
           
            </tbody>
        </table>
    </div>
</body>

</html>