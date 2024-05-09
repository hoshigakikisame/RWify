<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranIuranModel extends Model {
    
    use HasFactory;
    protected $table = 'tb_pembayaran_iuran';
    protected $primaryKey = 'id_pembayaran_iuran';
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'id_pembayaran_iuran',
        'nik_pembayar',
        'nkk',
        'tanggal_bayar',
        'image_url',
        'keterangan',
        'dibuat_pada',
        'diperbarui_pada',
    ];

    public static $searchable = [
        'nkk',
        'nik_pembayar',
        'tanggal_bayar',
        'keterangan',
    ];

    // relationships
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'nik_pembayar', 'nik');
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

    public function getNkk(): string
    {
        return $this->nkk;
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

    public function getDibuatPada(): string
    {
        return $this->dibuat_pada;
    }

    public function getDiperbaruiPada(): string
    {
        return $this->diperbarui_pada;
    }

    public function getUser()
    {
        return $this->user;
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

    public function setNkk(string $nkk): void
    {
        $this->nkk = $nkk;
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