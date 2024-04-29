<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PengaduanModel extends Model {
    protected $table = 'tb_pengaduan';
    protected $primaryKey = 'id_pengaduan';
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'id_pengaduan',
        'nik',
        'judul',
        'isi',
        'path_gambar',
        'status',
    ];

    public static $searchable = [
        'judul',
        'isi'
    ];

    public static $statusOptions = [
        'baru',
        'diproses',
        'invalid',
        'selesai'
    ];

    // relationships
    public function user() {
        return $this->belongsTo(UserModel::class, 'nik', 'nik');
    }

    // GETTERS
    public function getIdPengaduan(): int {
        return $this->id_pengaduan;
    }

    public function getNik(): string {
        return $this->nik;
    }

    public function getJudul(): string {
        return $this->judul;
    }

    public function getIsi(): string {
        return $this->isi;
    }

    public function getPathGambar(): string {
        return $this->path_gambar;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getDibuatPada(): string {
        return $this->dibuat_pada;
    }

    public function getDiperbaruiPada(): string {
        return $this->diperbarui_pada;
    }


    // SETTERS
    public function setIdPengaduan(int $id_pengaduan): void {
        $this->id_pengaduan = $id_pengaduan;
    }

    public function setNik(string $nik): void {
        $this->nik = $nik;
    }

    public function setJudul(string $judul): void {
        $this->judul = $judul;
    }

    public function setIsi(string $isi): void {
        $this->isi = $isi;
    }

    public function setPathGambar(string $path_gambar): void {
        $this->path_gambar = $path_gambar;
    }

    public function setStatus(string $status): void {
        $this->status = $status;
    }

    public function setDibuatPada(string $dibuat_pada): void {
        $this->dibuat_pada = $dibuat_pada;
    }

    public function setDiperbaruiPada(string $diperbarui_pada): void {
        $this->diperbarui_pada = $diperbarui_pada;
    }
}
