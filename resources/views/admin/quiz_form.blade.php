<label for="title">クイズタイトル:</label>
<x-input-error :messages="$errors->get('title')" class="mt-2" />
<input type="text" id="title" name="title" required value="{{ old('title', $quiz->title) }}">
<br><br>
<label for=start_time>開始日時:</label>
<input type="date" id="start_date" name="start" required value="{{ old('start', $quiz->start) }}">
<br><br>
<label for="end_time">終了日時:</label>
<input type="date" id="end_date" name="end" required value="{{ old('end', $quiz->end) }}">
<br><br>
<label for="description">問題文:</label>
<br>
<textarea id="description" name="content" rows="4" cols="100" required>{{ old('content', $quiz->content) }}</textarea>
<br><br>
<label for="image">メイン画像:※１枚</label>
<div id="drop-area">
    <p>ここに画像をドラッグ＆ドロップ</p>
    <input type="file" id="image" name="img" accept="image/*" hidden value="{{ old('img') }}">
    <button type="button" onclick="document.getElementById('image').click()">ファイルを選択</button>
</div>
<div id="preview"></div>
<br><br>

<label for="choices">選択肢:</label>
<br>
@for ($i=0; $i<4; $i++)
    @if ($i==3)
        <label for="answer">正解:</label>
        <input type="text" name="answer" required value="{{ old('answer', $selections[$i]->content ?? '') }}">
    @else
        <input type="text" name="selections[]" required value="{{ old('selections[]', $selections[$i]->content ?? '') }}">    
    @endif
    <br>
@endfor
