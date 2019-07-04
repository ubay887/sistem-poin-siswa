<?php

use App\User;
use App\ClassName;
use Faker\Generator as Faker;

$factory->define(ClassName::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'creator_id' => function () {
            return factory(User::class)->create()->id;
        },
    ];
});
