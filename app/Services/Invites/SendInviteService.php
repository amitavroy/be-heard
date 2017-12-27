<?php

namespace App\Service\Invites;

use App\Mail\Invite\SendInvitationMail;
use App\Models\Invite;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendInviteService
{
    public function sendInvites(array $emails)
    {
        foreach ($emails as $email) {
            $this->dispatch($email);
        }

        return true;
    }

    private function dispatch($email)
    {
        $expireDays = config('bh.invite-token-expire');

        $invite = Invite::create([
            'user_id' => Auth::user()->id,
            'email' => $email,
            'token' => uniqid('invite_'),
            'expire_at' => Carbon::now()->addDays($expireDays),
            'used' => 0,
        ]);

        $user = Auth::user();

        Mail::to($email)->queue(new SendInvitationMail($invite, $user, $email));
    }
}
