<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RukunWargaModel extends Model
{
    use HasFactory;

    protected $table = 'tb_rukun_warga';
    protected $primaryKey = 'id_rukun_warga';
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'nomor_rukun_warga',
        'alamat',
        'nik_ketua_rukun_warga'
    ];

    // relationships
    public function ketuaRukunWarga() {
        return $this->hasOne(UserModel::class, 'nik', 'nik_ketua_rukun_warga');
    }

    // GETTERS
    public function getIdRukunWarga(): int {
        return $this->id_rukun_warga;
    }

    public function getNomorRukunWarga(): int {
        return $this->nomor_rukun_warga;
    }

    public function getAlamat(): string {
        return $this->alamat;
    }

    public function getNikKetuaRukunWarga(): string {
        return $this->nik_ketua_rukun_warga;
    }

    public function getDibuatPada(): string {
        return $this->dibuat_pada;
    }

    public function getDiperbaruiPada(): string {
        return $this->diperbarui_pada;
    }

    // SETTERS
    public function setIdRukunWarga(int $id_rukun_warga): void {
        $this->id_rukun_warga = $id_rukun_warga;
    }
    public function setNomorRukunWarga(int $nomor_rukun_warga): void {
        $this->nomor_rukun_warga = $nomor_rukun_warga;
    }

    public function setAlamat(string $alamat): void {
        $this->alamat = $alamat;
    }

    public function setNikKetuaRukunWarga(string $nik_ketua_rukun_warga): void {
        $this->nik_ketua_rukun_warga = $nik_ketua_rukun_warga;
    }

    public function setDibuatPada(string $dibuat_pada): void {
        $this->dibuat_pada = $dibuat_pada;
    }

    public function setDiperbaruiPada(string $diperbarui_pada): void {
        $this->diperbarui_pada = $diperbarui_pada;
    }
}
