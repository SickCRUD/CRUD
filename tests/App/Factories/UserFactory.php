<?php

namespace SickCRUD\CRUD\Tests\App\Factories;

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
// SickCRUD
use SickCRUD\CRUD\Tests\App\Models\User;

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
        'password' => Hash::make('secret'), // secret
        'remember_token' => str_random(10),
    ];
});