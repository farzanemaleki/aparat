<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'mobile' => '+98' . random_int(1111 , 9999). random_int(11111 , 99999),
        'email' => $faker->unique()->safeEmail,
        'type' => User::TYPE_USER,
        'verified_at' => now(),
        'verify_code' => null,
        'website' =>$faker->url,
        'password' => '$2y$10$CghSayCRtVJFsA1zkDog8uC7Pcew97Mtl6LDU6AVqL575GN5R5fKm', // password = 123456789
    ];
});
