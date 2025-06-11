<div class="w-full flex flex-col">
  <br>
  <!-- レシピ名 -->
  <lavel>レシピ名：</lavel><br>
  <input type="text" name="title" class="w-auto py-2 border border-gray-300 rounded-md" id="recipe_name" value="{{ old('title', $recipe->title) }}"><br><br>
  
  <!-- カテゴリ -->
  <div class="section">
    <label for="category">カテゴリ：</label><br>
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
  <input type="textarea" name="content" class="w-auto py-2 border border-gray-300 rounded-md" id="explanation" value="{{ old('content', $recipe->content) }}"><br><br>

  <!-- メイン画像 -->
  <lavel>メイン画像：</lavel><br>
  <input type="file" name="img" class="w-auto py-2 border border-gray-300 rounded-md" id="main_img" value="{{ old('img', $recipe->img) }}"><br><br>

  <!-- かかる時間 -->
  <lavel>かかる時間：</lavel><br>
  <input type="text" name="time" class="w-auto py-2 border border-gray-300 rounded-md" id="time" value="{{ old('time', $recipe->time) }}"><br><br>

  <!-- 量 -->
  <lavel>量：</lavel><br>
  <input type="text" name="amount" class="w-auto py-2 border border-gray-300 rounded-md" id="amount" value="{{ old('amount', $recipe->amount) }}"><br><br>

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
    @foreach ($ingredients as $ingredient)
      <tr>
        <!-- 材料を格納 -->
        <td><input type="text" name="material[]" value="{{ old('material[]', $ingredient->name) }}"></td>
        <!-- 数量を格納 -->
        <td><input type="text" name="quantity[]" value="{{ old('quantity[]', $ingredient->amount) }}"></td>  
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
    <div class="procedure-block">
    @foreach ($steps as $index => $step)
      <label for="procedure-1">手順{{ $index+1 }}：</label><br>
      <!-- 手順の説明の格納 -->
      <input type="text" name="procedure[]" id="procedure-1" value="{{ old('procedure[]', $step->content) }}"><br><br>

      <!-- 画像の格納 -->
      <input type="file" name="sub_img[]" value="{{ old('sub_img[]', $step->img) }}"><br><br>
    @endforeach
    </div>
  </div><br>
  <button id="add-procedure" type="button" class="link-button">+手順を追加</button>
</div>