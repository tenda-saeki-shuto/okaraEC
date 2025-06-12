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
        '<tr class="ingredient-div">' +
          '<input type="hidden" name="ingredient_id[]" value=""></td>' +
          '<td><input type="text" name="material[]" value=""></td>' +
          '<td><input type="text" name="quantity[]" value=""></td>' +
          '<td><button type="button" class="delete">削除</td>' +
        '</tr>';
      
        $(tr_form).appendTo($('table > tbody'));
    });
  
    $('#ingredients-form').on('click', 'button.delete', function(){
      $(this).closest('.ingredient-div').remove();
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
          <input type="hidden" name="step_id[]" value="">
          <input type="text" name="procedure[]" value=""><br>
          <input type="file" name="sub_img[]" value=""><br>
          <button type="button" class="delete">削除</>
          <br>
        </div>
      `;
      $('#procedure-container').append(block);
    });
    
    $('#procedure-container').on('click', 'button.delete', function(){
      $(this).closest('.procedure-block').remove();
    });
});

</script>

<div class="w-full flex flex-col">
  <br>
  <!-- レシピ名 -->
  <lavel>レシピ名：</lavel><br>
  <x-input-error :messages="$errors->get('title')" class="mt-2" />
  <input type="text" name="title" class="w-auto py-2 border border-gray-300 rounded-md" id="recipe_name" value="{{ old('title', $recipe->title) }}"><br><br>
  
  <!-- カテゴリ -->
  <div class="section">
    <label for="category">カテゴリ：</label><br>
    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
    <select name="category_id" id="category_id">
      @foreach ($categories as $category)
        @if ($recipe->category_id === $category->id)
          <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
        @else
          <option value="{{ $category->id }}">{{ $category->name }}</option>  
        @endif
      @endforeach
    </select>
  </div>
  <br>

  <!-- 説明 -->
  <lavel>説明：</lavel><br>
  <x-input-error :messages="$errors->get('content')" class="mt-2" />
  <input type="textarea" name="content" class="w-auto py-2 border border-gray-300 rounded-md" id="explanation" value="{{ old('content', $recipe->content) }}"><br><br>

  <!-- メイン画像 -->
  <lavel>メイン画像：</lavel><br>
  <x-input-error :messages="$errors->get('img')" class="mt-2" />
  <input type="file" name="img" class="w-auto py-2 border border-gray-300 rounded-md" id="main_img" value="{{ old('img', $recipe->img) }}"><br><br>

  <!-- かかる時間 -->
  <lavel>かかる時間：</lavel><br>
  <x-input-error :messages="$errors->get('time')" class="mt-2" />
  <input type="text" name="time" class="w-auto py-2 border border-gray-300 rounded-md" id="time" value="{{ old('time', $recipe->time) }}"><br><br>

  <!-- 量 -->
  <lavel>量：</lavel><br>
  <x-input-error :messages="$errors->get('amount')" class="mt-2" />
  <input type="text" name="amount" class="w-auto py-2 border border-gray-300 rounded-md" id="amount" value="{{ old('amount', $recipe->amount) }}"><br><br>

  <!-- 栄養素 -->
  <lavel>カロリー (kcal、整数のみ)：</lavel><br>
  <x-input-error :messages="$errors->get('energy')" class="mt-2" />
  <input type="text" name="energy" class="w-auto py-2 border border-gray-300 rounded-md" id="explanation" value="{{ old('content', $recipe->content) }}"><br>
  <lavel>タンパク質 (g)：</lavel><br>
  <x-input-error :messages="$errors->get('protein')" class="mt-2" />
  <input type="text" name="protein" class="w-auto py-2 border border-gray-300 rounded-md" id="explanation" value="{{ old('content', $recipe->content) }}"><br>
  <lavel>脂質 (g)：</lavel><br>
  <x-input-error :messages="$errors->get('fat')" class="mt-2" />
  <input type="text" name="fat" class="w-auto py-2 border border-gray-300 rounded-md" id="explanation" value="{{ old('content', $recipe->content) }}"><br>
  <lavel>炭水化物 (g)：</lavel><br>
  <x-input-error :messages="$errors->get('carb')" class="mt-2" />
  <input type="text" name="carb" class="w-auto py-2 border border-gray-300 rounded-md" id="explanation" value="{{ old('content', $recipe->content) }}"><br>
  <lavel>食物繊維 (g)：</lavel><br>
  <x-input-error :messages="$errors->get('fiber')" class="mt-2" />
  <input type="text" name="fiber" class="w-auto py-2 border border-gray-300 rounded-md" id="explanation" value="{{ old('content', $recipe->content) }}"><br>
  <lavel>食塩含有量 (g)：</lavel><br>
  <x-input-error :messages="$errors->get('salt_eqv')" class="mt-2" />
  <input type="text" name="salt_eqv" class="w-auto py-2 border border-gray-300 rounded-md" id="explanation" value="{{ old('content', $recipe->content) }}"><br>
  <br>

  <!-- 材料テーブル -->
  <lavel>材料：</lavel><br>
  <table>
    <thead>
      <tr>
        <th>材料</th>
        <th>数量</th>
      </tr>
    </thead>
    <tbody id="ingredients-form">
    @foreach ($ingredients as $index => $ingredient)
      <tr class="ingredient-div">
        <input type="hidden" name="ingredient_id[]" value="{{ $ingredient->id }}"></td>
        <!-- 材料を格納 -->
        <td>
          <x-input-error :messages="$errors->get('material[]')" class="mt-2" />
          <input type="text" name="material[]" value="{{ old("material.$index", $ingredient->name) }}"></td>
        <!-- 数量を格納 -->
        <td>
          <x-input-error :messages="$errors->get('quantity[]')" class="mt-2" />
          <input type="text" name="quantity[]" value="{{ old("quantity.$index", $ingredient->amount) }}"></td>  
        <td><button type="button" class="delete">削除</td>
      </tr>
    @endforeach
    </tbody>
    <tfoot>
      <td><button id="add" type="button" class="link-button">+追加</button></td>
    </tfoot>
  </table>
  <br>
  <!-- 手順 -->
  <div id="procedure-container">
  @foreach ($steps as $index => $step)
    <div class="procedure-block">
      <label for="procedure-1">手順{{ $index+1 }}：</label><br>
      <input type="hidden" name="step_id[]" value="{{ $step->id }}">  
      <!-- 手順の説明の格納 -->
      <x-input-error :messages="$errors->get('procedure[]')" class="mt-2" />
      <input type="text" name="procedure[]" id="procedure-1" value="{{ old("procedure.$index", $step->content) }}"><br><br>

      <!-- 画像の格納 -->
      <x-input-error :messages="$errors->get('sub_img[]')" class="mt-2" />
      <input type="file" name="sub_img[]" value="{{ old("sub_img.$index", $step->img) }}"><br>
      <button type="button" class="delete">削除</>
      <br>
    </div>
  @endforeach
  </div><br>
  <button id="add-procedure" type="button" class="link-button">+手順を追加</button>
</div>