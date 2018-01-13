<?php

namespace Tests;


use App\Models\Category;
use App\Models\Conversation;
use App\User;
use Carbon\Carbon;

trait TestHelper
{
    private $categories = [];
    private $conversations = [];

    public function getActiveUser()
    {
        return factory(User::class)->create([
            'name' => 'Amitav Roy',
            'email' => 'reachme@amitavroy.com',
            'password' => bcrypt('password'),
            'active' => 1,
        ]);
    }

    protected function setupConversations()
    {
        $this->categories = [
            'admin' => factory(Category::class)->create(['name' => 'Admins']),
            'uncat' => factory(Category::class)->create(['name' => 'Uncategorised']),
            'feedback' => factory(Category::class)->create(['name' => 'Feedback']),
            'inactive' => factory(Category::class)->create(['name' => 'In active', 'is_active' => 0]),
        ];

        for ($i = 0; $i <= 30; $i++) {
            $conversation = factory(Conversation::class)->create([
                'creator' => 1,
            ]);

            $conversation->categories()->attach(rand(1, 3));
        }

        $this->conversations['sticky'] = factory(Conversation::class)->create([
            'creator' => 1,
            'created_at' => Carbon::now()->subYears(7),
            'updated_at' => Carbon::now()->subYears(7),
            'sticky' => 1,
        ]);
    }
}