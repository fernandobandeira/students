<?php

use Faker\Generator as Faker;

$factory->define(App\Student::class, function (Faker $faker) {
    return [
        'nome'       => $faker->name,
        'nascimento' => $faker->date,
        'telefone'   => $faker->phone,
        'cpf'        => $faker->cpf(true),
        'rg'         => $faker->rg(true),
    ];
});
