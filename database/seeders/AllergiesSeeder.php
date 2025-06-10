<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class AllergiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('allergies')->insert([
            [
                'id' => 1,
                'name' => 'えび',
            ],
            [
                'id' => 2,
                'name' => 'かに',
            ],
            [
                'id' => 3,
                'name' => 'くるみ',
            ],
            [
                'id' => 4,
                'name' => '小麦',
            ],
            [
                'id' => 5,
                'name' => 'そば',
            ],
            [
                'id' => 6,
                'name' => '卵',
            ],
            [
                'id' => 7,
                'name' => '乳',
            ],
            [
                'id' => 8,
                'name' => '落花生（ピーナッツ）',
            ],
            [
                'id' => 9,
                'name' => 'アーモンド',
            ],
            [
                'id' => 10,
                'name' => 'あわび',
            ],
            [
                'id' => 11,
                'name' => 'いか',
            ],
            [
                'id' => 12,
                'name' => 'いくら',
            ],
            [
                'id' => 13,
                'name' => 'オレンジ',
            ],
            [
                'id' => 14,
                'name' => 'カシューナッツ',
            ],
            [
                'id' => 15,
                'name' => 'キウイフルーツ',
            ],
            [
                'id' => 16,
                'name' => '牛肉',
            ],
            [
                'id' => 17,
                'name' => 'ごま',
            ],
            [
                'id' => 18,
                'name' => 'さけ',
            ],
            [
                'id' => 19,
                'name' => 'さば',
            ],
            [
                'id' => 20,
                'name' => '大豆',
            ],
            [
                'id' => 21,
                'name' => '鶏肉',
            ],
            [
                'id' => 22,
                'name' => 'バナナ',
            ],
            [
                'id' => 23,
                'name' => '豚肉',
            ],
            [
                'id' => 24,
                'name' => 'マカダミアナッツ',
            ],
            [
                'id' => 25,
                'name' => 'もも',
            ],
            [
                'id' => 26,
                'name' => 'やまいも',
            ],
            [
                'id' => 27,
                'name' => 'りんご',
            ],
            [
                'id' => 28,
                'name' => 'ゼラチン',
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
