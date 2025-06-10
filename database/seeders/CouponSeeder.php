<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
