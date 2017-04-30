<?php

/**
 * Create a collection of models and persist them to
 * the database for testing.
 *
 * @param  string $class
 * @param  array|null  $attributes
 * @param  int|null $times
 * @return mixed
 */
function create(string $class, array $attributes = [], int $times = null)
{
    return factory($class, $times)->create($attributes);
}

/**
 * Create a collection on Minyan models with a specific date
 * and persist them to the database for testing.
 *
 * @param  string $date
 * @param  int    $times
 * @return mixed
 */
function createMinyanWithDate(string $date, int $times)
{
    return create(\App\Models\Minyan::class, ['timestamp' => Carbon\Carbon::parse($date)], $times);
}
