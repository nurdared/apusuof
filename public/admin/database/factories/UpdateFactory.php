<?php

$factory->define(App\Update::class, function (Faker\Generator $faker) {
    return [
        "update_title" => $faker->name,
        "update_body" => $faker->name,
        "user_id" => factory('App\User')->create(),
        "club_id" => factory('App\Club')->create(),
    ];
});
