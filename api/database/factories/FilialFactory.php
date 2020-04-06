<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Filial;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Filial::class, function (Faker $faker) {
    return [
        'title' => $faker->streetName,
        'phone' => $faker->phoneNumber,
        'rua' => $faker->streetName,
        'bairro' => $faker->country,
        'numero' => $faker->buildingNumber, 
        'cidade' => $faker->city,
        'uf' => $faker->stateAbbr,
        'país' => $faker->country,
        'cep' => $faker->postcode,
        'complemento' => $faker->secondaryAddress,
        'referencia' => $faker->sentence($nbWords = 6, $variableNbWords = true)
    ];
});
