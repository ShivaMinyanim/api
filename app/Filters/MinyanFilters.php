<?php

namespace App\Filters;

class MinyanFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['year'];

    /**
     * Filter minyanim by year.
     *
     * @param  string $year
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function year($year)
    {
        return $this->builder->whereYear('timestamp', $year);
    }
}
