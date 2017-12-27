<?php

namespace App\Rules;

use App\Models\Invite;
use Illuminate\Contracts\Validation\Rule;

class InviteEmailsValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        if (isset($value)) {
            \Log::info("in if");
            \Log::info($value);
            $emails = explode(",", $value);
            \Log::info($emails);
            foreach ($emails as $email) {
                $found = Invite::where('email', '=', $email)->first();
                \Log::info($found);
                if ($found) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute invite already present';
    }
}