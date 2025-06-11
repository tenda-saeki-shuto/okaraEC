<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;


class UserOptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('addresses')->insert([
                [
                'user_id' => 4,
                'postal_code' => '1234567',
                'prefecture_id' => 2,
                'address' => '〇〇〇〇市〇〇〇１－３－４',
            ],
        ]);
    }
}
        // DB::table('user_likes')->insert([
        //     [
        //         'user_id' => 1,
        //         'item_id' => 2,
        //     ],
        // ]);
        // DB::table('carts')->insert([
        //     [
        //         'user_id' => 1,
        //         'item_id' => 1,
        //         'count' => 3,
        //     ],
        //     [
        //         'user_id' => 2,
        //         'item_id' => 2,
        //         'count' => 10,
        //     ],
        // ]);
        // DB::table('regular_orders')->insert([
        //     [
        //         'user_id' => 1,
        //         'item_id' => 2,
        //         'payment' => 'クレジット',
        //     ],
        // ]);
        // DB::table('orders')->insert([
        //     [
        //         'id' => 1,
        //         'user_id' => 2,
        //         'order_code' => 'XXXXXXXX',
        //         'dateTime' => '2025-06-01 12:34',
        //         'status' => '発送済み',
        //         'is_regular' => false,
        //         'payment' => 'クレジット',
        //         'postal_code' => '1234567',
        //         'prefecture' => '東京都',
        //         'address' => '渋谷区渋谷〇〇〇ビル205号室',
        //         'email' => 'XXXX@aaaa',
        //         'tel' => '12345678901',
        //     ],
        //     [
        //         'id' => 2,
        //         'user_id' => 2,
        //         'order_code' => 'XXXXXXXX',
        //         'dateTime' => '2025-06-02 12:34',
        //         'status' => '発送済み',
        //         'is_regular' => true,
        //         'payment' => 'クレジット',
        //         'postal_code' => '1234567',
        //         'prefecture' => '東京都',
        //         'address' => '渋谷区渋谷〇〇〇ビル205号室',
        //         'email' => 'XXXX@aaaa',
        //         'tel' => '12345678901',
        //     ],
        // ]);
        // DB::table('order_details')->insert([
        //     [
        //         'order_id' => 1,
        //         'item_name' => 'おからクッキー',
        //         'price' => 100,
        //         'count' => 10,
        //     ],
        //     [
        //         'order_id' => 1,
        //         'item_name' => 'おからクッキー　いちご',
        //         'price' => 100,
        //         'count' => 3,
        //     ],
        //     [
        //         'order_id' => 2,
        //         'item_name' => 'おからクッキー　プレーン',
        //         'price' => 100,
        //         'count' => 4,
        //     ],
        // ]);
        // DB::table('user_coupons')->insert([
        //     [
        //         'user_id' => 1,
        //         'coupon_id' => 1,
        //     ],
        // ]);
        // DB::table('quiz_status')->insert([
        //     [
        //         'quiz_id' => 1,
        //         'user_id' => 1,
        //         'is_clear' => true,
        //     ],
        //     [
        //         'quiz_id' => 2,
        //         'user_id' => 1,
        //         'is_clear' => true,
        //     ],
        // ]);
 