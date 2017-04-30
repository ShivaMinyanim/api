<?php

namespace App\Filters;

class MinyanFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = ['year', 'month'];

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

    /**
     * Filter minyanim by month.
     *
     * @param  string $month
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function month($month)
    {
        return $this->builder->whereMonth('timestamp', $this->formatMonth($month));
    }

    /**
     * Format a month to have a leading 0 if necessary.
     *
     * @param  string $month
     * @return string
     */
    private function formatMonth($month)
    {
        return strlen($month) === 1 ? '0' . $month : $month;
    }
}
