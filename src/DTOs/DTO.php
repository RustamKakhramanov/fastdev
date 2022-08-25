<?php

namespace Kraify\Fastdev\DTOs;

use JsonSerializable;
use Kraify\Fastdev\Traits\Arrayable;
use Kraify\Fastdev\Traits\RoundAble;

 class DTO implements JsonSerializable
{
    use Arrayable;
    use RoundAble;
    
    public function __get($name)
    {
        return isset($this->$name)
            ? $this->$name
            : null;
    }

    public function __construct($properties = [])
    {
        if($properties instanceof Arrayable) {
            $properties = $properties->toArray();
        }

        foreach ($properties as $property => $value) {
            if (property_exists(static::class, $property)) {
                $this->$property = $value;
            }
        }

        if(method_exists(static::class, 'init')){
            $this->init($properties);
        }
    }

    public function jsonSerialize()
    {
        return json_encode(get_object_vars($this));
    }

    public static function make($properties = []){
        return new static($properties);
    }

}
