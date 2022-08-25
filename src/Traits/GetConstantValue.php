<?php

namespace Kraify\Fastdev\Traits;

use Kraify\Fastdev\Traits\FromEnum;
use Kraify\Fastdev\Traits\EnumArrayable;


trait GetConstantValue
{
    use FromEnum;

    public static function fromStr(string $str)
    {
        return strtolower(static::tryFrom($str)->name ?? $str);
    }

}
