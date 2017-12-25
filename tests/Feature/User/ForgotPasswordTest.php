<?php

namespace Tests\Feature\User;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use DatabaseMigrations;

    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function a_guest_user_should_see_forgot_password_page()
    {
        $this->get(route('forgot-password'))
            ->assertStatus(200);

        $this->actingAs($this->user)
            ->get(route('forgot-password'))
            ->assertRedirect(route('home'));
    }
}
