<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTimeStamp;

class IuranModel extends Model {
    
    use HasFactory, HasTimeStamp;
    protected $table = 'tb_iuran';
    protected $primaryKey = 'id_iuran';
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'id_iuran',
        'bulan',
        'tahun',
        'dibuat_pada',
        'diperbarui_pada',
        'id_pembayaran_iuran',
    ];

    public static $searchable = [
        'bulan',
        'tahun',
    ];

    // relationships
    public function pembayaranIuran()
    {
        return $this->belongsTo(PembayaranIuranModel::class, 'id_pembayaran_iuran', 'id_pembayaran_iuran');
    }

    // GETTERS
    public function getIdIuran(): int
    {
        return $this->id_iuran;
    }

    public function getBulan(): string
    {
        return $this->bulan;
    }

    public function getTahun(): string
    {
        return $this->tahun;
    }

    public function getIdPembayaranIuran(): int
    {
        return $this->id_pembayaran_iuran;
    }

    // SETTERS
    public function setBulan(string $bulan): void
    {
        $this->bulan = $bulan;
    }

    public function setTahun(string $tahun): void
    {
        $this->tahun = $tahun;
    }

    public function setIdPembayaranIuran(int $id_pembayaran_iuran): void
    {
        $this->id_pembayaran_iuran = $id_pembayaran_iuran;
    }
}