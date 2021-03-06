<?php

use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

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

$factory->define(\App\Models\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
    ];
});

$factory->define(\App\Models\Conversation::class, function (Faker $faker) {
    $title = $faker->sentence(6);
    return [
        'title' => $title,
        'creator' => factory(\App\User::class)->create()->id,
        'slug' => str_slug($title),
        'body' => $faker->sentence(500),
        'expire_at' => Carbon::now()->addDays($faker->numberBetween(1,9)),
        'published' => 1,
        'sticky' => 0,
    ];
});

$factory->define(\App\Models\Comment::class, function (Faker $faker) {
    return [
        'body' =>  $faker->sentence(6),
        'commentable_id' => factory(\App\Models\Conversation::class)->create()->id,
        'commentable_type' => 'App\Models\Conversation',
        'user_id' => factory(\App\User::class)->create()->id
    ];
});