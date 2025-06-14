<!DOCTYPE html>
<html lang="ja">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>おからクイズ！！</title>
</head>
<body>
    <header>
        @include('user.user_header')
    </header>
    <div>今月のクイズ</div>

    {{-- ステータスがあったら回答済みを表示 --}}
    @if($quiz_list->quizStatus->isNotEmpty())
    <div>回答済み</div>
    @endif

    {{-- タイトル --}}
    <div>{{$quiz_list->title}}</div>

    {{-- 問題文 --}}
    <div>{{$quiz_list->content}}</div>


    {{------------- 選択肢 ----------------------------------------------------}}
    {{-- 回答していない場合 ----------------------------------------------------}}
    @if($quiz_list->quizStatus->isEmpty())

        {{-- 選択肢ボタンを設置 --}}
        <form action="{{ route('quiz.answer') }}" method="POST">
            @csrf
            @foreach ($quiz_list->quizSelections as $selection)
                {{-- ループの回数をクラスに入れてます。０～３ --}}
                <button type="submit" name="selection_id" value="{{$selection->id}}" class="{{$loop->index}}">
                    {{$selection->content}}
                </button>
            @endforeach
        </form>

    {{-- 回答していた場合 -----------------------------------------------------}}
    @else
        @foreach ($quiz_list->quizSelections as $selection)
        {{-- ループの回数をクラスに入れてます。０～３ --}}
        <div>
            {{$selection->content}}
        </div>
        @endforeach

        @foreach($quiz_list->quizSelections as $selection)
        @if($selection->is_answer === 1)
            <div class="{{ $loop->index }}">
                正解:<br>
                {{ $selection->content }}
            </div>
        @endif
        @endforeach

    @endif




    {{-- トップ画面に飛ぶリンクを修正してください --}}
    <button onclick="location.href='{{route('items')}}'">トップへ</button>

</body>
</html>
