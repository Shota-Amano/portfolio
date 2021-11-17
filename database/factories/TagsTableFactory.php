<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'created_at' => now(),
        'updated_at' => now(),
        'name' => $faker->word
    ];
});
