<?php

/**
 * @var \Illuminate\Database\Eloquent\Factory $factory 
 */

use App\Modal\Slider;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(
    Slider::class, function (Faker $faker) {
        return [
        'head' => $faker->name,
        'para' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'image'=>$faker->imageUrl($width = 640, $height = 480),
        ];
    }
);
