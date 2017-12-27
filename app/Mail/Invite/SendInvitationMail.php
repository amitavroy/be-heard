<?php

namespace App\Mail\Invite;

use App\Models\Invite;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInvitationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    /**
     * @var Invite
     */
    public $invite;
    /**
     * @var User
     */
    public $user;

    public $data;

    /**
     * Create a new message instance.
     *
     * @param Invite $invite
     * @param User $user
     */
    public function __construct(Invite $invite, User $user)
    {
        $this->invite = $invite;
        $this->user = $user;
        $this->data = [
            'invite' => $this->invite,
            'user' => $this->user,
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Invitation to join')
            ->markdown('minimal.mails.invite.send-user-invite');
    }
}
