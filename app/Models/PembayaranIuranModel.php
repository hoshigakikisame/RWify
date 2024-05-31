<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTimeStamp;
use App\Interfaces\SearchCompatible;

class PembayaranIuranModel extends Model implements SearchCompatible
{

    use HasFactory, HasTimeStamp;
    protected $table = 'tb_pembayaran_iuran';
    protected $primaryKey = 'id_pembayaran_iuran';
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'id_pembayaran_iuran',
        'nik_pembayar',
        'tanggal_bayar',
        'image_url',
        'keterangan',
        'dibuat_pada',
        'diperbarui_pada',
    ];

    public static function searchable(): array
    {
        return [
            'nik_pembayar',
            'tanggal_bayar',
        ];
    }

    public static function filterable(): array {
        return [
            'nik_pembayar',
            'tanggal_bayar',
        ];
    }

    // relationships
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'nik_pembayar', 'nik');
    }

    public function iuran()
    {
        return $this->hasMany(IuranModel::class, 'id_pembayaran_iuran', 'id_pembayaran_iuran');
    }

    // GETTERS
    public function getIdPembayaranIuran(): int
    {
        return $this->id_pembayaran_iuran;
    }

    public function getNikPembayar(): string
    {
        return $this->nik_pembayar;
    }

    public function getNamaPembayar(): string
    {
        return $this->user->nama_depan . ' ' . $this->user->nama_belakang;
    }

    public function getTanggalBayar(): string
    {
        return $this->tanggal_bayar;
    }

    public function getImageUrl(): string
    {
        return $this->image_url;
    }

    public function getKeterangan(): string
    {
        return $this->keterangan;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getVerifiedCount(): int
    {
        return IuranModel::where('id_pembayaran_iuran', $this->id_pembayaran_iuran)->count();
    }

    // SETTERS
    public function setIdPembayaranIuran(int $id_pembayaran_iuran): void
    {
        $this->id_pembayaran_iuran = $id_pembayaran_iuran;
    }

    public function setNikPembayar(string $nik): void
    {
        $this->nik_pembayar = $nik;
    }

    public function setTanggalBayar(string $tanggal_bayar): void
    {
        $this->tanggal_bayar = $tanggal_bayar;
    }

    public function setImageUrl(string $image_url): void
    {
        $this->image_url = $image_url;
    }

    public function setKeterangan(string $keterangan): void
    {
        $this->keterangan = $keterangan;
    }
}
