<?php

/** @var Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
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
        'programmer' => array_rand(config('employees.programmer')),
        'project_manager' => array_rand(config('employees.project_manager')),
        'detail' => $faker->word(1),
        'feldstart' => $faker->date(),
        'status' => array_rand(array('Kick-Off'=>'Kick-Off', 'Programmierung' => 'Programmierung', 'TL bei PL' => 'TL bei PL', 'Im Feld' => 'Im Feld')),

    ];
});


