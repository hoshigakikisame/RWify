<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserModel extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'tb_user';
    protected $primaryKey = 'nik';
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'nik',
        'nkk',
        'email',
        'password',
        'nama_depan',
        'nama_belakang',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'role',
        'jenis_kelamin',
        'status',
        'dibuat_pada',
        'diperbarui_pada'
    ];

    // relationships
    public function rukunTetangga() {
        return $this->belongsTo(RukunTetanggaModel::class, 'id_rukun_warga');
    }

    // GETTERS
    public function getNik(): string {
        return $this->nik;
    }

    public function getNkk(): string {
        return $this->nkk;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getNamaDepan(): string {
        return $this->nama_depan;
    }

    public function getNamaBelakang(): string {
        return $this->nama_belakang;
    }

    public function getTempatLahir(): string {
        return $this->tempat_lahir;
    }

    public function getTanggalLahir(): string {
        return $this->tanggal_lahir;
    }

    public function getAgama(): string {
        return $this->agama;
    }

    public function getStatusPerkawinan(): string {
        return $this->status_perkawinan;
    }

    public function getPekerjaan(): string {
        return $this->pekerjaan;
    }

    public function getRole(): string {
        return $this->role;
    }

    public function getJenisKelamin(): string {
        return $this->jenis_kelamin;
    }

    public function getDibuatPada(): string {
        return $this->dibuat_pada;
    }

    public function getDiperbaruiPada(): string {
        return $this->diperbarui_pada;
    }


    // SETTERS
    public function setNik(string $nik): void {
        $this->nik = $nik;
    }

    public function setNkk(string $nkk): void {
        $this->nkk = $nkk;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function setNamaDepan(string $namaDepan): void {
        $this->nama_depan = $namaDepan;
    }

    public function setNamaBelakang(string $namaBelakang): void {
        $this->nama_belakang = $namaBelakang;
    }

    public function setTempatLahir(string $tempatLahir): void {
        $this->tempat_lahir = $tempatLahir;
    }

    public function setTanggalLahir(string $tanggalLahir): void {
        $this->tanggal_lahir = $tanggalLahir;
    }

    public function setAgama(string $agama): void {
        $this->agama = $agama;
    }

    public function setStatusPerkawinan(string $statusPerkawinan): void {
        $this->status_perkawinan = $statusPerkawinan;
    }

    public function setPekerjaan(string $pekerjaan): void {
        $this->pekerjaan = $pekerjaan;
    }

    public function setRole(string $role): void {
        $this->role = $role;
    }

    public function setJenisKelamin(string $jenisKelamin): void {
        $this->jenis_kelamin = $jenisKelamin;
    }

    public function setDibuatPada(string $dibuatPada): void {
        $this->dibuat_pada = $dibuatPada;
    }

    public function setDiperbaruiPada(string $diperbaruiPada): void {
        $this->diperbarui_pada = $diperbaruiPada;
    }
}
