<?php

namespace App\Enums;

enum ReservasiJadwalTamuStatusEnum: string {
    case pending = 'pending';
    case diterima = 'diterima';
    case ditolak = 'ditolak';

    public static function getValues(): array {
        return [
            self::pending->value,
            self::diterima->value,
            self::ditolak->value
        ];
    }
}