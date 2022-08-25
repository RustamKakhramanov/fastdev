<?php

namespace Kraify\Fastdev\Traits;

use ReflectionClass;

trait GetConstants
{
    public function getConstants($class = null)
    {
        return (new ReflectionClass($class ?: $this))->getConstants();
    }
}
