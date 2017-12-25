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

    /** @test */
    public function user_when_logged_out_should_be_guest()
    {
        $postData = [
            '_token' => csrf_token(),
        ];

        $this->actingAs($this->user)
            ->post(route('logout'), $postData);

        $this->get(route('home'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function wrong_credentials_should_show_errors()
    {
        factory(User::class)->create([
            'email' => 'reachme@amitavroy.com',
            'password' => bcrypt('password'),
        ]);

        $postData = [
            'email' => 'wrong@gmail.com',
            'password' => 'wron',
        ];

        $response = $this->post(route('login'), $postData);

        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function user_can_login_with_correct_credentials()
    {
        factory(User::class)->create([
            'email' => 'reachme@amitavroy.com',
            'password' => bcrypt('password'),
        ]);

        $postData = [
            'email' => 'reachme@amitavroy.com',
            'password' => 'password',
        ];

        $response = $this->post(route('login'), $postData);

        $response->assertRedirect(route('home'));
    }
}
