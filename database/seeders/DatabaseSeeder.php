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

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::create([
            'id' => 100,
            'name' => 'a',
            'email' => 'a@a',
            'password' => 'aaaaaaaa',
        ]);

        $this->call(ReferenceSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(QuizSeeder::class);
        $this->call(RecipeSeeder::class);
        $this->call(UserOptSeeder::class);
    }
}
