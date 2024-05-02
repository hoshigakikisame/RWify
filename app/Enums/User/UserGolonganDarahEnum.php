<?php

namespace App\Enums\User;

use App\Enums\Enum;

enum UserGolonganDarahEnum: string {
    use Enum;
    case A = 'A';
    case B = 'B';
    case AB = 'AB';
    case O = 'O';
}
