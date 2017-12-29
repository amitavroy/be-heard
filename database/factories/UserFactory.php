<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'active' => 1,
    ];
});

$factory->define(\App\Models\Invite::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'user_id' => factory(\App\User::class)->create()->id,
        'token' => uniqid('invite'),
        'expire_at' => \Carbon\Carbon::now()->addDays(7),
        'used' => 0,
    ];
});

$factory->define(\App\Conversation::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(6),
        'creator' => factory(\App\User::class)->create()->id,
        'body' => $faker->sentence(20),
        'expire_at' => \Illuminate\Support\Carbon::now()->addDays($faker->randomNumber()),
        'published' => 1,
        'sticky' => 0,
    ];
});