<?php

namespace Kraify\Fastdev\Enums;

use Kraify\Fastdev\Traits\Enumiration\FullEnum;

enum UserRolesEnum:string
{   
    use FullEnum;

    case Superadmin = 'superadmin';
    case Client = 'client';
    case Customer = 'customer';
    case User = 'user';
    case Manager = 'manager';
    case Guest = 'guest';

    public  function getPermissions(){
        return match ($this) {
            static::Superadmin => ['superadmin', 'impersonate'],
            static::Manager =>  [],
            static::Client =>  [],
            static::Customer =>  [],
            static::User =>  [],
            static::Guest =>  [],
        };
    }
}
