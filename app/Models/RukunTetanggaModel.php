<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTimeStamp;
use App\Interfaces\SearchCompatible;

class RukunTetanggaModel extends Model implements SearchCompatible
{
    use HasFactory, HasTimeStamp;

    protected $table = 'tb_rukun_tetangga';
    protected $primaryKey = 'id_rukun_tetangga';
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'nomor_rukun_tetangga',
        'alamat',
        'nik_ketua_rukun_tetangga'
    ];

    public static function searchable(): array {
        return [
            'nomor_rukun_tetangga',
            'alamat',
            'nik_ketua_rukun_tetangga'
        ];
    }
    
    public static function filterable(): array {
        return [];
    }

    // relationships
    public function ketuaRukunTetangga() {
        return $this->hasOne(UserModel::class, 'nik', 'nik_ketua_rukun_tetangga');
    }

    public function rukunWarga() {
        return $this->belongsTo(RukunWargaModel::class, 'id_rukun_warga');
    }

    // GETTERS
    public function getIdRukunTetangga(): int {
        return $this->id_rukun_tetangga;
    }

    public function getIdRukunWarga(): int {
        return $this->id_rukun_warga;
    }
    
    public function getNomorRukunTetangga(): int {
        return $this->nomor_rukun_tetangga;
    }

    public function getAlamat(): string {
        return $this->alamat;
    }

    public function getNikKetuaRukunTetangga(): string {
        return $this->nik_ketua_rukun_tetangga;
    }

    // SETTERS
    public function setIdRukunTetangga(int $id_rukun_tetangga): void {
        $this->id_rukun_tetangga = $id_rukun_tetangga;
    }

    public function setIdRukunWarga(int $id_rukun_warga): void {
        $this->id_rukun_warga = $id_rukun_warga;
    }

    public function setNomorRukunTetangga(int $nomor_rukun_tetangga): void {
        $this->nomor_rukun_tetangga = $nomor_rukun_tetangga;
    }

    public function setAlamat(string $alamat): void {
        $this->alamat = $alamat;
    }

    public function setNikKetuaRukunTetangga($nik_ketua_rukun_tetangga): void {
        $this->nik_ketua_rukun_tetangga = $nik_ketua_rukun_tetangga;
    }
}
