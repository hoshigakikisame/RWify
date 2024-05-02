<?php

namespace App\Enums;

use ReflectionClass;

trait Enum
{
    public static function getValues(): array
    {
        return array_map(fn($v) => $v->value, (new ReflectionClass(static::class))->getConstants());
    }
}