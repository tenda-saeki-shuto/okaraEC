<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問い合わせ確認</title>
</head>
<body>
    <h1>お問い合わせ確認</h1>

    <p>以下の内容で送信しますか？</p>

    <div>名前：{{ $contactData['name'] }}</div>
    <div>Email：{{ $contactData['email'] }}</div>
    <div>TEL：{{ $contactData['tel'] }}</div>
    <div>お問い合わせ内容：<br>{{ $contactData['inquiry'] }}</div>

    <!-- 送信フォーム -->
    <form action="{{ route('contact.submit') }}" method="POST">
        @csrf
        <input type="hidden" name="name" value="{{ $contactData['name'] }}">
        <input type="hidden" name="email" value="{{ $contactData['email'] }}">
        <input type="hidden" name="tel" value="{{ $contactData['tel'] }}">
        <input type="hidden" name="inquiry" value="{{ $contactData['inquiry'] }}">
        <button type="submit">入力内容を送信する</button>
    </form>

    <!-- 戻るフォーム（ここにhiddenでデータを追加） -->
    <form action="{{ route('contact.form') }}" method="GET">
        <input type="hidden" name="name" value="{{ $contactData['name'] }}">
        <input type="hidden" name="email" value="{{ $contactData['email'] }}">
        <input type="hidden" name="tel" value="{{ $contactData['tel'] }}">
        <input type="hidden" name="inquiry" value="{{ $contactData['inquiry'] }}">
        <button type="submit">戻る</button>
    </form>
</body>
</html>
