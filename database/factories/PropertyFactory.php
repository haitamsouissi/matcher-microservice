<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Property;
use Faker\Generator as Faker;

$factory->define(Property::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'address' => $faker->Address(),
        'propertyType' => $faker->md5(),
        'fields' => json_encode([ // Do not json_encode this as your model will handle the conversion
            "area" => $faker->numberBetween(1,400),
            "yearOfConstruction" => $faker->numberBetween(1800,2022),
            "rooms" => $faker->numberBetween(1,50),
            "heatingType" => $faker->randomElement(['gas', 'electric',null]),
            "parking" => $faker->randomElement([true,false]),
            "returnActual" => $faker->randomFloat(1, 0, 100),
            "rent" => $faker->numberBetween(1,100000),
            "price" => $faker->numberBetween(0,10000000),
        ])
    ];
});
