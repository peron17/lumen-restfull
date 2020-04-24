<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Post;
use App\User;
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

$factory->define(Post::class, function(Faker $faker){
    return [
        'title' => $faker->sentence(4),
        'content' => $faker->paragraph(4),
        'user_id' => rand(1, 10)
    ];
});

$factory->define(Comment::class, function(Faker $faker){
    return [
        'comment' => $faker->paragraph(1),
        'post_id' => rand(1, 50),
        'user_id' => rand(1, 10)
    ];
});

$factory->define(User::class, function (Faker $faker) {

    $hasher = app()->make('hash');

    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => $hasher->make("secret")
    ];
});
