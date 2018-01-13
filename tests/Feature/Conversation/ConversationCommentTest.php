<?php

namespace Tests\Feature\Conversation;

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
//        dd($this->conversations['sticky']);
    }
}
