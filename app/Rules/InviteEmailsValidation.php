<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;

class InviteEmailsValidation implements Rule
{
    private $emails = [];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        if (isset($value)) {
            $emails = explode(PHP_EOL, $value);

            foreach ($emails as $key => $email) {
                $emails[$key] = preg_replace("/\r|\n/", "", $email);
            }

            $records = User::whereIn('email', $emails)->get();

            foreach ($records as $key => $value) {
                $this->emails[] = $value->email;
            }

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
        $string = implode(', ', $this->emails);
        return "Following email address {$string} already exists.";
    }
}
