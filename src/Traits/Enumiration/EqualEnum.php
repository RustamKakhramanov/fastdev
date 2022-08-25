<?php

namespace Kraify\Fastdev\Traits\Enumiration;

trait EqualEnum
{
    public function equals($enum ) {
        return $this->value === $enum->value;
    }
}
