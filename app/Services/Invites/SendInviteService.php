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
        try {
            foreach ($emails as $email) {
                $this->dispatch($email);
            }
        } catch (\Exception $exception) {
            logger($exception->getMessage());
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

        Mail::to($email)->queue(new SendInvitationMail($invite, $email));
    }
}
