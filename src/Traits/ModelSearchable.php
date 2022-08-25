<?php

namespace Kraify\Fastdev\Traits;

use Kraify\Fastdev\Services\Http\BaseFilter;

/**
 * @method static \Illuminate\Database\Eloquent\Builder|static::class filter(\Kraify\Fastdev\Services\Http\BaseFilter $filter)
 */
trait ModelSearchable
{
    public function scopeFilter($query, BaseFilter $filter)
    {
        return $filter->apply($query);
    }
}
