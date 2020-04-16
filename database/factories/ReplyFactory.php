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

$factory->define(App\Reply::class, function (Faker $faker) {
    return [
        'thread_id' => factory(App\Thread::class),
        'user_id' => factory(App\User::class),
        'body' => $faker->paragraph
    ];
});
