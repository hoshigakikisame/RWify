<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTimeStamp;

class UmkmModel extends Model
{
    use HasFactory, HasTimeStamp;
    protected $table = 'tb_umkm';
    protected $primaryKey = 'id_umkm';
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'id_umkm',
        'nama',
        'image_url',
        'nama_pemilik',
        'alamat',
        'map_url',
        'telepon',
        'instagram_url',
        'deskripsi',
        'dibuat_pada',
        'diperbarui_pada'
    ];

    public static $searchable = [
        'nama',
        'nama_pemilik',
        'alamat',
        'telepon',
        'instagram_url',
        'deskripsi'
    ];

    // relationships

    // GETTERS
    public function getIdUmkm(): int {
        return $this->id_umkm;
    }

    public function getNama(): string {
        return $this->nama;
    }

    public function getImageUrl(): string {
        return $this->image_url;
    }

    public function getNamaPemilik(): string {
        return $this->nama_pemilik;
    }

    public function getAlamat(): string {
        return $this->alamat;
    }

    public function getMapUrl(): string {
        return $this->map_url;
    }

    public function getTelepon(): string {
        return $this->telepon;
    }

    public function getInstagramUrl(): string {
        return $this->instagram_url;
    }

    public function getDeskripsi(): string {
        return $this->deskripsi;
    }


    // SETTERS
    public function setIdUmkm(int $id_umkm): void {
        $this->id_umkm = $id_umkm;
    }

    public function setNama(string $nama): void {
        $this->nama = $nama;
    }

    public function setImageUrl(string $image_url): void {
        $this->image_url = $image_url;
    }

    public function setNamaPemilik(string $nama_pemilik): void {
        $this->nama_pemilik = $nama_pemilik;
    }

    public function setAlamat(string $alamat): void {
        $this->alamat = $alamat;
    }

    public function setMapUrl(string $map_url): void {
        $this->map_url = $map_url;
    }   

    public function setTelepon(string $telepon): void {
        $this->telepon = $telepon;
    }

    public function setInstagramUrl(string $instagram_url): void {
        $this->instagram_url = $instagram_url;
    }

    public function setDeskripsi(string $deskripsi): void {
        $this->deskripsi = $deskripsi;
    }
}
