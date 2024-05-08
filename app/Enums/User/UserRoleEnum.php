<?php

namespace App\Enums\User;

use App\Enums\Enum;

enum UserRoleEnum: string {
    use Enum;
    case KETUA_RUKUN_WARGA = 'Ketua Rukun Warga';
    case KETUA_RUKUN_TETANGGA = 'Ketua Rukun Tetangga';
    case WARGA = 'Warga';
    case PETUGAS_KEAMANAN = 'Petugas Keamanan';
}
