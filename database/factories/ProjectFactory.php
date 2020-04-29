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

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'survey_number' => Str::random(5),
        'programmer' => $faker->name(),
        'project_manager' => $faker->name(),
        'detail' => $faker->word(1),
        'info' => $faker->word(1),
        'status' => array_rand(array('Inaktiv'=>'Inaktiv', 'Aktiv' => 'Aktiv')),

    ];
});


