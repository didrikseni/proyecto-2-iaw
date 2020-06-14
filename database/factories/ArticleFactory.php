<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'publication_date' => now(),
        'score' => $faker->randomFloat(2,0,5),
        'description' => $faker->sentence,
        'content' => $faker->paragraph,
        'user_id' => factory(\App\User::class)
    ];
});
