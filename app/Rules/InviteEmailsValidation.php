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
            $emails = explode(",", $value);
            $records  = Invite::whereIn('email',$emails)->get();
            if (count($records) > 0) {
                return false;
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
