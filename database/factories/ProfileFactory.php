<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(Model::class, function (Faker $faker) {
    return [
        'image'=>$faker->imageUrl($width = 640, $height = 480, $category = null, $randomize = true, $word = null, $gray = false),
        'hobbies'=>Str::random(10).",".Str::random(10),
        'dob'=>$faker->date("Y-m-d",$max='now')
    ];
});
