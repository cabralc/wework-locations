<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Location;
use Faker\Generator as Faker;

$factory->define(
    Location::class,
    function (Faker $faker) {
        return [
            'name'         => $faker->streetName,
            'address'      => $faker->streetAddress,
            'opening_date' => $faker->dateTime(),
        ];
    }
);