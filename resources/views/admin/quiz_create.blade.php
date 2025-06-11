<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>クイズ作成画面</title>

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
    <h1>クイズ作成画面</h1>
    @if (session('message'))
        <div class="text-red-600 font-bold">
            {{ session('message') }}
        </div>
    @endif
    <form action="{{ route('quiz.store') }}" method="POST">
        @csrf
        <label for="title">クイズタイトル:</label>
        <input type="text" id="title" name="title" required value="{{ old('title') }}">
        <br><br>
        <label for=start_time>開始日時:</label>
        <input type="date" id="start_date" name="start" required value="{{ old('start') }}">
        <br><br>
        <label for="end_time">終了日時:</label>
        <input type="date" id="end_date" name="end" required value="{{ old('end') }}">
        <br><br>
        <label for="description">問題文:</label>
        <br>
        <textarea id="description" name="content" rows="4" cols="100" required>{{ old('content') }}</textarea>
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
        <input type="text" name="selections[]" required value="{{ old('selections[]') }}">
        <br>
        <input type="text" name="selections[]" required value="{{ old('selections[]') }}">
        <br>
        <input type="text" name="selections[]" required value="{{ old('selections[]') }}">
        <br><br>
        <label for="answer">正解:</label>
        <br>
        <input type="text" id="answer" name="content" required value="{{ old('content') }}">
        <br><br>
        <button type="submit">登録</button>
    </form>
</body>













    <script>
    const dropArea = document.getElementById('drop-area');
    const input = document.getElementById('image');
    const preview = document.getElementById('preview');

    // ドラッグイベント
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, e => {
            e.preventDefault();
            dropArea.classList.add('highlight');
        }, false);
    });
    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, e => {
            e.preventDefault();
            dropArea.classList.remove('highlight');
        }, false);
    });

    // ドロップ処理
    dropArea.addEventListener('drop', e => {
        const files = e.dataTransfer.files;
        handleFiles(files);
    });

    // ファイル選択時
    input.addEventListener('change', () => {
        handleFiles(input.files);
    });

    function handleFiles(files) {
        [...files].forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = e => {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'preview-image';

                    const img = document.createElement('img');
                    img.src = e.target.result;

                    const btn = document.createElement('button');
                    btn.textContent = '×';
                    btn.className = 'remove-btn';
                    btn.onclick = () => wrapper.remove();

                    wrapper.appendChild(img);
                    wrapper.appendChild(btn);
                    preview.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            }
        });
    }
    </script>




</html>
