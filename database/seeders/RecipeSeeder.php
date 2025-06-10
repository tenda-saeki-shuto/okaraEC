<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'おやつ',
            ],
            [
                'id' => 2,
                'name' => '惣菜',
            ],
        ]);
         DB::table(table:'recipes')->insert(values:[
            [
                'id'=> 1,
                'title'=> 'レモンヨーグルトパンケーキ',
                'content' => '小麦粉の代わりにおからパウダーを使って糖質を抑えました。レモンを効かせたヨーグルトクリームでさっぱりといただきます。',
                'img' => 'pancakeMain.jpg',
                'time'=> '30分以内',
                'amount'=> '4人分',
                'category_id' => 1,
            ],
            [
                'id'=> 2,
                'title'=> 'おからのチョコ蒸しケーキ',
                'content' => '小麦粉の代わりにおからパウダーを使って糖質をカット。混ぜて電子レンジで加熱するだけなので、作りやすい一品です。',
                'img' => 'chocoMain.jpg',
                'time'=> '15分以内',
                'amount'=> '4人分',
                'category_id' => 1,
            ],
             [
                'id'=> 3,
                'title'=> 'おから入り にらチーズチヂミ',
                'content' => '小麦粉の代わりにおからパウダーを使って糖質をカット。混ぜて電子レンジで加熱するだけなので、作りやすい一品です。',
                'img' => 'chijimiMaion.jpg',
                'time'=> '15分以内',
                'amount'=> '2人分',
                'category_id' => 2,
             ],
             [
                'id'=> 4,
                'title'=> 'レーズンとアーモンドのおからクッキー',
                'content' => '鉄分を含むレーズンとアーモンドを贅沢に使った、さくさく食感がたまらないおから入りクッキー。間食やお子さんのおやつに。',
                'img' => 'cookieMain.jpg',
                'time'=> '45分以内',
                'amount'=> '8人分',
                'category_id' => 1,
            ],             
            [
                'id'=> 5,
                'title'=> '電子レンジで 簡単卯の花',
                'content' => '野菜の甘味がおいしい、ほっとするやさしい味わいの卯の花。電子レンジで作ると、少ない調味料でも仕上がります。',
                'img' => 'unohanaMain.jpg',
                'time'=> '15分以内',
                'amount'=> '2人分',
                'category_id' => 2,
            ],
        ]);
        
        DB::table('recipe_steps')->insert([
            [
                'id' => 1,    
                'recipe_id' => 1,
                'content' => 'Aとクリームの材料はそれぞれ合わせておきます。',                
                'img' => 'pancake1.jpg',
            ],[
                'id' => 2,    
                'recipe_id' => 1,
                'content' => '別のボウルにおからパウダー、砂糖、ベーキングパウダーを合わせます。Aを加えて泡立て器で粉っぽさがなくなるまで混ぜます。',                
                'img' => 'pancake2.jpg',
            ],[
                'id' => 3,    
                'recipe_id' => 1,
                'content' => 'フライパンにサラダ油を薄くひき、弱火で熱します。２の生地を直径６cmくらいの大きさになるように流し入れて２分焼きます。',                
                'img' => 'pancake3.jpg',
            ],[
                'id' => 4,    
                'recipe_id' => 1,
                'content' => 'こんがりと焼き色がついたら、裏返してさらに２分ほど焼きます。',                
                'img' => 'pancake4.jpg',
            ],[
                'id' => 5,    
                'recipe_id' => 1,
                'content' => '両面にこんがりと焼き色がついたら器に盛ります。１のクリームをのせ、お好みでアーモンド、粉糖を散らして出来上がりです。',                
                'img' => 'null',
            ],[
                'id' => 6,    
                'recipe_id' => 2,
                'content' => 'すべての材料をボウルに入れ、粉っぽさがなくなるまで泡立て器でよく混ぜます。',                
                'img' => 'choco1.jpg',
            ],     [
                'id' => 7,    
                'recipe_id' => 2,
                'content' => '耐熱のカップの中に紙のカップを重ね、１を流し入れます。',                
                'img' => 'choco2.\jpg',
            ],[
                'id' => 8,    
                'recipe_id' => 2,
                'content' => '電子レンジ（600w）で３分加熱します。竹串を刺して生地がついてこなければ出来上がりです',                
                'img' => 'null',
            ],[
                'id' => 9,    
                'recipe_id' => 3,
                'content' => 'にらは３cm長さに切ります。',                
                'img' => 'null',
            ],[
                'id' => 10,    
                'recipe_id' => 3,
                'content' => 'ボウルにおからパウダーと水を入れ、菜箸で混ぜます。Aを加え、よく混ぜ合わせます。',                
                'img' => 'null',
            ],[
                'id' => 11,    
                'recipe_id' => 3,
                'content' => 'フライパンにごま油を中火で熱し、２を流し入れて薄くのばします。ピザ用チーズ、にらの順にのせ、焼き色がついたら裏返します。',                
                'img' => 'chijimi1.jpg',
            ],[
                'id' => 12,    
                'recipe_id' => 3,
                'content' => 'へらで押し付けながら、裏面も焼き色がつくまで焼きます。',                
                'img' => 'chijimi2.jpg',
            ],[
                'id' => 13,    
                'recipe_id' => 3,
                'content' => '食べやすい大きさに切り、器に盛り付けます。ぽん酢しょうゆにつけていただきます。',                
                'img' => 'chijimi3.jpg',
            ],[
                'id' => 14,    
                'recipe_id' => 4,
                'content' => 'バターは室温に戻し、大きめのボウルに入れて、泡立て器でクリーム状になるまで混ぜます。',                
                'img' => 'cookie1.jpg',
            ],[
                'id' => 15,    
                'recipe_id' => 4,
                'content' => 'バターがクリーム状になったら、砂糖を加えて白っぽくなるまで混ぜます。',                
                'img' => 'null',
            ],[
                'id' => 16,    
                'recipe_id' => 4,
                'content' => '卵を溶きほぐし、1/5 (10ｇ)は取りおき、残りを２に加えて均一になるまで泡立て器で混ぜます。',                
                'img' => 'null',
            ],[
                'id' => 17,    
                'recipe_id' => 4,
                'content' => '卵が均一になったら、乾燥おからとホットケーキミックスを加え、切るようにゴムべらで混ぜます。',                
                'img' => 'null',
            ],[
                'id' => 18,    
                'recipe_id' => 4,
                'content' => '粉っぽさがなくなったら、レーズンとアーモンドを加えてゴムベラで合わせます。',                
                'img' => 'cookie2.jpg',
            ],[
                'id' => 19,    
                'recipe_id' => 4,
                'content' => 'オーブンを180℃に予熱します。',                
                'img' => 'cookie3.jpg',
            ],[
                'id' => 20,    
                'recipe_id' => 4,
                'content' => 'オーブンシートを敷いた天パンに５mmの厚さに伸ばします。生地全体にフォークで穴を開けます。',                
                'img' => 'cookie4.jpg',
            ],[
                'id' => 21,    
                'recipe_id' => 4,
                'content' => '取っておいた残りの卵を、刷毛で生地の表面に塗ります。',                
                'img' => 'cookie5.jpg',
            ],[
                'id' => 22,    
                'recipe_id' => 4,
                'content' => '180℃に予熱したオーブンで12分ほど焼きます。表面にツヤがでてほんのり焼き色がついたら焼き上がりです。',                
                'img' => 'cookie6.jpg',
            ],[
                'id' => 23,    
                'recipe_id' => 4,
                'content' => '粗熱がとれたら、４cm四方に切って出来上がりです。',                
                'img' => 'cookie7.jpg',
            ],[
                'id' => 24,    
                'recipe_id' => 5,
                'content' => 'おからパウダーを水で戻す。',                
                'img' => 'null',
            ],[
                'id' => 25,    
                'recipe_id' => 5,
                'content' => '長ネギは小口切り、にんじんは4cm長さの細切り、油揚げは4cm長さの短冊切りにします。',                
                'img' => 'unohana1.jpg',
            ],[
                'id' => 26,    
                'recipe_id' => 5,
                'content' => 'ボウルに1、Aを入れて混ぜ合わせ、ふんわりとラップをしたら、電子レンジ（600W）で3分ほど加熱します。',                
                'img' => 'null',
            ],[
                'id' => 27,    
                'recipe_id' => 5,
                'content' => '一度取り出し、おからを加えて全体を混ぜ合わせます。再度ラップをし、電子レンジ（600W）で3分ほど加熱します。',                
                'img' => 'unohana2.jpg',
            ],
        ]);
        
        DB::table('recipe_ingredients')->insert([
            [
                'id' => 1,
                'recipe_id' => 1,
                'name' => 'おからパウダー',
                'amount' => '37.5g',
            ],[
                'id' => 2,
                'recipe_id' => 1,
                'name' => '砂糖',
                'amount' => '大さじ3/4(6.8g)',
            ],[
                'id' => 3,
                'recipe_id' => 1,
                'name' => 'ベーキングパウダー',
                'amount' => '小さじ3/4(3g)',
            ],[
                'id' => 4,
                'recipe_id' => 1,
                'name' => 'サラダ油',
                'amount' => '小さじ3/4 (3g)',
            ],[
                'id' => 5,
                'recipe_id' => 1,
                'name' => 'A.無調整豆乳',
                'amount' => '150ml',
            ],    [
                'id' => 6,
                'recipe_id' => 1,
                'name' => 'A.卵',
                'amount' => '75g',
            ],    [
                'id' => 7,
                'recipe_id' => 1,
                'name' => 'A.バター（電子レンジで溶かす）',
                'amount' => '大さじ3/4(9g)',
            ],    [
                'id' => 8,
                'recipe_id' => 1,
                'name' => 'クリーム.ギリシャヨーグルト',
                'amount' => '37.5g',
            ],    [
                'id' => 9,
                'recipe_id' => 1,
                'name' => 'クリーム.レモン汁',
                'amount' => '小さじ1強 (5.6 g)',
            ],    [
                'id' => 10,
                'recipe_id' => 1,
                'name' => 'クリーム.はちみつ',
                'amount' => '小さじ3/4(5.3g)',
            ],    [
                'id' => 11,
                'recipe_id' => 1,
                'name' => 'アーモンド（お好みで）',
                'amount' => '3g',
            ],    [
                'id' => 12,
                'recipe_id' => 1,
                'name' => '粉糖（お好みで）',
                'amount' => '少々',
            ],[
                'id' => 13,
                'recipe_id' => 2,
                'name' => 'おからパウダー',
                'amount' => '20g',
            ],[
                'id' => 14,
                'recipe_id' => 2,
                'name' => '卵（Mサイズ）',
                'amount' => '50g',
            ],[
                'id' => 15,
                'recipe_id' => 2,
                'name' => '牛乳',
                'amount' => '40ml',
            ],[
                'id' => 16,
                'recipe_id' => 2,
                'name' => '砂糖',
                'amount' => '大さじ1と3/4強(16g)',
            ],[
                'id' => 17,
                'recipe_id' => 2,
                'name' => 'ココアパウダー',
                'amount' => '大さじ2/3(4g)',
            ],[
                'id' => 18,
                'recipe_id' => 2,
                'name' => 'ベーキングパウダー',
                'amount' => '小さじ1/2(2g)',
            ],[
                'id' => 19,
                'recipe_id' => 2,
                'name' => 'サラダ油',
                'amount' => '大さじ1(12g)',
            ],[
                'id' => 20,
                'recipe_id' => 3,
                'name' => 'おからパウダー',
                'amount' => '20g',
            ],[
                'id' => 21,
                'recipe_id' => 3,
                'name' => '水',
                'amount' => '60ml',
            ],[
                'id' => 22,
                'recipe_id' => 3,
                'name' => 'にら',
                'amount' => '20g',
            ],[
                'id' => 23,
                'recipe_id' => 3,
                'name' => 'ごま油',
                'amount' => '大さじ1(12g)',
            ],[
                'id' => 24,
                'recipe_id' => 3,
                'name' => 'ピザ用チーズ',
                'amount' => '30g',
            ],[
                'id' => 25,
                'recipe_id' => 3,
                'name' => 'ぽん酢しょうゆ',
                'amount' => '大さじ1強(20g)',
            ],[
                'id' => 26,
                'recipe_id' => 3,
                'name' => 'A.卵（Mサイズ）',
                'amount' => '50g',
            ],[
                'id' => 27,
                'recipe_id' => 3,
                'name' => 'A.片栗粉',
                'amount' => '大さじ2/3(6g)',
            ],[
                'id' => 28,
                'recipe_id' => 3,
                'name' => 'A.塩',
                'amount' => '0.4g',
            ],[
                'id' => 29,
                'recipe_id' => 4,
                'name' => 'ホットケーキミックス',
                'amount' => '60g',
            ],[
                'id' => 30,
                'recipe_id' => 4,
                'name' => '乾燥おから',
                'amount' => '40g',
            ],[
                'id' => 31,
                'recipe_id' => 4,
                'name' => 'バター',
                'amount' => '60g',
            ],[
                'id' => 32,
                'recipe_id' => 4,
                'name' => 'レーズン',
                'amount' => '180g',
            ],[
                'id' => 33,
                'recipe_id' => 4,
                'name' => '卵（Lサイズ）',
                'amount' => '60g',
            ],[
                'id' => 34,
                'recipe_id' => 4,
                'name' => '砂糖',
                'amount' => '小さじ2と2/3(8g)',
            ],[
                'id' => 35,
                'recipe_id' => 4,
                'name' => 'アーモンドスライス',
                'amount' => '20g',
            ],[
                'id' => 36,
                'recipe_id' => 4,
                'name' => 'おからパウダー',
                'amount' => '70g',
            ],[
                'id' => 37,
                'recipe_id' => 5,
                'name' => '油揚げ',
                'amount' => '10g',
            ],[
                'id' => 38,
                'recipe_id' => 5,
                'name' => '長ねぎ',
                'amount' => '20g',
            ],[
                'id' => 39,
                'recipe_id' => 5,
                'name' => 'にんじん',
                'amount' => '10g',
            ],[
                'id' => 40,
                'recipe_id' => 5,
                'name' => 'A.だし汁（かつお・昆布）',
                'amount' => '80ml',
            ],[
                'id' => 41,
                'recipe_id' => 5,
                'name' => 'A.しょうゆ',
                'amount' => '小さじ1(6g)',
            ],[
                'id' => 42,
                'recipe_id' => 5,
                'name' => 'A.みりん',
                'amount' => '小さじ1(6g)',
            ],[
                'id' => 43,
                'recipe_id' => 5,
                'name' => 'A.砂糖',
                'amount' => '小さじ1(3g)',
            ],      [
                'id' => 44,
                'recipe_id' => 5,
                'name' => 'A.塩',
                'amount' => '0.4g',
            ],     
        ]);
  
        DB::table('recipe_nutrition_facts')->insert([
            [
                'id' => 1,
                'recipe_id' => 1,       
                'energy' => 164,
                'protain' => 9.2,
                'fat' => 10.2,
                'carb' => 12.7,              
                'fiber' => 6,
                'salt_eqv' => 0.3,
            ],[
                'id' => 2,
                'recipe_id' => 2,       
                'energy' => 87,
                'protain' => 3.2,
                'fat' => 5.6,
                'carb' => 7.7,              
                'fiber' => 2.4,
                'salt_eqv' => 0.1,
            ],[
                'id' => 3,
                'recipe_id' => 3,       
                'energy' => 186,
                'protain' => 9.3,
                'fat' => 13.9,
                'carb' => 9.1,              
                'fiber' => 4.7,
                'salt_eqv' => 1.3,
            ],[
                'id' => 4,
                'recipe_id' => 4,       
                'energy' => 199,
                'protain' => 3.8,
                'fat' => 9.2,
                'carb' => 27.8,              
                'fiber' => 3.5,
                'salt_eqv' => 0.3,
            ],[
                'id' => 5,
                'recipe_id' => 5,      
                'energy' => 71,
                'protain' => 3.8,
                'fat' => 3,
                'carb' => 9.3,              
                'fiber' => 4.5,
                'salt_eqv' => 0.7,
            ],

        ]);
        
       
    }
}
