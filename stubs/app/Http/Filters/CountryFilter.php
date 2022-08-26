<?php


namespace App\Http\Filters;

use Kraify\Fastdev\Services\Http\BaseFilter;

class CountryFilter extends BaseFilter
{
    protected $filters = ['name'];

    protected function name($name)
    {
        return $this->builder->where('name', 'ilike', "{$name}%");
    }
}
