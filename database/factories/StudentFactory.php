<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'class' => $faker->numberBetween($min = 5, $max =15),
        'email'=>$faker->unique()->safeEmail,
        'phone'=>$faker->phoneNumber
    ];
});
