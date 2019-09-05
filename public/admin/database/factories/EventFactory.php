<?php

$factory->define(App\Event::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "event_date" => $faker->date("Y-m-d H:i:s", $max = 'now'),
        "description" => $faker->name,
        "location" => $faker->name,
        "information" => $faker->name,
        "quantity" => $faker->randomNumber(2),
    ];
});
