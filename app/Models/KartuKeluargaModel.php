<?php

namespace App\Models;

use App\Interfaces\SearchCompatible;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTimeStamp;

class KartuKeluargaModel extends Model implements SearchCompatible
{
    use HasFactory, HasTimeStamp;
    protected $table = 'tb_kartu_keluarga';
    protected $primaryKey = 'nkk';
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'nkk',
        'alamat',
        'id_rukun_tetangga',
        'tagihan_listrik_per_bulan',
        'jumlah_pekerja',
        'total_penghasilan_per_bulan',
        'total_pajak_per_tahun',
        'tagihan_air_per_bulan',
        'total_kendaraan_dimiliki',
        'dibuat_pada',
        'diperbarui_pada',
    ];

    public static function getSpkCriteria(): array
    {
        return [
            'tagihan_listrik_per_bulan' => [
                'weight' => 0.2,
                'type' => 'benefit',
                'rule' => function ($tagihanListrikPerBulan) {
                    if ($tagihanListrikPerBulan > 250000) {
                        return 5;
                    } else if ($tagihanListrikPerBulan > 200000) {
                        return 4;
                    } else if ($tagihanListrikPerBulan > 150000) {
                        return 3;
                    } else if ($tagihanListrikPerBulan > 100000) {
                        return 2;
                    } else {
                        return 1;
                    }
                }
            ],
            'total_penghasilan_per_bulan' => [
                'weight' => 0.2,
                'type' => 'cost',
                'rule' => function ($totalPenghasilanPerBulan) {
                    if ($totalPenghasilanPerBulan > 5000000) {
                        return 1;
                    } else if ($totalPenghasilanPerBulan > 4000000) {
                        return 2;
                    } else if ($totalPenghasilanPerBulan > 3000000) {
                        return 3;
                    } else if ($totalPenghasilanPerBulan > 2000000) {
                        return 4;
                    } else {
                        return 5;
                    }
                }
            ],
            'jumlah_pekerja' => [
                'weight' => 0.15,
                'type' => 'cost',
                'rule' => function ($jumlahPekerja) {
                    if ($jumlahPekerja >= 5) {
                        return 5;
                    } else if ($jumlahPekerja == 4) {
                        return 4;
                    } else if ($jumlahPekerja == 3) {
                        return 3;
                    } else if ($jumlahPekerja == 2) {
                        return 2;
                    } else {
                        return 1;
                    }
                }
            ],
            'total_pajak_per_tahun' => [
                'weight' => 0.15,
                'type' => 'cost',
                'rule' => function ($totalPajakPerTahun) {
                    if ($totalPajakPerTahun > 5000000) {
                        return 5;
                    } else if ($totalPajakPerTahun > 4000000) {
                        return 4;
                    } else if ($totalPajakPerTahun > 3000000) {
                        return 3;
                    } else if ($totalPajakPerTahun > 2000000) {
                        return 2;
                    } else {
                        return 1;
                    }
                }
            ],
            'tagihan_air_per_bulan' => [
                'weight' => 0.15,
                'type' => 'benefit',
                'rule' => function ($tagihanAirPerBulan) {
                    if ($tagihanAirPerBulan > 150000) {
                        return 5;
                    } else if ($tagihanAirPerBulan > 100000) {
                        return 4;
                    } else if ($tagihanAirPerBulan > 75000) {
                        return 3;
                    } else if ($tagihanAirPerBulan > 50000) {
                        return 2;
                    } else {
                        return 1;
                    }
                }
            ],
            'total_kendaraan_dimiliki' => [
                'weight' => 0.15,
                'type' => 'cost',
                'rule' => function ($totalKendaraanDimiliki) {
                    if ($totalKendaraanDimiliki >= 5) {
                        return 5;
                    } else if ($totalKendaraanDimiliki == 4) {
                        return 4;
                    } else if ($totalKendaraanDimiliki == 3) {
                        return 3;
                    } else if ($totalKendaraanDimiliki == 2) {
                        return 2;
                    } else {
                        return 1;
                    }
                }
            ]
        ];
    }

    public static function searchable(): array
    {
        return [
            'nkk',
            'alamat',
            'id_rukun_tetangga',
            'tagihan_listrik_per_bulan',
            'jumlah_pekerja',
            'total_penghasilan_per_bulan',
            'total_pajak_per_tahun',
            'tagihan_air_per_bulan',
            'total_kendaraan_dimiliki',
            'dibuat_pada',
            'diperbarui_pada',
        ];
    }

    public static function filterable(): array
    {
        return [];
    }

    // relationships
    public function rukunTetangga()
    {
        return $this->belongsTo(RukunTetanggaModel::class, 'id_rukun_tetangga', 'id_rukun_tetangga');
    }

    public function anggotaKeluarga()
    {
        return $this->hasMany(UserModel::class, 'nkk', 'nkk');
    }

    public function getRukunTetangga(): RukunTetanggaModel
    {
        return RukunTetanggaModel::find($this->id_rukun_tetangga)->first();
    }

    // GETTERS
    public function getNkk(): string
    {
        return $this->nkk;
    }

    public function getAlamat(): string
    {
        return $this->alamat;
    }

    public function getIdRukunTetangga(): int
    {
        return $this->id_rukun_tetangga;
    }

    public function getNomorRukunTetangga(): int {
        return $this->rukunTetangga->nomor_rukun_tetangga;
    }

    public function getTagihanListrikPerBulan(): int
    {
        return $this->tagihan_listrik_per_bulan;
    }

    public function getJumlahPekerja(): int
    {
        return $this->jumlah_pekerja;
    }

    public function getTotalPenghasilanPerBulan(): int
    {
        return $this->total_penghasilan_per_bulan;
    }

    public function getTotalPajakPerTahun(): int
    {
        return $this->total_pajak_per_tahun;
    }

    public function getTagihanAirPerBulan(): int
    {
        return $this->tagihan_air_per_bulan;
    }

    public function getTotalKendaraanDimiliki(): int
    {
        return $this->total_kendaraan_dimiliki;
    }

    public function getDibuatPada()
    {
        return $this->dibuat_pada;
    }

    public function getDiperbaruiPada()
    {
        return $this->diperbarui_pada;
    }

    // SETTERS
    public function setNkk(string $nkk): void
    {
        $this->nkk = $nkk;
    }

    public function setAlamat(string $alamat): void
    {
        $this->alamat = $alamat;
    }

    public function setIdRukunTetangga(int $id_rukun_tetangga): void
    {
        $this->id_rukun_tetangga = $id_rukun_tetangga;
    }

    public function setTagihanListrikPerBulan(int $tagihan_listrik_per_bulan): void
    {
        $this->tagihan_listrik_per_bulan = $tagihan_listrik_per_bulan;
    }

    public function setJumlahPekerja(int $jumlah_pekerja): void
    {
        $this->jumlah_pekerja = $jumlah_pekerja;
    }

    public function setTotalPenghasilanPerBulan(int $total_penghasilan_per_bulan): void
    {
        $this->total_penghasilan_per_bulan = $total_penghasilan_per_bulan;
    }

    public function setTotalPajakPerTahun(int $total_pajak_per_tahun): void
    {
        $this->total_pajak_per_tahun = $total_pajak_per_tahun;
    }

    public function setTagihanAirPerBulan(int $tagihan_air_per_bulan): void
    {
        $this->tagihan_air_per_bulan = $tagihan_air_per_bulan;
    }

    public function setTotalKendaraanDimiliki(int $total_kendaraan_dimiliki): void
    {
        $this->total_kendaraan_dimiliki = $total_kendaraan_dimiliki;
    }

    public function setDibuatPada($dibuat_pada): mixed
    {
        $this->dibuat_pada = $dibuat_pada;
    }

    public function setDiperbaruiPada($diperbarui_pada): mixed
    {
        $this->diperbarui_pada = $diperbarui_pada;
    }

}