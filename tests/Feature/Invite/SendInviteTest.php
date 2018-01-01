<?php

namespace Tests\Feature\Invite;

use App\Mail\Invite\RegistrationSuccessMail;
use App\Mail\Invite\SendInvitationMail;
use App\Models\Invite;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Tests\TestHelper;

class SendInviteTest extends TestCase
{
    use DatabaseMigrations, TestHelper;

    private $user;
    private $invite;

    public function setUp()
    {
        parent::setUp();
        $this->user = $this->getActiveUser();
        $this->invite = factory(Invite::class)->create();
    }

    /** @test */
    public function a_guest_should_not_see_invite_page()
    {
        $this->get(route('invite'))->assertRedirect(route('login'));
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

    /** @test */
    public function a_guest_should_not_see_invite_add()
    {
        $this->get(route('invite.add'))->assertRedirect(route('login'));
    }

    /** @test */
    public function an_auth_user_should_see_invite_add_page()
    {
        $this->actingAs($this->user)
            ->get(route('invite.add'))
            ->assertStatus(200)
            ->assertSeeText('Invite users');
    }

    /** @test */
    public function a_user_should_be_able_send_one_invite()
    {
        Mail::fake();

        $postData = [
            'emails' => 'randomname@gmail.com',
        ];

        $this->actingAs($this->user)
            ->post(route('invite.save'), $postData)
            ->assertRedirect(route('invite'));

        $user = $this->user;

        $invite = factory(Invite::class)->create([
            'email' => 'amitav.roy@focalworks.in',
            'user_id' => $user->id,
        ]);

        Mail::assertQueued(SendInvitationMail::class, function ($mail) use ($invite, $user) {
            return $mail->hasTo('randomname@gmail.com');
        });

        Mail::assertQueued(SendInvitationMail::class, 1);
    }

    /** @test */
    public function a_user_should_be_able_to_send_multiple_invites()
    {
        Mail::fake();

        $postData = [
            'emails' => "abc@on.com,bcd@acd.com,def@abc.com",
        ];

        $this->actingAs($this->user)
            ->post(route('invite.save'), $postData)
            ->assertRedirect(route('invite'));

        Mail::assertQueued(SendInvitationMail::class, 3);
    }

    /** @test */
    public function an_existing_user_cannot_be_invited()
    {
        // with one email address who is a user
        // validation message should come up
        Mail::fake();

        $postData = [
            'emails' => "reachme@amitavroy.com",
        ];
        $this->actingAs($this->user)
            ->post(route('invite.save'), $postData)
            ->assertSessionHasErrors()
//            ->assertRedirect(route('invite.add'))
//            ->assertSessionHas('flash_notification.emails', 'danger')
            ->assertStatus(302);

        $errors = request()->session()->get('errors');
        $messages = $errors->getBag('default')->getMessages();
        $emailErrorMessage = array_shift($messages['emails']);

        $this->assertEquals('Following email address reachme@amitavroy.com already exists.', $emailErrorMessage);

        Mail::assertQueued(SendInvitationMail::class, 0);
    }

    /** @test */
    public function one_user_in_many_emails_should_come_up()
    {
        // with multiple user email address
        // and one user which already exist
        // validation message should come
        Mail::fake();

        $postData = [
            'emails' => "abc@on.com,bcd@acd.com,def@abc.com,reachme@amitavroy.com",
        ];
        $this->actingAs($this->user)
            ->post(route('invite.save'), $postData)
            ->assertSessionHasErrors()
//            ->assertRedirect(route('invite.add'))
//            ->assertSessionHas('flash_notification.emails', 'danger')
            ->assertStatus(302);

        $errors = request()->session()->get('errors');
        $messages = $errors->getBag('default')->getMessages();
        $emailErrorMessage = array_shift($messages['emails']);

        $this->assertEquals('Following email address reachme@amitavroy.com already exists.', $emailErrorMessage);

        Mail::assertQueued(SendInvitationMail::class, 0);


    }

    /** @test */
    public function a_user_with_valid_token_can_register()
    {
        $this->get(route('register.invited', $this->invite->token))
            ->assertStatus(200);
    }

    /** @test */
    public function a_user_with_invalid_token_gets_error()
    {
        $this->get(route('register.invited', $this->invite->token . '3'))
            ->assertStatus(400);
    }

    /** @test */
    public function a_user_with_expired_token_should_see_error_message()
    {
        $invite = factory(Invite::class)->create([
            'expire_at' => Carbon::now()->subDays(10),
        ]);

        $this->get(route('register.invited', $invite->token))
            ->assertSee('The token has expired. You can request for a fresh invite.')
            ->assertStatus(400);
    }

    /** @test */
    public function guest_should_see_registration_form()
    {
        $invite = $this->invite;

        $this->get(route('register.invited', $invite->token))
            ->assertStatus(200)
            ->assertSee($invite->email);
    }

    /** @test */
    public function registration_without_data_should_show_errors()
    {
        $postData = [];

        $this->post(route('register.save'), $postData)
            ->assertSessionHasErrors(['name', 'password', 'c_password']);
    }

    /** @test */
    public function user_should_be_able_to_register_with_correct_data()
    {
        Mail::fake();

        $invite = factory(Invite::class)->create([
            'expire_at' => Carbon::now()->addDays(2),
        ]);

        $postData = [
            'name' => 'Be Heard',
            'password' => 'password1',
            'c_password' => 'password1'
        ];

        $this->withSession(['invite' => $invite->token])
            ->post(route('register.save'), $postData)
            ->assertRedirect(route('home'));

        Mail::assertQueued(RegistrationSuccessMail::class, 1);
    }
}
