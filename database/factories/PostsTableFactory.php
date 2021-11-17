<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;



$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(10),
        'body' => $faker->realText(50),
        'created_at' => $faker->date('Y-m-d H:i:s', 'now'),
        'updated_at' => $faker->date('Y-m-d H:i:s', 'now'),
        'deleted_at' => null,
        'user_id' => 1
    ];
});
