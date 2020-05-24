<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->text(rand(32, 64)),
        'description' => $faker->text(rand(256, 512)),
        'stock' => rand(5, 25)

    ];
});
