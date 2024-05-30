<?php

namespace App\Interfaces;

interface SearchCompatible {
    public static function searchable(): array;
    public static function filterable(): array;
}