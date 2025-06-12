<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
  
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'tel' => '090123456678', //電話番号の追加
        ]);

        User::create([
            'id' => 100,
            'name' => 'a',
            'email' => 'a@a',
            'password' => 'aaaaaaaa',
            'tel' => '090123456678', //電話番号の追加
        ]);

        //      DB::table('addresses')->insert([
        //         [
        //         'user_id' => 4,
        //         'postal_code' => '1234567',
        //         'prefecture_id' => 2,
        //         'address' => '〇〇〇〇市〇〇〇１－３－４',
        //     ],
        // ]);
        $this->call(ReferenceSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(QuizSeeder::class);
        $this->call(RecipeSeeder::class);
        $this->call(UserOptSeeder::class);
    }
}
