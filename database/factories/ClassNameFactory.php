<?php

use App\Entities\Users\User;
use Faker\Generator as Faker;
use App\Entities\Classes\ClassName;

$factory->define(ClassName::class, function (Faker $faker) {

    return [
        'level_id'    => 11,
        'name'        => 'IPA',
        'description' => $faker->sentence,
        'creator_id'  => function () {
            return factory(User::class)->create()->id;
        },
    ];
});
