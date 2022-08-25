<?php

namespace Kraify\Fastdev\Traits;

trait Arrayable
{
    public function toArray(): array
    {

        return collect(get_object_vars($this))->toArray();
    }
}
