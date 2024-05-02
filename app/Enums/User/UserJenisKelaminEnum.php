<?php

namespace App\Enums\User;

use App\Enums\Enum;

enum UserJenisKelaminEnum: string {
    use Enum;
    case LAKI_LAKI = 'Laki-laki';
    case PEREMPUAN = 'Perempuan';
}
