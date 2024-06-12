<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\RukunTetanggaModel;
use App\Traits\HasTimeStamp;
use App\Interfaces\SearchCompatible;

class UserModel extends Authenticatable implements MustVerifyEmail, SearchCompatible
{
    use HasFactory, Notifiable, HasTimeStamp;
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
        'golongan_darah',
        'alamat',
        'id_rukun_tetangga',
        'dibuat_pada',
        'diperbarui_pada',
    ];

    public static function searchable(): array
    {
        return [
            'nik',
            'nkk',
            'email',
            'nama_depan',
            'nama_belakang',
            'tempat_lahir',
            'agama',
            'status_perkawinan',
            'pekerjaan',
            'role',
            'jenis_kelamin',
            'golongan_darah',
            'alamat'
        ];
    }

    public static function filterable(): array
    {
        return [
            'role',
            'jenis_kelamin',
            'agama',
            'status_perkawinan',
            'golongan_darah',
            // 'id_rukun_tetangga'
        ];
    }

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
    public function pembayaranIuran() {
        return $this->hasMany(PembayaranIuranModel::class, 'nik_pembayar', 'nik');
    }

    public function iuran() {
        return $this->hasMany(IuranModel::class, 'nik_pembayar', 'nik');
    }

    public function kartuKeluarga() {
        return $this->belongsTo(KartuKeluargaModel::class, 'nkk', 'nkk');
    }

    public function properti() {
        return $this->hasMany(PropertiModel::class, 'nik_pemilik', 'nik');
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

    // trait
    public function redirectToDashboard() {
        switch($this->getRole()) {
            case "Ketua Rukun Warga":
                return redirect()->route('rw.dashboard');
            case "Ketua Rukun Tetangga":
                return redirect()->route('rt.dashboard');
            case "Warga":
                return redirect()->route('warga.dashboard');
        }
    }

    public function getDashboardRoute() {
        switch ($this->getRole()) {
            case "Ketua Rukun Warga":
                return route('rw.dashboard');
            case "Ketua Rukun Tetangga":
                return route('rt.dashboard');
            case "Warga":
                return route('warga.dashboard');
            case "Petugas Keamanan":
                return route('warga.dashboard');
        }
    }

    public function getSidebarView() {
        switch ($this->getRole()) {
            case "Ketua Rukun Warga":
                return 'layouts.sidebar.rw-sidebar';
            case "Ketua Rukun Tetangga":
                return 'layouts.sidebar.rt-sidebar';
            case "Warga":
                return 'layouts.sidebar.warga-sidebar';
            case "Petugas Keamanan":
                return 'layouts.sidebar.warga-sidebar';
        }
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

    public function getImageUrl(): string | null
    {
        return $this->image_url ?? 'https://ui-avatars.com/api/?name=' . $this->getNamaLengkap() . '&background=random&color=fff';
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

    public function getNamaLengkap(): string
    {
        return $this->nama_depan . ' ' . $this->nama_belakang;
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

    public function getRole(): string
    {
        return $this->role;
    }

    public function getJenisKelamin(): string
    {
        return $this->jenis_kelamin;
    }

    public function getGolonganDarah(): string
    {
        return $this->golongan_darah;
    }

    public function getAlamat(): string
    {
        return $this->alamat;
    }

    public function getEmailVerifiedAt(): string|null
    {
        return $this->email_verified_at;
    }

    public function getKartuKeluarga(): KartuKeluargaModel
    {
        return KartuKeluargaModel::where('nkk', $this->nkk)->first();
    }

    public function getKetuaRukunWarga(): UserModel {
        $idKetuaRukunWarga = KartuKeluargaModel::
            join('tb_rukun_tetangga', 'tb_kartu_keluarga.id_rukun_tetangga', '=', 'tb_rukun_tetangga.id_rukun_tetangga')
            ->join('tb_rukun_warga', 'tb_rukun_tetangga.id_rukun_warga', '=', 'tb_rukun_warga.id_rukun_warga')
            ->where('tb_kartu_keluarga.nkk', $this->getNkk())
            ->select('nik_ketua_rukun_warga')->first()->nik_ketua_rukun_warga;  
            
        return UserModel::where('nik', $idKetuaRukunWarga)->first();
    }

    public function getVerifiedIuranCount(): int
    {
        return IuranModel::select('id_iuran')->where('nik_pembayar', $this->getNik())->count();
    }

    public function getTagihanIuranPerBulan(): int
    {
        $ownedPropertiInstances = $this->properti()->get();

        $totalTunggakan = 0;
        foreach ($ownedPropertiInstances as $properti) {
            $totalTunggakan += $properti->getTotalUnpaidDueMonths();
        }

        $monthlyTotal = $this->properti()->join('tb_tipe_properti', 'tb_tipe_properti.id_tipe_properti', '=', 'tb_properti.id_tipe_properti')->sum('iuran_per_bulan');

        return $totalTunggakan < $monthlyTotal ? $totalTunggakan : $monthlyTotal;
    }

    public function getUnreadNotifications() {
        return NotificationModel::where('target_nik', $this->getNik())->whereNull('dibaca_pada')->get()->sortByDesc('dibuat_pada');
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

    public function setImageUrl(string $imageUrl): void
    {
        $this->image_url = $imageUrl;
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

    public function setGolonganDarah(string $golonganDarah): void
    {
        $this->golongan_darah = $golonganDarah;
    }

    public function setJenisKelamin(string $jenisKelamin): void
    {
        $this->jenis_kelamin = $jenisKelamin;
    }

    public function setAlamat(string $alamat): void
    {
        $this->alamat = $alamat;
    }

    public function setEmailVerifiedAt(string|null $emailVerifiedAt): void
    {
        $this->email_verified_at = $emailVerifiedAt;
    }
}
