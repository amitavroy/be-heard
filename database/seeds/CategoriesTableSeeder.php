<?php

use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Category::create(['name' => 'Restricted', 'protected' => 1]);
        Category::create(['name' => 'Common',]);
        Category::create(['name' => 'Feedback',]);

        for ($i = 0; $i <= 30; $i++) {
            $conversation = factory(\App\Models\Conversation::class)->create([
                'creator' => 1,
            ]);

            $conversation->categories()->attach($faker->randomElement([1, 2, 3]));
        }
    }
}
