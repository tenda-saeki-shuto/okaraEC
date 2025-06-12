<style>
    .container{
        display: flex;
        flex-direction: column;
        max-width: 100%;
        height: 100%;
        /* background-color: skyblue; */
    }
    .price{
        max-width: 100px;
    }
    .section{
        margin:30px 20px;
    }
    .add_img{
        width: fit-content;
        border-bottom: 1px solid black;
    }
    button{
        display: block;
        margin: 0 auto;
    }
</style>

<!-- 商品名 -->
<div class="section">
    <label for="name">商品名：</label><br>
    <input type="text" id="name" name="name" value="{{ old('name', $item->name) }}">
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<!-- カテゴリ -->
<div class="section">
    <label for="category">カテゴリ：</label><br>
    <select name="category_id" id="category_id">
    @foreach ($categories as $category)
        @if ($item->category_id === $category->id)
        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
        @else
        <option value="{{ $category->id }}">{{ $category->name }}</option>  
        @endif
    @endforeach
    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
    </select>
</div>

<!-- メイン画像 -->
<div class="section">
    <label for="main_img">メイン画像(１つだけ)：</label><br>
    <input type="file" name="img" accept="image/*"  value="{{ old('img', $item->img) }}"> 
    <x-input-error :messages="$errors->get('img')" class="mt-2" />
</div>

<!-- サブ画像 -->
<div class="section">
    <label for="sub_img">サブ画像(複数選択可)：</label><br>
    <input type="file" name="sub_imgs[]" accept="image/*" multiple>
    <x-input-error :messages="$errors->get('sub_imgs')" class="mt-2" />
</div>

<!-- 商品説明 -->
<div class="section">
    <label for="item_discription">商品説明：</label><br>
    <textarea name="content" id="item_discription" rows="10" cols="50">{{ old('content', $item->content) }}</textarea>
    <x-input-error :messages="$errors->get('content')" class="mt-2" />
</div>

<!-- 配送オプション -->
<div class="section">
    <label>配送オプション：</label><br>
    <input type="radio" name="is_cold" value="refrigerated">冷蔵
    <input type="radio" name="is_cold" value="frozen">冷凍
    <input type="radio" name="is_cold" value="" checked>なし
    <x-input-error :messages="$errors->get('is_cold')" class="mt-2" />
</div>

<!-- 価格 -->
<div class="section">
    <label for="price">価格：</label><br>
    <input type="text" class="price" name="price" value="{{ old('price', $item->price) }}">円
    <x-input-error :messages="$errors->get('price')" class="mt-2" />
</div>
<!-- 在庫数 -->
<div class="section">
    <label for="stock">在庫数：</label><br>
    <input type="text" class="stock" name="stock" value="{{ old('stock', $item->stock) }}">個
    <x-input-error :messages="$errors->get('stock')" class="mt-2" />
</div>


<!-- 栄養情報 -->
<div class="section">
    <label>栄養情報：</label>
    <div class="nutrition">
        <label for="calorie">カロリー：　</label>
        <input type="text" id="calorie" name="energy" value="{{ old('energy', $item_nutrition_facts->energy ?? '') }}">kcal
        <x-input-error :messages="$errors->get('energy')" class="mt-2" />
    </div>

    <div class="nutrition">
        <label for="protein">タンパク質：</label>
        <input type="text" id="protein" name="protein" value="{{ old('protein', $item_nutrition_facts->energy ?? '') }}">g
        <x-input-error :messages="$errors->get('protein')" class="mt-2" />
    </div>

    <div class="nutrition">
        <label for="fat">脂質：　　　</label>
        <input type="text" id="fat" name="fat" value="{{ old('fat', $item_nutrition_facts->fat ?? '') }}">g
        <x-input-error :messages="$errors->get('fat')" class="mt-2" />
    </div>
    
    <div class="nutrition">
        <label for="carbohydrates">炭水化物：　</label>
        <input type="text" id="carbohydrates" name="carb" value="{{ old('carb', $item_nutrition_facts->carb ?? '') }}">g
        <x-input-error :messages="$errors->get('carb')" class="mt-2" />
    </div>

    <div class="nutrition">
        <label for="fiber">食物繊維：　</label>
        <input type="text" id="fiber" name="fiber" value="{{ old('fiber', $item_nutrition_facts->fiber ?? '') }}">g
        <x-input-error :messages="$errors->get('fiber')" class="mt-2" />
    </div>

    <div class="nutrition">
        <label for="salt">食塩相当量：</label>
        <input type="text" id="salt" name="salt_eqv" value="{{ old('salt_eqv', $item_nutrition_facts->salt_eqv ?? '') }}">g
        <x-input-error :messages="$errors->get('salt_eqv')" class="mt-2" />
    </div>
</div>

<!-- アレルギー -->
<div class="section">
    <label>アレルギー：</label>
    <div>
        @foreach ($allergy_list as $allergy_item)
            @if (in_array($allergy_item->id, $item_allergies))
                <label style="display: block;">
                    <input type="checkbox" name="allergies[]" value="{{ $allergy_item->id }}" checked>
                    {{ $allergy_item->name }}
                </label>
            @else
                <label style="display: block;">
                    <input type="checkbox" name="allergies[]" value="{{ $allergy_item->id }}">
                    {{ $allergy_item->name }}
                </label>
            @endif
        @endforeach
        <x-input-error :messages="$errors->get('allergies')" class="mt-2" />
    </div>
</div>
