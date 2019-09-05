<?php

$factory->define(App\Volunteer::class, function (Faker\Generator $faker) {
    return [
        "event_id" => factory('App\Event')->create(),
        "user_id" => factory('App\User')->create(),
        "sent_at" => $faker->date("Y-m-d H:i:s", $max = 'now'),
        "approved_at" => $faker->date("Y-m-d H:i:s", $max = 'now'),
    ];
});
