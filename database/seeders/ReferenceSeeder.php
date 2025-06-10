<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ReferenceSeeder extends Seeder
{
    private $prefectures = [
        "北海道",
        "青森県",
        "岩手県",
        "宮城県",
        "秋田県",
        "山形県",
        "福島県",
        "茨城県",
        "栃木県",
        "群馬県",
        "埼玉県",
        "千葉県",
        "東京都",
        "神奈川県",
        "新潟県",
        "富山県",
        "石川県",
        "福井県",
        "山梨県",
        "長野県",
        "岐阜県",
        "静岡県",
        "愛知県",
        "三重県",
        "滋賀県",
        "京都府",
        "大阪府",
        "兵庫県",
        "奈良県",
        "和歌山県",
        "鳥取県",
        "島根県",
        "岡山県",
        "広島県",
        "山口県",
        "徳島県",
        "香川県",
        "愛媛県",
        "高知県",
        "福岡県",
        "佐賀県",
        "長崎県",
        "熊本県",
        "大分県",
        "宮崎県",
        "鹿児島県",
        "沖縄県"
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->prefectures as $prefecture) {
            DB::table("prefectures")->insert([
                "name" => $prefecture
            ]);
        }
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

        DB::table('coupons')->insert([
            [
                'id' => 1,
                'name' => '新規登録記念クーポン',
                'content' => '2000円以上のご購入で、500円割引',
                'discount' => 500,
                'img' => 'sample.png',
                'valid_date' => '2025-07-31 23:59',
            ],
            [
                'id' => 2,
                'name' => '500円引きクーポン',
                'content' => '2000円以上のご購入で、500円割引',
                'discount' => 500,
                'img' => 'sample.png',
                'valid_date' => '2025-08-31 23:59',
            ],
        ]);
    }
}
