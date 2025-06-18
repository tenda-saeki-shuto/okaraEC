<!DOCTYPE html>
<html lang="ja">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>問い合わせ一覧</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #ffffff; /* 白背景 */
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin: 40px 0 20px;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        th {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .btn-detail {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 14px;
            text-decoration: none;
        }

        .text-red-600 {
            color: #e3342f;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>

<body>
    <header>
        {{ view('admin.admin_header') }}
    </header>

    <div class="container">
        <h1>問い合わせ一覧</h1>

        @if (session('message'))
            <div class="text-red-600">{{ session('message') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>問い合わせ日</th>                    
                    <th>名前</th>
                    <th>Email</th>
                    <th>TEL</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inquiry_list as $inquiry)
                    <tr>
                        <td>{{ $inquiry->created_at->format('Y/m/d H:i') }}</td>                    
                        <td>{{ $inquiry->name }}</td>
                        <td>{{ $inquiry->Email }}</td>
                        <td>{{ $inquiry->tel }}</td>
                        <td>
                            <a href="{{ route('inquiry.detail', $inquiry) }}" class="btn-detail">詳細</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
