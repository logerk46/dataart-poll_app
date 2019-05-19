<?php

use App\Poll;
use Faker\Generator as Faker;

$factory->define(Poll::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(1),
        'description' => $faker->sentence(4),
        'user_id' => factory(App\User::class)
    ];
});
