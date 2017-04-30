<?php

namespace App\Filters;

class MinyanFilters extends Filters
{
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [
        'day', 'month', 'year'
    ];

    /**
     * Filter minyanim by day.
     *
     * @param  string $day
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function day(string $day)
    {
        return $this->builder->whereDay('timestamp', $this->formatTwoDigits($day));
    }

    /**
     * Filter minyanim by month.
     *
     * @param  string $month
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function month(string $month)
    {
        return $this->builder->whereMonth('timestamp', $this->formatTwoDigits($month));
    }

    /**
     * Filter minyanim by year.
     *
     * @param  string $year
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function year(string $year)
    {
        return $this->builder->whereYear('timestamp', $year);
    }

    /**
     * Format a number to have a leading 0 if necessary.
     *
     * @param  string $month
     * @return string
     */
    private function formatTwoDigits(string $month)
    {
        return strlen($month) === 1 ? '0' . $month : $month;
    }
}
