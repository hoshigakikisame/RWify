<?php

namespace App\Enums\User;

use App\Enums\Enum;

enum UserStatusPerkawinanEnum: string {
    use Enum;
    case BELUM_KAWIN = 'Belum Kawin';
    case KAWIN = 'Kawin';
    case CERAI_HIDUP = 'Cerai Hidup';
    case CERAI_MATI = 'Cerai Mati';
}
