<?php

namespace App\Enums\Pengaduan;

use App\Enums\Enum;

enum PengaduanStatusEnum: string {
    use Enum;
    
    case BARU = 'baru';
    case INVALID = 'invalid';
    case DIPROSES = 'diproses';
    case SELESAI = 'selesai';
}