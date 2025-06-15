<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問い合わせ確認</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 40px;
            text-align: center;
        }

        h1 {
            margin-bottom: 40px;
            font-size: 28px;
        }

        .inquiry-box {
            display: inline-block;
            text-align: left;
            background-color: #f4f4f4;
            padding: 40px 60px;
            border-radius: 20px;
            min-width: 600px;
            font-size: 18px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .inquiry-item {
            margin-bottom: 25px;
            white-space: nowrap;
        }

        .inquiry-label {
            font-weight: bold;
            display: inline-block;
            width: 180px;
            vertical-align: top;
        }

        .inquiry-value {
            display: inline-block;
            max-width: 380px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .submit-button {
            margin-top: 40px;
            background-color: #aee0f9;
            color: black;
            padding: 14px 40px;
            border: none;
            border-radius: 25px;
            font-size: 18px;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #6cc9f0;
        }
    </style>
</head>

<body>
    <h1>お問い合わせ内容確認</h1>

    <div class="inquiry-box">
        <div class="inquiry-item">
            <span class="inquiry-label">問い合わせ日：</span>
            <span class="inquiry-value">{{ $inquiry->created_at }}</span>
        </div>
        <div class="inquiry-item">
            <span class="inquiry-label">名前：</span>
            <span class="inquiry-value">{{ $inquiry->name }}</span>
        </div>
        <div class="inquiry-item">
            <span class="inquiry-label">Email：</span>
            <span class="inquiry-value">{{ $inquiry->Email }}</span>
        </div>
        <div class="inquiry-item">
            <span class="inquiry-label">TEL：</span>
            <span class="inquiry-value">{{ $inquiry->tel }}</span>
        </div>
        <div class="inquiry-item">
            <span class="inquiry-label">お問い合わせ内容：</span>
            <span class="inquiry-value">{{ $inquiry->inquiry }}</span>
        </div>
    </div>

    <!-- 戻るボタンをボックスの外に配置 -->
    <form action="{{ route('inquiry') }}" method="GET">
        @csrf
        <button type="submit" class="submit-button">戻る</button>
    </form>
</body>
</html>
