<?php

namespace App\Models;

use App\Interfaces\SearchCompatible;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTimeStamp;

class PengumumanModel extends Model implements SearchCompatible
{

    use HasFactory, HasTimeStamp;
    protected $table = 'tb_pengumuman';
    protected $primaryKey = 'id_pengumuman';
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'id_pengumuman',
        'judul',
        'image_url',
        'konten',
        'dibuat_pada',
        'diperbarui_pada'
    ];

    public static function searchable(): array
    {
        return [
            'judul',
            'konten',
        ];
    }

    public static function filterable(): array
    {
        return [
            'status',
        ];
    }

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

    public function getImageUrl(): string
    {
        return $this->image_url;
    }

    public function getKonten(): string
    {
        return $this->konten;
    }

    public function getStatus(): string
    {
        return $this->status;
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

    public function setImageUrl(string $image_url): void
    {
        $this->image_url = $image_url;
    }

    public function setKonten(string $konten): void
    {
        $this->konten = $konten;
    }


    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}
