<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaduanModel extends Model
{

    use HasFactory;
    protected $table = 'tb_pengaduan';
    protected $primaryKey = 'id_pengaduan';
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'id_pengaduan',
        'nik_pengadu',
        'judul',
        'isi',
        'image_url',
        'status',
    ];

    public static $searchable = [
        'judul',
        'isi'
    ];

    public static function getStatusOptions()
    {
        return [
            'baru',
            'diproses',
            'invalid',
            'selesai'
        ];
    }

    // relationships
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'nik_pengadu', 'nik');
    }

    // GETTERS
    public function getIdPengaduan(): int
    {
        return $this->id_pengaduan;
    }

    public function getNikPengadu(): string
    {
        return $this->nik_pengadu;
    }

    public function getJudul(): string
    {
        return $this->judul;
    }

    public function getIsi(): string
    {
        return $this->isi;
    }

    public function getImageUrl(): string
    {
        return $this->image_url;
    }

    public function getStatus(): string
    {
        return $this->status;
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
    public function setIdPengaduan(int $id_pengaduan): void
    {
        $this->id_pengaduan = $id_pengaduan;
    }

    public function setNikPenganadu(string $nik): void
    {
        $this->nik_pengadu = $nik;
    }

    public function setJudul(string $judul): void
    {
        $this->judul = $judul;
    }

    public function setIsi(string $isi): void
    {
        $this->isi = $isi;
    }

    public function setImageUrl(string $image_url): void
    {
        $this->image_url = $image_url;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
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
