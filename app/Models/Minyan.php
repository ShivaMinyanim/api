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
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['house'];

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

    /**
     * A minyan takes place in a shiva house.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function house()
    {
        return $this->belongsTo(House::class);
    }
}
