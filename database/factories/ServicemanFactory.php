<?php

/**
 * @var \Illuminate\Database\Eloquent\Factory $factory 
 */

use App\Modal\Serviceman;
use Faker\Generator as Faker;

/**
 * Given a $centre (latitude, longitude) co-ordinates and a
 * distance $radius (miles), returns a random point (latitude,longtitude)
 * which is within $radius miles of $centre.
 *
 * @param  array $centre Numeric array of floats. First element is 
 *                       latitude, second is longitude.
 * @param  float $radius The radius (in miles).
 * @return array         Numeric array of floats (lat/lng). First 
 *                       element is latitude, second is longitude.
 */
function generate_random_point( $centre, $radius )
{

    $radius_earth = 6371; //km

    //Pick random distance within $distance;
    $distance = lcg_value()*$radius;

    //Convert degrees to radians.
    $centre_rads = array_map('deg2rad', $centre);

    //First suppose our point is the north pole.
    //Find a random point $distance miles away
    $lat_rads = (pi()/2) -  $distance/$radius_earth;
    $lng_rads = lcg_value()*2*pi();


    //($lat_rads,$lng_rads) is a point on the circle which is
    //$distance miles from the north pole. Convert to Cartesian
    $x1 = cos($lat_rads) * sin($lng_rads);
    $y1 = cos($lat_rads) * cos($lng_rads);
    $z1 = sin($lat_rads);


    //Rotate that sphere so that the north pole is now at $centre.

    //Rotate in x axis by $rot = (pi()/2) - $centre_rads[0];
    $rot = (pi()/2) - $centre_rads[0];
    $x2 = $x1;
    $y2 = $y1 * cos($rot) + $z1 * sin($rot);
    $z2 = -$y1 * sin($rot) + $z1 * cos($rot);

    //Rotate in z axis by $rot = $centre_rads[1]
    $rot = $centre_rads[1];
    $x3 = $x2 * cos($rot) + $y2 * sin($rot);
    $y3 = -$x2 * sin($rot) + $y2 * cos($rot);
    $z3 = $z2;


    //Finally convert this point to polar co-ords
    $lng_rads = atan2($x3, $y3);
    $lat_rads = asin($z3);

    return array_map('rad2deg', array( $lat_rads, $lng_rads ));
}



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
    Serviceman::class, function (Faker $faker) {
        $location=generate_random_point([22.260424,84.853584], rand(0, 1000));
        return [
        'name' => $faker->name,
        'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'image'=>$faker->imageUrl,
        'status'=>$faker->randomDigit,
        'mobile'=>$faker->e164PhoneNumber,
        'email'=>$faker->email,
        'latitude'=>$location[0],
        'longitude'=>$location[1],
        'address'=>$faker->address,
        'price'=>rand(100, 10000)
        ];
    }
);
