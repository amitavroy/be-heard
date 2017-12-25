<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserLoginTest extends TestCase
{
    use DatabaseMigrations;

    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function a_guest_should_see_login_page()
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
    }

    /** @test */
    public function a_guest_should_not_see_home()
    {
        $this
            ->get(route('home'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function an_auth_user_should_not_see_login_page()
    {
        $this->actingAs($this->user)
            ->get(route('login'))
            ->assertRedirect(route('home'));
    }

    /** @test */
    public function inactive_user_should_not_see_home()
    {
        $inactiveUser = factory(User::class)->create(['active' => 0]);

        $this->actingAs($inactiveUser)
            ->get(route('home'))
            ->assertRedirect(route('inactive'));
    }
}
