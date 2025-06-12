<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問い合わせ</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 40px;
        }

        h1 {
            text-align: center;
        }

        .form-row {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .form-label {
            width: 120px;
            padding-top: 10px;
        }

        .form-field {
            flex: 1;
        }

        input, textarea {
            width: 100%;
            padding: 6px;
            font-size: 14px;
            border: 1px solid #aaa;
        }

        .error {
            color: red;
            font-size: 12px;
            margin-top: 4px;
        }

        .submit-button {
            display: block;
            margin: 30px auto;
            background-color: #4FC3F7;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #039BE5;
        }
    </style>
</head>
<body>
    <h1>お問い合わせ</h1>

    @if(session('success'))
        <p style="color: green; text-align: center;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('contact.confirm') }}" method="POST">
    @csrf

    <div class="form-row">
        <div class="form-label">名前</div>
        <div class="form-field">
            <input type="text" name="name" value="{{ request('name', old('name')) }}">
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-label">Email</div>
        <div class="form-field">
            <input type="email" name="email" value="{{ request('email', old('email')) }}">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-label">TEL</div>
        <div class="form-field">
            <input type="text" name="tel" value="{{ request('tel', old('tel')) }}">
            @error('tel')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-label">お問い合わせ内容</div>
        <div class="form-field">
            <textarea name="inquiry" rows="5">{{ request('inquiry', old('inquiry')) }}</textarea>
            @error('inquiry')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <button type="submit" class="submit-button">入力内容を確認する</button>
</form>
