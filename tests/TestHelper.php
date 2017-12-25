<?php

namespace Tests;


use App\User;

trait TestHelper
{
    public function getActiveUser()
    {
        return factory(User::class)->create([
            'email' => 'reachme@amitavroy.com',
            'password' => bcrypt('password'),
            'active' => 1,
        ]);
    }
}