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
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test',
        //     'email' => 'test@example.com',
        // ]);

        // User::create(
        //     [
        //         'id' => 2,
        //         'name' => 'aaa',
        //         'email' => 'aaa@aaa',
        //         'password' => 'aaaaaaaa',
        //     ]);
            // User::create(
            // [
            //     'id' => 3,
            //     'name' => 'bbb',
            //     'email' => 'bbb@bbb',
            //     'password' => 'bbbbbbbbb',
            // ]);       
            // User::create(    
            // [
            //     'id' => 4,
            //     'name' => 'ccc',
            //     'email' => 'ccc@ccc',
            //     'password' => 'ccccccccc',
            // ]);

        //      DB::table('addresses')->insert([
        //         [
        //         'user_id' => 4,
        //         'postal_code' => '1234567',
        //         'prefecture_id' => 2,
        //         'address' => '〇〇〇〇市〇〇〇１－３－４',
        //     ],
        // ]);
        // $this->call(ReferenceSeeder::class);
        // $this->call(ItemSeeder::class);
        // $this->call(QuizSeeder::class);
        // $this->call(RecipeSeeder::class);
         $this->call(UserOptSeeder::class);
    }
}
