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
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('123'), // password
        'remember_token' => Str::random(10),
        'address' => $faker->address,
        'province_id' => 31,
        'regency_id' => 3173,
        'district_id' => 3173040,
        'village_id' =>  3173040003,
        'zip_code' => mt_rand(00000,99999),
        'position'=> $faker->randomElement(['Wirausaha','Karyawan Negeri','Karyawan Swasta','Buruh' ,'Pelajar']),
        'mobile_number' => $faker->phoneNumber,
    ];
});
