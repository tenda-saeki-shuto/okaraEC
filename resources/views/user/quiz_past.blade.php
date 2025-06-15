<!DOCTYPE html>
<html lang="ja">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{$quiz_list->title}}</title>
</head>
<body>
    <header>
        @include('user.user_header')
    </header>
    <div class="bg-white p-6 rounded-lg shadow-md mt-6 w-full max-w-2xl mx-auto sm:px-4 md:px-6 lg:px-8">
        <h2 class="text-xl font-bold mb-2">{{$quiz_list->title}}</h2>
        <p class="mb-4">{{$quiz_list->content}}</p>

    <form action="{{ route('past.answer') }}" method="POST" class="space-y-4">
        @csrf
        @foreach ($quiz_list->quizSelections as $selection)
        <button type="submit" name="selection_id" value="{{$selection->id}}"
            class="block w-full text-left px-4 py-2 rounded-lg shadow-sm bg-blue-100 hover:bg-blue-200 transition text-base sm:text-lg">
            {{$selection->content}}
        </button>
        @endforeach
    </form>
    </div>
    <button onclick="location.href='{{route('user.quiz')}}'">クイズ一覧へ</button>
</body>
</html>
