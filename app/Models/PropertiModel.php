<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTimeStamp;
use App\Interfaces\SearchCompatible;
use Carbon\Carbon;

class PropertiModel extends Model implements SearchCompatible
{

    use HasFactory, HasTimeStamp;
    protected $table = 'tb_properti';
    protected $primaryKey = 'id_properti';
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'id_properti',
        'nama_properti',
        'id_tipe_properti',
        'nik_pemilik',
        'alamat',
        'luas_tanah',
        'luas_bangunan',
        'jumlah_kamar',
    ];

    public static function searchable(): array
    {
        return [
            'nik_pemilik',
            'nama_properti',
            'alamat',
        ];
    }

    public static function filterable(): array
    {
        return [
            'nik_pemilik',
            'nama_properti',
            'alamat',
        ];
    }

    // relationships
    public function tipeProperti()
    {
        return $this->belongsTo(TipePropertiModel::class, 'id_tipe_properti', 'id_tipe_properti');
    }

    public function pemilik()
    {
        return $this->belongsTo(UserModel::class, 'nik_pemilik', 'nik');
    }

    // GETTERS
    public function getIdProperti(): int
    {
        return $this->id_properti;
    }

    public function getNamaProperti(): string
    {
        return $this->nama_properti;
    }

    public function getIdTipeProperti(): int
    {
        return $this->id_tipe_properti;
    }

    public function getNikPemilik(): int
    {
        return $this->nik_pemilik;
    }

    public function getMulaiDimilikiPada()
    {
        return Carbon::parse($this->mulai_dimiliki_pada);
    }

    public function getAlamat(): string
    {
        return $this->alamat;
    }

    public function getLuasTanah(): int
    {
        return $this->luas_tanah;
    }

    public function getLuasBangunan(): int
    {
        return $this->luas_bangunan;
    }

    public function getJumlahKamar(): int
    {
        return $this->jumlah_kamar;
    }

    public function getPemilik(): UserModel
    {
        return $this->pemilik;
    }

    public function getTipeProperti(): TipePropertiModel
    {
        return $this->tipeProperti;
    }

    // SETTERS
    public function setIdProperti(int $id_properti): void
    {
        $this->id_properti = $id_properti;
    }

    public function setNamaProperti(string $nama_properti): void
    {
        $this->nama_properti = $nama_properti;
    }

    public function setIdTipeProperti(int $id_tipe_properti): void
    {
        $this->id_tipe_properti = $id_tipe_properti;
    }

    public function setNikPemilik(int $nik_pemilik): void
    {
        $this->nik_pemilik = $nik_pemilik;
    }

    public function setAlamat(string $alamat): void
    {
        $this->alamat = $alamat;
    }

    public function setLuasTanah(int $luas_tanah): void
    {
        $this->luas_tanah = $luas_tanah;
    }

    public function setLuasBangunan(int $luas_bangunan): void
    {
        $this->luas_bangunan = $luas_bangunan;
    }

    public function setJumlahKamar(int $jumlah_kamar): void
    {
        $this->jumlah_kamar = $jumlah_kamar;
    }

    public function setMulaiDimilikiPada($mulai_dimiliki_pada): void
    {
        $this->mulai_dimiliki_pada = $mulai_dimiliki_pada;
    }
}
