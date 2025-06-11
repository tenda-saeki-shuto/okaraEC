<!DOCTYPE html>
<html>
  <header>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>レシピ登録</title>
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
              '<td><input type="text" name="text_1[]"></td>' +
              '<td><input type="text" name="text_2[]"></td>' +
            '</tr>';
          
            $(tr_form).appendTo($('table > tbody'));
        
        });
      });

      // 手順の追加
      $(function(){
        //手順のカウント（手順1,手順2…）
        let stepCount = 1;

        $('button#add-procedure').click(function(){
          stepCount++;

          const block = `
            <div class="procedure-block">
              <label>手順${stepCount}</label><br>
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
      <h1>レシピ登録</h1>
        <form method="post" action="#">
            @csrf 
            <div class = "w-full flex flex-col">
                <br>
                <!-- レシピ名 -->
                <lavel>レシピ名：</lavel><br>
                <input type = "text" name = "title" class = "w-auto py-2 border border-gray-300 rounded-md" id = "title"><br><br>

                <!-- カテゴリ -->
                <div class="section">
                    <label for="category">カテゴリ：</label><br>
                    <select name="category_id" id="category_id">
                        <option value="cookie">おやつ</option>
                        <option value="donuts">お惣菜</option>
                    </select>
                </div>
                <br>
               
                <!-- メイン画像 -->
                <lavel>メイン画像：</lavel><br>
                <input type = "file" name = "img" class = "w-auto py-2 border border-gray-300 rounded-md" id = "img"><br><br>
               
                <!-- 説明 -->
                <lavel>説明：</lavel><br>
                <input type = "textarea" name = "content" class = "w-auto py-2 border border-gray-300 rounded-md" id = "content"><br><br>
               
                <!-- かかる時間 -->
                <lavel>かかる時間：</lavel><br>
                <input type = "text" name = "time" class = "w-auto py-2 border border-gray-300 rounded-md" id = "time"><br><br>
               
                <!-- 量 -->
                <lavel>量：</lavel><br>
                <input type = "text" name = "amount" class = "w-auto py-2 border border-gray-300 rounded-md" id = "amount"><br><br>
               
                <!-- 材料テーブル -->
                <lavel>材料：</lavel><br>
                <table>
                  <thead>
                    <tr>
                      <th>材料</th>
                      <th>数量</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <!-- 材料を格納 -->
                      <td><input type="text" name="name[]"></td>
                      <!-- 数量を格納 -->
                      <td><input type="text" name="amount[]"></td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <td><button id="add" type="button" class="link-button">+追加</button></td>
                  </tfoot>
                </table>
                <br>

                <!-- 手順 -->
                <div id="procedure-container">
                  <div class="procedure-block">
                    <label for="procedure-1">手順1：</label><br>

                    <!-- 手順の説明の格納 -->
                    <input type="text" name="content[]" id="content[]"><br><br>
                    
                    <!-- 画像の格納 -->
                    <input type="file" name="img[]" id="img[]"><br><br>
                  </div>
                </div><br>
                <button id="add-procedure" type="button" class="link-button">+手順を追加</button>
            </div><br>
            <button type="submit">登録</button>
        </form>
    </div>
  </body>
</html>


  