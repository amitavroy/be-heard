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
        Category::create(['name' => 'Restricted',
            'protected' => 1,
            'description' => 'Posts created by staff and for staff only. This is a protected category so users can only ready posts in this category but they cannot create or reply to this section.'
        ]);

        Category::create([
            'name' => 'Common',
            'description' => 'Discussion across the board is possible.']);

        Category::create([
            'name' => 'Feedback'
        ]);

        for ($i = 0; $i <= 30; $i++) {
            $conversation = factory(\App\Models\Conversation::class)->create([
                'creator' => 1,
            ]);

            $conversation->categories()->attach($faker->randomElement([1, 2, 3]));
        }

        $sticky = factory(\App\Models\Conversation::class)->create([
            'creator' => 1,
            'sticky' => 1,
            'title' => 'This is a sticky old post',
            'updated_at' => \Carbon\Carbon::now()->subYears(2),
            'created_at' => \Carbon\Carbon::now()->subYears(2),
        ]);

        $sticky->categories()->attach(1);
    }
}