<?php

namespace Tests\Feature\Conversation;

use App\Models\Category;
use App\Models\Conversation;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\TestHelper;

class ConversationCreateTest extends TestCase
{
    use DatabaseMigrations, TestHelper;

    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = $this->getActiveUser();
    }

    /** @test */
//    public function a_guest_cannot_save_conversation()
//    {
//        $conv = factory(Conversation::class)->make()->toArray();
//
//        $this->post(route('conversation.save'), $conv)
//            ->assertRedirect(route('login'));
//    }

    /** @test */
    public function title_field_is_required()
    {
        $this->actingAs($this->user, 'api')
            ->post(route('conversation.save'), [])
            ->assertSessionHasErrors('body')
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function with_data_conversation_will_be_saved()
    {
        $category = factory(Category::class)->create();

        $conv = [
            'title' => 'This is a simple title for the conversation',
            'body' => 'This is a simple title for the conversation. Should work for body as well.',
            'categoryId' => 1,
        ];

        $response = $this->actingAs($this->user, 'api')
            ->json('POST', route('conversation.save'), $conv);

        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'title' => 'This is a simple title for the conversation',
                    'creator' => $this->user->id,
                ]
            ]);

        $this->actingAs($this->user)
            ->get(route('home'))
            ->assertSee('This is a simple title for the conversation');
    }
}
