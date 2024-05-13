<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipePropertiModel extends Model
{

    use HasFactory;
    protected $table = 'tb_tipe_properti';
    protected $primaryKey = 'id_tipe_properti';
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'id_tipe_properti',
        'nama_tipe',
        'iuran_per_bulan',
    ];

    public static $searchable = [
        'nama_tipe'
    ];

    // relationships

    // GETTERS
    public function getIdTipeProperti(): int
    {
        return $this->id_tipe_properti;
    }

    public function getNamaTipe(): string
    {
        return $this->nama_tipe;
    }

    public function getIuranPerBulan(): int
    {
        return $this->iuran_per_bulan;
    }

    public function setDibuatPada(string $dibuat_pada): void
    {
        $this->dibuat_pada = $dibuat_pada;
    }

    public function setDiperbaruiPada(string $diperbarui_pada): void
    {
        $this->diperbarui_pada = $diperbarui_pada;
    }

    // SETTERS
    public function setNamaTipe(string $nama_tipe): void
    {
        $this->nama_tipe = $nama_tipe;
    }

    public function setIuranPerBulan(int $iuran_per_bulan): void
    {
        $this->iuran_per_bulan = $iuran_per_bulan;
    }
}
