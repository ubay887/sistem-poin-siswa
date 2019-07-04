<?php

use App\User;
use App\School;
use Faker\Generator as Faker;

$factory->define(School::class, function (Faker $faker) {

    return [
        'name'        => $faker->word,
        'address'     => $faker->word,
        'district'    => $faker->word,
        'province'    => $faker->word,
        'description' => $faker->sentence,
        'creator_id'  => function () {
            return factory(User::class)->create()->id;
        },
    ];
});
