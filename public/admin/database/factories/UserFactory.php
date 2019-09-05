<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "email" => $faker->safeEmail,
        "password" => str_random(10),
        "role_id" => factory('App\Role')->create(),
        "remember_token" => $faker->name,
        "username" => $faker->name,
        "avatar" => $faker->name,
        "type" => $faker->name,
        "contact" => $faker->randomNumber(2),
        "age" => $faker->date("Y-m-d", $max = 'now'),
    ];
});
