<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'nome' => $faker->word,
        'mensalidade' => $faker->randomFloat(2, 0, 999.99),
        'valor_matricula' => $faker->randomFloat(2, 0, 9999.99),
        'periodo' => $faker->randomElement([ 'matutino', 'vespertino', 'noturno' ]),
        'duracao' => $faker->randomDigitNotNull,
    ];
});
