<?php

namespace App\Enums\ReservasiJadwalTemu;

use App\Enums\Enum;

enum ReservasiJadwalTemuStatusEnum: string {
    use Enum;
    
    case PENDING = 'pending';
    case DITERIMA = 'diterima';
    case DITOLAK = 'ditolak';
}