<!DOCTYPE html>
<html lang="ja">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>おからクイズ！！</title>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col items-center">

    <!-- ヘッダー -->
    <header class="w-full">
        @include('user.user_header')
    </header>

    <!-- クイズタイトル -->
    <div class="bg-yellow-300 text-center text-2xl font-bold py-4 w-full">今月のクイズ</div>

    <!-- 回答済み表示 -->
    @if($quiz_list->quizStatus->isNotEmpty())
    <div class="text-center text-green-600 font-semibold mt-4">回答済み</div>
    @endif

    <!-- クイズ内容 -->
    <div class="bg-white p-6 rounded-lg shadow-md mt-6 w-full max-w-2xl mx-auto sm:px-4 md:px-6 lg:px-8">
        <h2 class="text-xl font-bold mb-2">{{$quiz_list->title}}</h2>
        <p class="mb-4">{{$quiz_list->content}}</p>

        {{-- 回答していない場合 --}}
        @if($quiz_list->quizStatus->isEmpty())
        <form action="{{ route('quiz.answer') }}" method="POST" class="space-y-4">
            @csrf
            @foreach ($quiz_list->quizSelections as $selection)
            <button type="submit" name="selection_id" value="{{$selection->id}}"
                class="block w-full text-left px-4 py-2 rounded-lg shadow-sm bg-blue-100 hover:bg-blue-200 transition text-base sm:text-lg">
                {{$selection->content}}
            </button>
            @endforeach
        </form>

        {{-- 回答していた場合 --}}
        @else
        <div class="space-y-2">
            @foreach ($quiz_list->quizSelections as $selection)
            <div class="px-4 py-2 bg-gray-100 rounded text-sm sm:text-base">{{$selection->content}}</div>
            @endforeach

            @foreach($quiz_list->quizSelections as $selection)
            @if($selection->is_answer === 1)
            <div class="mt-4 p-4 bg-green-200 border-l-4 border-green-500 rounded text-sm sm:text-base">
                <strong>正解:</strong><br>
                {{ $selection->content }}
            </div>
            @endif
            @endforeach
        </div>
        @endif
    </div>

    <!-- トップへボタン -->
    <div class="mt-6">
        <button onclick="location.href='{{route('items')}}'"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded text-sm sm:text-base">
            トップへ
        </button>
    </div>

</body>
</html>
