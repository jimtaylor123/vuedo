<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Todo;
use Faker\Generator as Faker;

$factory->define(Todo::class, function (Faker $faker) {

    $tasks = [
        'Clean the bath',
        'Iron the shirts',
        'Feed the dog',
        'Pair the socks',
        'Wash the dishes',
        'Dry the washing',
        'Do the shopping',
        'Make the bed',
        'Call the doctor',
        'Fax the lawyer',
        'Pay the bills',
        'Organise the kitchen',
        'Sort desk papers'
    ];

    return [
        'description' => $faker->randomElement($tasks),
        'complete' => $faker->boolean,
        'due_by' => $faker->optional()->dateTimeBetween('-1 week', '+1 week')
    ];
});
