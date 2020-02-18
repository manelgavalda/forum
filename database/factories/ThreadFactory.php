<?php

use Illuminate\Support\Str;
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

$factory->define(App\Thread::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'user_id' => factory(App\User::class)->create(),
        'channel_id' => factory(App\Channel::class)->create(),
        'title' => $title,
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'visits' => 0,
        'slug' => Str::slug($title),
        'locked' => false
    ];
});
