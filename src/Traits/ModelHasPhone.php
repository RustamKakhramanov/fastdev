<?php

namespace Kraify\Fastdev\Traits;

use Illuminate\Database\Eloquent\Model;
/**
 * @property int|null $phone
 * @method static \Illuminate\Database\Eloquent\Builder|\Kraify\Fastdev\User wherePhone($value)
 */
trait ModelHasPhone
{
    public static function findByPhone(int $number): ?Model
    {
        return static::wherePhone($number)->first();
    }
    
    public function hasVerifiedPhone()
    {
        return !is_null($this->phone_verified_at);
    }
}
