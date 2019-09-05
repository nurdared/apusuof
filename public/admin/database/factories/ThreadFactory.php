<?php

$factory->define(App\Thread::class, function (Faker\Generator $faker) {
    return [
        "subject" => $faker->name,
        "thread" => $faker->name,
        "type" => $faker->name,
        "solution" => $faker->randomNumber(2),
        "user_id" => factory('App\User')->create(),
    ];
});
