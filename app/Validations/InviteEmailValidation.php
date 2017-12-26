<?php

use App\Models\Invite;
use Illuminate\Contracts\Validation\Rule;

class InviteEmailValidation implements Rule
{
    public function passes($attribute, $value)
    {
        $emails = explode(",", $value);
        foreach ($emails as $email) {
            $found = Invite::where('email', '=', $email)->first();
            if ($found) {
                return 0;
            }
        }
        return 1;
    }

    public function message()
    {
        return ':attribute invite already present';
    }
}