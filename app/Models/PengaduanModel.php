<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTimeStamp;
use App\Interfaces\SearchCompatible;

class PengaduanModel extends Model implements SearchCompatible
{

    use HasFactory, HasTimeStamp;
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

    public static function searchable(): array
    {
        return [
            'judul',
            'isi',
        ];
    }

    public static function filterable(): array
    {
        return [
            'status',
        ];
    }

    // relationships
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'nik_pengadu', 'nik');
    }

    // options statics

    // GETTERS
    public function getIdPengaduan(): int
    {
        return $this->id_pengaduan;
    }

    public function getNikPengadu(): string
    {
        return $this->nik_pengadu;
    }

    public function getPengadu()
    {
        return $this->user;
    }

    public function getNamaPengadu(): string
    {
        return $this->user->nama_depan . ' ' . $this->user->nama_belakang;
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
}
