<?php

use App\User;

if (!function_exists('user_pic'))
{
    function user_pic(User $user)
    {
        return ucfirst(substr($user->name, 0, 1));
    }
}