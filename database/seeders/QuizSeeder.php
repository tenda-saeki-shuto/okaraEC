<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('quizzes')->insert([
            [
                'id' => 1,
                'title' => 'おからVSごぼう：食物繊維の勝者は？',
                'content' => '生おから100ｇに含まれる食繊維の量は、ごぼう100ｇと比べてどれくらい多いでしょうか？',
                'start' => '2025-4-1',
                'end' => '2025-4-30',
            ],
            [
                'id' => 2,
                'title' => 'たんぱく質は意外と…？',
                'content' => 'ちまたには低カロリーとされるおから。その100ｇの中に含まれるたんぱく質の量は一体どの程度でしょうか？',
                'start' => '2025-5-1',
                'end' => '2025-5-30',
            ],
            [
                'id' => 3,
                'title' => '絞りとったおからにはどれくらいのたんぱく質が残る？',
                'content' => '豆腐や豆乳の絞りかす”おから”には、元の大豆のたんぱく質がどの程度残っているでしょう',
                'start' => '2025-6-1',
                'end' => '2025-6-30',
            ],
            [
                'id' => 4,
                'title' => '豆腐とおから：副産物の生産量',
                'content' => '4月8日は「おから」の日だそうです。豆腐を作る時に大豆から豆乳を搾り、
その残りカスが「おから」ですが、このおから、豆腐作りの副産物として、どのくらい出る？',
                'start' => '2025-7-1',
                'end' => '2025-7-31',
            ],
            [
                'id' => 5,
                'title' => '中国でおからが意味するもの',
                'content' => '中国ではおからのことを「豆腐渣」（トウフジャー）といい、
「豆腐渣工程」(トウフジャーコンチョン)という言葉があります。これは、どういう意味の言葉？',
                'start' => '2025-8-1',
                'end' => '2025-8-31',
            ],
            [
                'id' => 6,
                'title' => 'おから裁判のゆくえ',
                'content' => '1999年「おから裁判」が行われ、おからの分類が決定しました。
おからの分類は次のどれになったでしょうか？',
                'start' => '2025-9-1',
                'end' => '2025-9-30',
            ],
        ]);
        DB::table('quiz_selections')->insert([
            [
                'quiz_id' => 1,
                'content' => '同じ',
                'is_answer' => false,
            ],
            [
                'quiz_id' => 1,
                'content' => '約3倍',
                'is_answer' => false,
            ],
            [
                'quiz_id' => 1,
                'content' => '約4倍',
                'is_answer' => false,
            ],
            [
                'quiz_id' => 1,
                'content' => '約2倍',
                'is_answer' => true,
            ],
            [
                'quiz_id' => 2,
                'content' => '3g',
                'is_answer' => false,
            ],
            [
                'quiz_id' => 2,
                'content' => '9g',
                'is_answer' => false,
            ],
            [
                'quiz_id' => 2,
                'content' => '12g',
                'is_answer' => false,
            ],
            [
                'quiz_id' => 2,
                'content' => '6g',
                'is_answer' => true,
            ],
            [
                'quiz_id' => 3,
                'content' => '10~20%',
                'is_answer' => false,
            ],
            [
                'quiz_id' => 3,
                'content' => '25~30%',
                'is_answer' => false,
            ],
            [
                'quiz_id' => 3,
                'content' => '50~60%',
                'is_answer' => false,
            ],
            [
                'quiz_id' => 3,
                'content' => '35~40%',
                'is_answer' => true,
            ],
            [
                'quiz_id' => 4,
                'content' => '使用した大豆の重要の半分程度',
                'is_answer' => false,
            ],
            [
                'quiz_id' => 4,
                'content' => '使用した大豆の重量と同程度',
                'is_answer' => false,
            ],
            [
                'quiz_id' => 4,
                'content' => '搾って出た豆腐の重要と同程度',
                'is_answer' => false,
            ],
            [
                'quiz_id' => 4,
                'content' => '使用した大豆の重量よりも大きい',
                'is_answer' => true,
            ],
            [
                'quiz_id' => 5,
                'content' => 'おから作りのように大変である',
                'is_answer' => false,
            ],
            [
                'quiz_id' => 5,
                'content' => 'おからのように中身がない',
                'is_answer' => false,
            ],
            [
                'quiz_id' => 5,
                'content' => 'スカスカのスケジュール',
                'is_answer' => false,
            ],
            [
                'quiz_id' => 5,
                'content' => '手抜き工事をする',
                'is_answer' => true,
            ],
            [
                'quiz_id' => 6,
                'content' => '食品',
                'is_answer' => false,
            ],
            [
                'quiz_id' => 6,
                'content' => '飼料',
                'is_answer' => false,
            ],
            [
                'quiz_id' => 6,
                'content' => '燃料',
                'is_answer' => false,
            ],
            [
                'quiz_id' => 6,
                'content' => 'ゴミ',
                'is_answer' => true,
            ],
        ]);
    }
}
