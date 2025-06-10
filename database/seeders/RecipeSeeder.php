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
    }
}
