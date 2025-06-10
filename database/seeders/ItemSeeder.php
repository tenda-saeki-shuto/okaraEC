<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;


class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            [
                'id' => 1,
                'name' => 'おからクッキー',
                'content' => '小麦粉をおからに置き換えることで、カロリーや糖質を抑えたおからクッキー。糖質制限やダイエット中の人に人気です。',
                'img' => 'sample.png',
                'is_cold' => false,
                'is_frozen' => false,
                'category_id' => 1,
                'price' => 500,
            ],
            [
                'id' => 2,
                'name' => 'おからドーナツ',
                'content' => 'おから由来の植物性タンパク質も摂れちゃう優れもの。
おからは吸水性が抜群！お腹の中で最大5倍にまで膨らむから、食べ応えもしっかりあります。朝食やおやつの代わりに。置き換えダイエットにもぴったりです。',
                'img' => 'sample.png',
                'is_cold' => false,
                'is_frozen' => false,
                'category_id' => 1,
                'price' => 500,
            ],
            [
                'id' => 3,
                'name' => 'おからハンバーグ',
                'content' => 'おから効果でふっくら、どどんと大きいハンバーグに。
ボリューム満点なのに、ヘルシーでさっぱりした仕上がりです。',
                'img' => 'sample.png',
                'is_cold' => false,
                'is_frozen' => true,
                'category_id' => 2,
                'price' => 1000,
            ],
        ]);
        DB::table('item_nutrition_facts')->insert([
            [
                'id' => 1,
                'item_id' => 1,
                'energy' => 187,
                'protein' => 5.2,
                'fat' => 1.7,
                'carb' => 39.7,
                'fiber' => 4.5,
                'salt_eqv' => 0.4,
            ],
            [
                'id' => 2,
                'item_id' => 2,
                'energy' => 86,
                'protein' => 1.9,
                'fat' => 3.4,
                'carb' => 12.5,
                'fiber' => 0.8,
                'salt_eqv' => 0.1,
            ],
            [
                'id' => 3,
                'item_id' => 3,
                'energy' => 208,
                'protein' => 11.7,
                'fat' => 13.5,
                'carb' => 12.8,
                'fiber' => 3.5,
                'salt_eqv' => 1.1,
            ],
        ]);
        DB::table('item_allergies')->insert([
            [
                'item_id' => 1,
                'allergy_id' => 4,
            ],
            [
                'item_id' => 1,
                'allergy_id' => 6,
            ],
            [
                'item_id' => 1,
                'allergy_id' => 7,
            ],
            [
                'item_id' => 1,
                'allergy_id' => 20,
            ],
            [
                'item_id' => 2,
                'allergy_id' => 4,
            ],
            [
                'item_id' => 2,
                'allergy_id' => 6,
            ],
            [
                'item_id' => 2,
                'allergy_id' => 7,
            ],
            [
                'item_id' => 2,
                'allergy_id' => 20,
            ],
            [
                'item_id' => 3,
                'allergy_id' => 4,
            ],
            [
                'item_id' => 3,
                'allergy_id' => 6,
            ],
            [
                'item_id' => 3,
                'allergy_id' => 7,
            ],
            [
                'item_id' => 3,
                'allergy_id' => 16,
            ],
            [
                'item_id' => 3,
                'allergy_id' => 20,
            ],
            [
                'item_id' => 3,
                'allergy_id' => 23,
            ],
        ]);
    }
}
