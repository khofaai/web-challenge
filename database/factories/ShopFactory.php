<?php

use Faker\Generator as Faker;

$factory->define(App\Shop::class, function (Faker $faker) {
    return [
        'shop_name' => $faker->name,
        'shop_latitude' => 31.7917,
        'shop_longitude' => -7.603869,
        'shop_longitude' => rand(0,200)
    ];
});