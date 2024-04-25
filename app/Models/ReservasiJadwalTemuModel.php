<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservasiJadwalTemuModel extends Model
{
    use HasFactory;
    protected $table = 'tb_reservasi_jadwal_temu';
    protected $primaryKey = 'id_reservasi_jadwal_temu';
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'id_reservasi_jadwal_temu',
        'nik_pemohon',
        'nik_penerima',
        'subjek',
        'pesan',
        'jadwal_temu',
        'status',
        'dibuat_pada',
        'diperbarui_pada'
    ];

    public static $searchable = [
        'subjek',
        'pesan'
    ];

    // relationships
    public function pemohon() {
        return $this->belongsTo(UserModel::class, 'nik_pemohon', 'nik');
    }

    public function penerima() {
        return $this->belongsTo(UserModel::class, 'nik_penerima', 'nik');
    }

    // GETTERS
    public function getIdReservasiJadwalTemu(): int {
        return $this->id_reservasi_jadwal_temu;
    }

    public function getNikPemohon(): string {
        return $this->nik_pemohon;
    }

    public function getNikPenerima(): string {
        return $this->nik_penerima;
    }

    public function getSubjek(): string {
        return $this->subjek;
    }

    public function getPesan(): string {
        return $this->pesan;
    }

    public function getJadwalTemu(): string {
        return $this->jadwal_temu;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getDibuatPada(): string {
        return $this->dibuat_pada;
    }

    public function getDiperbaruiPada(): string {
        return $this->diperbarui_pada;
    }
}