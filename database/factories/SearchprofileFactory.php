<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SearchProfile;
use Faker\Generator as Faker;

$factory->define(SearchProfile::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'propertyType' => $faker->md5(),
        'searchFields' => json_encode([ // Do not json_encode this as your model will handle the conversion
            "price" => $faker->numberBetween(0,2000000),
            "area" => $faker->numberBetween(150),
            "yearOfConstruction" => $faker->numberBetween(2010),
            "rooms" => $faker->numberBetween(4),
            "returnPotential" => $faker->randomFloat(1, 15)
        ])
    ];
});
