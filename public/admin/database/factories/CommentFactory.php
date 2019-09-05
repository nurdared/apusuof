<?php

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        "user_id" => factory('App\User')->create(),
        "body" => $faker->name,
        "commentable_id" => $faker->randomNumber(2),
        "commentable_type" => $faker->name,
    ];
});
