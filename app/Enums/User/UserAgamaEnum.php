<?php

namespace App\Enums\User;

use App\Enums\Enum;

enum UserAgamaEnum: string {
    use Enum;
    case ISLAM = 'Islam';
    case KRISTEN = 'Kristen';
    case KATOLIK = 'Katolik';
    case HINDU = 'Hindu';
    case BUDHA = 'Budha';
    case KONGHUCU = 'Konghucu';
}
