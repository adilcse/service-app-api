<?php

/**
 * @var \Illuminate\Database\Eloquent\Factory $factory 
 */

use App\Modal\Catagory;
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
    Catagory::class, function (Faker $faker) {
        return [
        'name' => $faker->name,
        'description' => $faker->email,
        'image'=>$faker->imageUrl,
        'status'=>"1"
        ];
    }
);
