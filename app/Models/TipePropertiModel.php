<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTimeStamp;
use App\Interfaces\SearchCompatible;

class TipePropertiModel extends Model implements SearchCompatible
{

    use HasFactory, HasTimeStamp;
    protected $table = 'tb_tipe_properti';
    protected $primaryKey = 'id_tipe_properti';
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'id_tipe_properti',
        'nama_tipe',
        'iuran_per_bulan',
    ];

    public static function searchable(): array
    {
        return [
            'nama_tipe'
        ];
    }

    public static function filterable(): array
    {
        return [];
    }

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
