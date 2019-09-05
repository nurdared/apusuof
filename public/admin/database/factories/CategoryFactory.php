<?php

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        "category_name" => $faker->name,
        "category_body" => $faker->name,
        "user_id" => factory('App\User')->create(),
    ];
});
