<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ContactResponses;
use Faker\Generator as Faker;

$factory->define(App\ContactResponses::class, function (Faker $faker) {
    return [
        'Name' => $faker->name,
        'Email' => $faker->unique()->safeEmail,
        'Subject' => $faker->sentence, // password
        'Message' => "this is a random message",
    ];
});
