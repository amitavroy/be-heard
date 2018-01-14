<?php

namespace Tests\Feature\Conversation;

use App\Models\Comment;
use App\Models\Conversation;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\TestHelper;

class ConversationCommentTest extends TestCase
{
    use DatabaseMigrations, TestHelper;

    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->setupConversations();
        $this->user = $this->getActiveUser();
    }

    /** @test */
    public function a_user_can_make_comment()
    {
        $sticky = $this->conversations['sticky'];

        $postData = [
            'conversationId' => $sticky->id,
            'body' => 'Quick brown fox jumps over the candle stick',
        ];

        $this->actingAs($this->user, 'api')
            ->post(route('conversation.reply'), $postData);

        $this->actingAs($this->user)
            ->get(route('conversation.view', $sticky->slug))
            ->assertSee('Quick brown fox jumps over the candle stick');
    }

    /** @test */
    public function a_comment_without_body_throws_validation_error()
    {
        $sticky = $this->conversations['sticky'];

        $postData = [
            'conversationId' => $sticky->id,
        ];

        $this->actingAs($this->user, 'api')
            ->post(route('conversation.reply'), $postData)
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function small_comment_will_have_error()
    {
        $sticky = $this->conversations['sticky'];

        $postData = [
            'conversationId' => $sticky->id,
            'body' => 'asdf',
        ];

        $this->actingAs($this->user, 'api')
            ->post(route('conversation.reply'), $postData)
            ->assertSessionHasErrors('body');
    }
}
