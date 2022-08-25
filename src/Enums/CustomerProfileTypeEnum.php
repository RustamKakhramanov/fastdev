<?php


namespace Kraify\Fastdev\Enums;

use Kraify\Fastdev\Traits\Enumiration\FullEnum;
use MyCLabs\Enum\Enum;
/**
 * @method static CustomerProfileTypeEnum PERSONAL()
 * @method static CustomerProfileTypeEnum CORPORATE()
 */
enum CustomerProfileTypeEnum 
{
    use FullEnum;
    
    private const PERSONAL = 'personal';
    private const CORPORATE = 'corporate';
}
