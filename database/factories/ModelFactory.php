<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/**
 * User factory.
 */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/**
 * Minyan factory.
 */
$factory->define(App\Models\Minyan::class, function (Faker\Generator $faker) {
    return [
        'type' => $faker->randomElement(['shacharis', 'mincha', 'mincha/maariv', 'maariv']),
        'timestamp' => $faker->dateTime->format('Y-m-d H:i:s'),
        'house_id' => function () {
            return factory(App\Models\House::class)->create()->id;
        }
    ];
});

/**
 * House factory.
 */
$factory->define(App\Models\House::class, function (Faker\Generator $faker) {
    return [
        'street' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->stateAbbr
    ];
});
