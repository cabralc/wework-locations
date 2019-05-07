<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Floor;
use Faker\Generator as Faker;

$factory->define(
    Floor::class,
    function (Faker $faker) {
        return [
            'number'      => $faker->randomNumber(5),
            'description' => $faker->sentence(1),
            'desks'       => $faker->randomNumber(5),
        ];
    }
);