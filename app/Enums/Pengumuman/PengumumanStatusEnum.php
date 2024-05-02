<?php

namespace App\Enums\Pengumuman;

use App\Enums\Enum;

enum PengumumanStatusEnum: string {
    use Enum;
    
    case DRAFT = 'draft';
    case PUBLISH = 'publish'; 
}