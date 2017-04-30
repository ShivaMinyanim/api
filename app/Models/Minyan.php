<?php

namespace App\Models;

use App\Filters\MinyanFilters;
use Illuminate\Database\Eloquent\Model;

class Minyan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'minyanim';

    /**
     * Apply all relevant thread filters.
     *
     * @param  Builder       $query
     * @param  ThreadFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, MinyanFilters $filters)
    {
        return $filters->apply($query);
    }
}
