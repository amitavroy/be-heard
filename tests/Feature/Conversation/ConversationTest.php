<?php

namespace Tests\Feature\Conversation;

use App\Models\Category;
use App\Models\Conversation;
use Faker\Generator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\TestHelper;

class ConversationTest extends TestCase
{
    use DatabaseMigrations, TestHelper;

    private $categories = [];

    public function setUp()
    {
        parent::setUp();
        $this->setupConversations();
    }

    protected function setupConversations()
    {
        $this->categories = [
            'admin' => factory(Category::class)->create(['name' => 'Admins']),
            'uncat' => factory(Category::class)->create(['name' => 'Uncategorised']),
            'feedback' => factory(Category::class)->create(['name' => 'Feedback']),
        ];

        for ($i = 0; $i <= 30; $i++) {
            $conversation = factory(Conversation::class)->create([
                'creator' => 1,
            ]);

            $conversation->categories()->attach(rand(1, 3));
        }
    }

    /** @test */
    public function listing_page_should_see_categories()
    {
        $this->actingAs($this->getActiveUser())
            ->get(route('home'))
            ->assertSee('Admins')
            ->assertStatus(200);
    }
}
