<?php

namespace Kraify\Fastdev\Traits\Enumiration;

use Kraify\Fastdev\Traits\Enumiration\EnumArrayable;
use Kraify\Fastdev\Traits\Enumiration\EnumProperties;



trait FullEnum
{
    use EnumArrayable, EnumProperties, EqualEnum, FromEnum;
}
