<!DOCTYPE html>
<html>
  <header>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>レシピ登録</title>
    {{ view('admin.admin_header') }}

    <style>
      .link-button {
        all: unset; /*デフォルトの見た目をリセット*/
        cursor: pointer;
        text-decoration: underline;
        display: inline;
        font-size: 1em;
        font-family: inherit;
        padding: 0;

        font-size: 16px;
      }

      .link-button:hover,
      .link-button:focus {
        color: #004999; /* ホバーで少し色を濃く */
      }

    .link-button:active {
      color: #003366; /* 押下時にさらに濃く */
    }

    .link-button::-moz-focus-inner {
      border: none;
      padding: 0;
    }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type='text/javascript'>
      //テーブルの追加
      $(function() {
      
          $('button#add').click(function(){
        
            var tr_form = '' +
            '<tr>' +
              '<td><input type="text" name="material[]"></td>' +
              '<td><input type="text" name="quantity[]"></td>' +
            '</tr>';
          
            $(tr_form).appendTo($('table > tbody'));
        
        });
      });

      // 手順の追加
      $(function(){
        //手順のカウント（手順1,手順2…）
        let stepCount = <?php echo count($steps) ?>;

        $('button#add-procedure').click(function(){
          stepCount++;

          const block = `
            <div class="procedure-block">
              <label>手順${stepCount}：</label><br>
              <input type="text" name="procedure[]"><br>
              <input type="file" name="sub_img[]"><br><br>
            </div>
          `;

        $('#procedure-container').append(block);
      });
    });
    

    </script>
  </header>
  <body>
    <div class="max-w-7xl max-auto px-6">
      <h1>レシピ更新</h1>
    @if (session('message'))
        <div class="text-red-600 font-bold">
            {{ session('message') }}
        </div>
    @endif
        <form method="post" action="{{ route('recipe.update', $recipe) }}">
            @method('PATCH')
            @csrf
            @include('admin.recipe_form')
            <br>
            <button type="submit">更新</button>
        </form>
    </div>
  </body>
</html>


  