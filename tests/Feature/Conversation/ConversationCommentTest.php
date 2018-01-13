<?php

namespace Tests\Feature\Conversation;

use App\Models\Conversation;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
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
}
