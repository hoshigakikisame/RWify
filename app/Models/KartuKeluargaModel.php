<?php

namespace App\Models;

use App\Interfaces\SearchCompatible;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTimeStamp;

class KartuKeluargaModel extends Model implements SearchCompatible
{
    use HasFactory, HasTimeStamp;
    protected $table = 'tb_kartu_keluarga';
    protected $primaryKey = 'nkk';
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'nkk',
        'alamat',
        'id_rukun_tetangga',
        'tagihan_listrik_per_bulan',
        'jumlah_pekerja',
        'total_penghasilan_per_bulan',
        'total_pajak_per_tahun',
        'total_properti_dimiliki',
        'tagihan_air_per_bulan',
        'dibuat_pada',
        'diperbarui_pada',
    ];

    public static function searchable(): array
    {
        return [
            'nkk',
            'alamat',
            'id_rukun_tetangga',
            'tagihan_listrik_per_bulan',
            'jumlah_pekerja',
            'total_penghasilan_per_bulan',
            'total_pajak_per_tahun',
            'total_properti_dimiliki',
            'tagihan_air_per_bulan',
            'dibuat_pada',
            'diperbarui_pada',
        ];
    }

    public static function filterable(): array
    {
        return [];
    }

    // relationships
    public function rukunTetangga()
    {
        return $this->belongsTo(RukunTetanggaModel::class, 'id_rukun_tetangga', 'id_rukun_tetangga');
    }

    public function anggotaKeluarga()
    {
        return $this->hasMany(UserModel::class, 'nkk', 'nkk');
    }

    // GETTERS
    public function getNkk(): string
    {
        return $this->nkk;
    }

    public function getAlamat(): string
    {
        return $this->alamat;
    }

    public function getIdRukunTetangga(): int
    {
        return $this->id_rukun_tetangga;
    }

    public function getTagihanListrikPerBulan(): int
    {
        return $this->tagihan_listrik_per_bulan;
    }

    public function getJumlahPekerja(): int
    {
        return $this->jumlah_pekerja;
    }

    public function getTotalPenghasilanPerBulan(): int
    {
        return $this->total_penghasilan_per_bulan;
    }

    public function getTotalPajakPerTahun(): int
    {
        return $this->total_pajak_per_tahun;
    }

    public function getTotalPropertiDimiliki(): int
    {
        return $this->total_properti_dimiliki;
    }

    public function getTagihanAirPerBulan(): int
    {
        return $this->tagihan_air_per_bulan;
    }

    public function getDibuatPada()
    {
        return $this->dibuat_pada;
    }

    public function getDiperbaruiPada()
    {
        return $this->diperbarui_pada;
    }

    // SETTERS
    public function setNkk(string $nkk): void
    {
        $this->nkk = $nkk;
    }

    public function setAlamat(string $alamat): void
    {
        $this->alamat = $alamat;
    }

    public function setIdRukunTetangga(int $id_rukun_tetangga): void
    {
        $this->id_rukun_tetangga = $id_rukun_tetangga;
    }

    public function setTagihanListrikPerBulan(int $tagihan_listrik_per_bulan): void
    {
        $this->tagihan_listrik_per_bulan = $tagihan_listrik_per_bulan;
    }

    public function setJumlahPekerja(int $jumlah_pekerja): void
    {
        $this->jumlah_pekerja = $jumlah_pekerja;
    }

    public function setTotalPenghasilanPerBulan(int $total_penghasilan_per_bulan): void
    {
        $this->total_penghasilan_per_bulan = $total_penghasilan_per_bulan;
    }

    public function setTotalPajakPerTahun(int $total_pajak_per_tahun): void
    {
        $this->total_pajak_per_tahun = $total_pajak_per_tahun;
    }

    public function setTotalPropertiDimiliki(int $total_properti_dimiliki): void
    {
        $this->total_properti_dimiliki = $total_properti_dimiliki;
    }

    public function setTagihanAirPerBulan(int $tagihan_air_per_bulan): void
    {
        $this->tagihan_air_per_bulan = $tagihan_air_per_bulan;
    }

    public function setDibuatPada($dibuat_pada): void
    {
        $this->dibuat_pada = $dibuat_pada;
    }

    public function setDiperbaruiPada($diperbarui_pada): void
    {
        $this->diperbarui_pada = $diperbarui_pada;
    }

}