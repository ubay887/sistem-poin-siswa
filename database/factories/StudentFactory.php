<?php

use App\Entities\Users\User;
use Faker\Generator as Faker;
use App\Entities\Students\Student;
use App\Entities\Classes\ClassName;

$factory->define(Student::class, function (Faker $faker) {

    return [
        'class_id'    => function () {
            return factory(ClassName::class)->create()->id;
        },
        'nis'         => $faker->word,
        'name'        => $faker->word,
        'pob'         => 'Kurau',
        'dob'         => '1989-09-09',
        'gender_id'   => 1,
        'religion_id' => 1,
        'address'     => $faker->sentence,
        'is_active'   => 1,
        'creator_id'  => function () {
            return factory(User::class)->create()->id;
        },
    ];
});
