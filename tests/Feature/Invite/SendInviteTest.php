<?php

namespace Tests\Feature\Invite;

use App\Models\Invite;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestHelper;

class SendInviteTest extends TestCase
{
    use DatabaseMigrations, TestHelper;

    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = $this->getActiveUser();
    }

    /** @test */
    public function a_guest_should_not_see_invite_page()
    {
        $this->get('invite')->assertRedirect(route('login'));
    }

    /** @test */
    public function a_auth_user_should_see_invite_page()
    {
        $this->actingAs($this->user)
            ->get('invite')
            ->assertStatus(200)
            ->assertSee('You have not invited anyone yet.');
    }

    /** @test */
    public function a_user_should_see_blank_response_for_no_invites()
    {
        $this->actingAs($this->user)
            ->get(route('invite'))
            ->assertSeeText('You have not invited anyone yet.');

        factory(Invite::class)->create([
            'email' => 'no-reply@something.com',
            'user_id' => $this->user->id,
        ]);

        $this->actingAs($this->user)
            ->get(route('invite'))
            ->assertSeeText('no-reply@something.com');
    }
}
