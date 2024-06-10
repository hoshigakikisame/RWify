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
        'jumlah_bayar'
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

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'nik_pembayar', 'nik');
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
        $user = UserModel::where('nik', $this->nik_pembayar)->first();

        if ($user) {
            return $user->nama_depan . ' ' . $user->nama_belakang;
        } else {
            return 'Pembayar tidak ditemukan';
        }
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
        if ($this->pembayaranIuran) {
            return $this->pembayaranIuran->tanggal_bayar;
        } else {
            return $this->dibuat_pada;
        }
    }
    

    public function getIdPembayaranIuran(): int
    {
        return $this->id_pembayaran_iuran;
    }

    public function getJumlahBayar(): int
    {
        return $this->jumlah_bayar;
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

    public function setJumlahBayar(int $jumlah_bayar): void
    {
        $this->jumlah_bayar = $jumlah_bayar;
    }
}