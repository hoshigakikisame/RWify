<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengumumanModel extends Model
{

    use HasFactory;
    protected $table = 'tb_pengumuman';
    protected $primaryKey = 'id_pengumuman';
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'id_pengumuman',
        'judul',
        'path_gambar',
        'konten',
        'dibuat_pada',
        'diperbarui_pada'
    ];

    public static $searchable = [
        'judul',
        'konten'
    ];

    // relationships

    // GETTERS
    public function getIdPengumuman(): int
    {
        return $this->id_pengumuman;
    }

    public function getJudul(): string
    {
        return $this->judul;
    }

    public function getPathGambar(): string
    {
        return $this->path_gambar;
    }

    public function getKonten(): string
    {
        return $this->konten;
    }

    public function getDibuatPada(): string
    {
        return $this->dibuat_pada;
    }

    public function getDiperbaruiPada(): string
    {
        return $this->diperbarui_pada;
    }


    // SETTERS
    public function setIdPengumuman(int $id_pengumuman): void
    {
        $this->id_pengumuman = $id_pengumuman;
    }

    public function setJudul(string $judul): void
    {
        $this->judul = $judul;
    }

    public function setPathGambar(string $path_gambar): void
    {
        $this->path_gambar = $path_gambar;
    }

    public function setKonten(string $konten): void
    {
        $this->konten = $konten;
    }

    public function setDibuatPada(string $dibuat_pada): void
    {
        $this->dibuat_pada = $dibuat_pada;
    }

    public function setDiperbaruiPada(string $diperbarui_pada): void
    {
        $this->diperbarui_pada = $diperbarui_pada;
    }
}
