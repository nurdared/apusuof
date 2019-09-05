<?php

$factory->define(App\Club::class, function (Faker\Generator $faker) {
    return [
        "club_name" => $faker->name,
        "club_description" => $faker->name,
        "club_timetable" => $faker->name,
        "user_id" => factory('App\User')->create(),
        "category_id" => factory('App\Category')->create(),
    ];
});
