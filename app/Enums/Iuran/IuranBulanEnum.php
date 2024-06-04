<?php

namespace App\Enums\Iuran;

use App\Enums\Enum;

enum IuranBulanEnum: string {
    use Enum;
    case JANUARI = 'Januari';
    case FEBRUARI = 'Februari';
    case MARET = 'Maret';
    case APRIL = 'April';
    case MEI = 'Mei';
    case JUNI = 'Juni';
    case JULI = 'Juli';
    case AGUSTUS = 'Agustus';
    case SEPTEMBER = 'September';
    case OKTOBER = 'Oktober';
    case NOVEMBER = 'November';
    case DESEMBER = 'Desember';
}
