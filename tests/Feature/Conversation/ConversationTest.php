<?php

namespace Tests\Feature\Conversation;

use App\Models\Category;
use App\Models\Conversation;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\TestHelper;

class ConversationTest extends TestCase
{
    use DatabaseMigrations, TestHelper;

    private $categories = [];
    private $conversations = [];

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

    /** @test */
    public function listing_page_should_see_categories()
    {
        $this->actingAs($this->getActiveUser())
            ->get(route('home'))
            ->assertSee('Uncategorised')
            ->assertSee('Admins')
            ->assertSee('Feedback')
            ->assertDontSee('In active')
            ->assertStatus(200);
    }

    /** @test */
    public function a_sticky_post_should_be_visible_on_top()
    {
        factory(Conversation::class, 10)->create();

        $this->actingAs($this->getActiveUser())
            ->get(route('home'))
            ->assertSee($this->conversations['sticky']->title);
    }
}
