<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\RukunTetanggaModel;

class UserModel extends Authenticatable implements MustVerifyEmail
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
        'tipe_warga',
        'role',
        'jenis_kelamin',
        'golongan_darah',
        'alamat',
        'id_rukun_tetangga',
        'dibuat_pada',
        'diperbarui_pada',
    ];

    public static $searchable = [
        'nik',
        'nkk',
        'email',
        'nama_depan',
        'nama_belakang',
        'tempat_lahir',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'tipe_warga',
        'role',
        'jenis_kelamin',
        'golongan_darah'
    ];

    // options statics
    public static function getGolonganDarahOption()
    {
        return [
            'A' => 'A',
            'B' => 'B',
            'AB' => 'AB',
            'O' => 'O',
        ];
    }

    public static function getKelaminOption()
    {
        return [
            'Laki-laki' => 'Laki-laki',
            'Perempuan' => 'Perempuan',
        ];
    }

    public static function getAgamaOption()
    {
        return [
            'Islam' => 'Islam',
            'Kristen' => 'Kristen',
            'Katolik' => 'Katolik',
            'Hindu' => 'Hindu',
            'Budha' => 'Budha',
            'Konghucu' => 'Konghucu',
        ];
    }

    public static function getStatusPerkawinanOption()
    {
        return [
            'Belum Kawin' => 'Belum Kawin',
            'Kawin' => 'Kawin',
            'Cerai Hidup' => 'Cerai Hidup',
            'Cerai Mati' => 'Cerai Mati',
        ];
    }

    public static function getRoleOption()
    {
        return [
            'Ketua Rukun Warga' => 'Ketua Rukun Warga',
            'Ketua Rukun Tetangga' => 'Ketua Rukun Tetangga',
            'Warga' => 'Warga',
            'Petugas Keamanan' => 'Petugas Keamanan',
        ];
    }

    public static function getTipeWargaOption()
    {
        return [
            'Domisili Lokal' => 'Domisili Lokal',
            'Non Domisili Lokal' => 'Non Domisili Lokal',
            'Bukan Warga' => 'Bukan Warga',
        ];
    }

    public static function getRukunTetanggaOption()
    {
        $rukunTetanggaInstances = RukunTetanggaModel::all();
        $options = [];
        foreach ($rukunTetanggaInstances as $rt) {
            $options[$rt->getNomorRukunTetangga()] = $rt->getIdRukunTetangga();
        }
        return $options;
    }

    // relationships
    public function rukunTetangga()
    {
        return $this->belongsTo(RukunTetanggaModel::class, 'id_rukun_warga');
    }


    // search
    public function scopeSearch($query, $search)
    {
        $query->where('nama_depan', 'LIKE', "%{$search}%")
            ->orWhere('nama_belakang', 'like', "%{$search}%")
            ->orWhere('nkk', 'like', "%{$search}%")
            ->orWhere('nik', 'like', "%{$search}%")
            ->orWhere('tempat_lahir', 'like', "%{$search}%")
            ->orWhere('tanggal_lahir', 'like', "%{$search}%")
            ->orWhere('alamat', 'like', "%{$search}%");
    }

    // GETTERS
    public function getNik(): string
    {
        return $this->nik;
    }

    public function getNkk(): string
    {
        return $this->nkk;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getNamaDepan(): string
    {
        return $this->nama_depan;
    }

    public function getNamaBelakang(): string
    {
        return $this->nama_belakang;
    }

    public function getTempatLahir(): string
    {
        return $this->tempat_lahir;
    }

    public function getTanggalLahir(): string
    {
        return $this->tanggal_lahir;
    }

    public function getAgama(): string
    {
        return $this->agama;
    }

    public function getStatusPerkawinan(): string
    {
        return $this->status_perkawinan;
    }

    public function getPekerjaan(): string
    {
        return $this->pekerjaan;
    }

    public function getTipeWarga(): string
    {
        return $this->tipe_warga;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getJenisKelamin(): string
    {
        return $this->jenis_kelamin;
    }

    public function getIdRukunTetangga(): string
    {
        return $this->id_rukun_tetangga;
    }

    public function getGolonganDarah(): string
    {
        return $this->golongan_darah;
    }

    public function getAlamat(): string
    {
        return $this->alamat;
    }

    public function getDibuatPada(): string
    {
        return $this->dibuat_pada;
    }

    public function getDiperbaruiPada(): string
    {
        return $this->diperbarui_pada;
    }

    public function getRukunTetangga(): RukunTetanggaModel
    {
        return RukunTetanggaModel::find($this->id_rukun_tetangga)->first();
    }

    public function getEmailVerifiedAt(): string|null
    {
        return $this->email_verified_at;
    }


    // SETTERS
    public function setNik(string $nik): void
    {
        $this->nik = $nik;
    }

    public function setNkk(string $nkk): void
    {
        $this->nkk = $nkk;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setNamaDepan(string $namaDepan): void
    {
        $this->nama_depan = $namaDepan;
    }

    public function setNamaBelakang(string $namaBelakang): void
    {
        $this->nama_belakang = $namaBelakang;
    }

    public function setTempatLahir(string $tempatLahir): void
    {
        $this->tempat_lahir = $tempatLahir;
    }

    public function setTanggalLahir(string $tanggalLahir): void
    {
        $this->tanggal_lahir = $tanggalLahir;
    }

    public function setAgama(string $agama): void
    {
        $this->agama = $agama;
    }

    public function setStatusPerkawinan(string $statusPerkawinan): void
    {
        $this->status_perkawinan = $statusPerkawinan;
    }

    public function setPekerjaan(string $pekerjaan): void
    {
        $this->pekerjaan = $pekerjaan;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function setTipeWarga(string $tipeWarga): void
    {
        $this->tipe_warga = $tipeWarga;
    }

    public function setGolonganDarah(string $golonganDarah): void
    {
        $this->golongan_darah = $golonganDarah;
    }

    public function setIdRukunTetangga(string $idRukunTetangga): void
    {
        $this->id_rukun_tetangga = $idRukunTetangga;
    }

    public function setJenisKelamin(string $jenisKelamin): void
    {
        $this->jenis_kelamin = $jenisKelamin;
    }

    public function setAlamat(string $alamat): void
    {
        $this->alamat = $alamat;
    }

    public function setDibuatPada(string $dibuatPada): void
    {
        $this->dibuat_pada = $dibuatPada;
    }

    public function setDiperbaruiPada(string $diperbaruiPada): void
    {
        $this->diperbarui_pada = $diperbaruiPada;
    }

    public function setEmailVerifiedAt(string|null $emailVerifiedAt): void
    {
        $this->email_verified_at = $emailVerifiedAt;
    }
}
