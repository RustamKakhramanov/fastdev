<?php


namespace Kraify\Fastdev\Traits;


trait AuthorizableCustomer
{
    public function canCustomer($ability)
    {
        return $this->customer->can($ability) || $this->can($ability);
    }
}
