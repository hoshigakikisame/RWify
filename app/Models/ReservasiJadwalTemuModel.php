<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTimeStamp;
use App\Interfaces\SearchCompatible;

class ReservasiJadwalTemuModel extends Model implements SearchCompatible
{
    use HasFactory, HasTimeStamp;
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

    public static function searchable(): array
    {
        return [
            'subjek',
            'pesan'
        ];
    }

    public static function filterable(): array
    {
        return [
            'nik_pemohon',
            'nik_penerima',
            'status'
        ];
    }

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

    public function getPemohon() {
        return $this->pemohon;
    }

    public function getPenerima() {
        return $this->penerima;
    }

    public function getNamaPemohon(): string
    {
        return $this->pemohon->nama_depan . ' ' . $this->pemohon->nama_belakang;
    }

    public function getNamaPenerima(): string
    {
        return $this->penerima->nama_depan . ' ' . $this->penerima->nama_belakang;
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

    public function getJadwalTemu() {
        return Carbon::parse($this->jadwal_temu);
    }

    public function getStatus(): string {
        return $this->status;
    }

    // SETTERS
    public function setIdReservasiJadwalTemu(int $id_reservasi_jadwal_temu): void {
        $this->id_reservasi_jadwal_temu = $id_reservasi_jadwal_temu;
    }

    public function setNikPemohon(string $nik_pemohon): void {
        $this->nik_pemohon = $nik_pemohon;
    }

    public function setNikPenerima(string $nik_penerima): void {
        $this->nik_penerima = $nik_penerima;
    }

    public function setSubjek(string $subjek): void {
        $this->subjek = $subjek;
    }

    public function setPesan(string $pesan): void {
        $this->pesan = $pesan;
    }

    public function setJadwalTemu(string $jadwal_temu): void {
        $this->jadwal_temu = $jadwal_temu;
    }

    public function setStatus(string $status): void {
        $this->status = $status;
    }
}