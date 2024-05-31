<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTimeStamp;
use App\Interfaces\SearchCompatible;

class IuranModel extends Model implements SearchCompatible {
    
    use HasFactory, HasTimeStamp;
    protected $table = 'tb_iuran';
    protected $primaryKey = 'id_iuran';
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'id_iuran',
        'nik_pembayar',
        'bulan',
        'tahun',
        'dibuat_pada',
        'diperbarui_pada',
        'id_pembayaran_iuran',
    ];

    public static function searchable(): array
    {
        return [
            'nik_pembayar',
            'bulan',
            'tahun',
        ];
    }

    public static function filterable(): array {
        return [
            'nik_pembayar',
            'bulan',
            'tahun',
        ];
    }

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

    public function getNikPembayar(): string
    {
        return $this->nik_pembayar;
    }

    public function getNamaPembayar(): string
    {
        return $this->pembayaranIuran->user->nama_depan . ' ' . $this->pembayaranIuran->user->nama_belakang;
    }

    public function getBulan(): string
    {
        return $this->bulan;
    }

    public function getTahun(): string
    {
        return $this->tahun;
    }

    public function getTanggalBayar(): string
    {
        return $this->pembayaranIuran->tanggal_bayar;
    }

    public function getIdPembayaranIuran(): int
    {
        return $this->id_pembayaran_iuran;
    }

    public static function getBulanOptions()
    {
        return [
            'Januari' => 'Januari',
            'Februari' => 'Februari',
            'Maret' => 'Maret',
            'April' => 'April',
            'Mei' => 'Mei',
            'Juni'  => 'Juni',
            'Juli' => 'Juli',
            'Agustus' => 'Agustus',
            'September' => 'September',
            'Oktober' => 'Oktober',
            'November' => 'November',
            'Desember' => 'Desember',
        ];
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

    public function setNikPembayar(string $nik): void
    {
        $this->nik_pembayar = $nik;
    }
}