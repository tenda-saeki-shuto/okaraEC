<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録</title>
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
</head>
<body>
    <h1>商品登録</h1>
    <div class="container">
        <form action="" method="POST">
            @csrf
            <!-- 商品名 -->
            <div class="section">
                <label for="name">商品名：</label><br>
                <input type="text" id="name" name="name">
            </div>
        
            <!-- カテゴリ -->
            <div class="section">
                <label for="category">カテゴリ：</label><br>
                <select name="category_id" id="category_id">
                    <option value="1">クッキー</option>
                    <option value="2">ドーナツ</option>
                    <option value="3">ハンバーグ</option>
                </select>
            </div>
        
            <!-- メイン画像 -->
            <div class="section">
                <label for="main_img">メイン画像(１つだけ)：</label><br>
                <input type="file" name="img" accept="image/*"> 
            </div>
        
            <!-- サブ画像 -->
            <div class="section">
                <label for="sub_img">サブ画像(複数選択可)：</label><br>
                <input type="file" name="sub_imgs[]" accept="image/*" multiple>
            </div>
        
            <!-- 商品説明 -->
            <div class="section">
                <label for="item_discription">商品説明：</label><br>
                <textarea name="content" id="item_discription" rows="10" cols="50"></textarea>
            </div>
        
            <!-- 配送オプション -->
            <div class="section">
                <label>配送オプション：</label><br>
                <input type="radio" name="is_cold" value="refrigerated" checked>冷蔵
                <input type="radio" name="is_cold" value="frozen">冷凍
            </div>
        
            <!-- 価格 -->
            <div class="section">
                <label for="price">価格：</label><br>
                <input type="text" class="price" name="price">円
            </div>
        
            
            <!-- 栄養情報 -->
            <div class="section">
                <label>栄養情報：</label>
                <div class="nutrition">
                    <label for="calorie">カロリー：　</label>
                    <input type="text" id="calorie" name="energy">kcal
                </div>
    
                <div class="nutrition">
                    <label for="protein">タンパク質：</label>
                    <input type="text" id="protein" name="protein">g
                </div>
    
                <div class="nutrition">
                    <label for="fat">脂質：　　　</label>
                    <input type="text" id="fat" name="fat">g
                </div>
                
                <div class="nutrition">
                    <label for="carbohydrates">炭水化物：　</label>
                    <input type="text" id="carbohydrates" name="carb">g
                </div>
    
                <div class="nutrition">
                    <label for="fiber">食物繊維：　</label>
                    <input type="text" id="fiber" name="fiber">g
                </div>
    
                <div class="nutrition">
                    <label for="salt">食塩相当量：</label>
                    <input type="text" id="salt" name="salt_eqv">g
                </div>
            </div>
    
            <!-- アレルギー -->
            <div class="section">
                <label for="">アレルギー：</label>
                <div>
                    <select name="allergies[]" multiple>
                        @foreach ($allergy_list as $allergy_item)
                            <option value="{{ $allergy_item->id }}">{{ $allergy_item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

           
            <button type="submit">登録</button>
        </form>
    </div>

</body>
</html>