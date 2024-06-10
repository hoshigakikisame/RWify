<?php

namespace App\Http\Controllers\RT;

use App\Http\Controllers\Controller;
use App\Models\PengaduanModel;
use App\Models\RukunTetanggaModel;
use App\Models\UmkmModel;
use App\Models\UserModel;
use App\Models\PropertiModel;
use \Illuminate\Database\Eloquent\Builder;
use App\Models\ReservasiJadwalTemuModel;
use App\Enums\Iuran\IuranBulanEnum;
use App\Models\IuranModel;


class RTController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function dashboard()
    {
        $ownedRT = RukunTetanggaModel::where('nik_ketua_rukun_tetangga', '=', request()->user()->getNik())->first();

        // warga statistic dependencies
        $usersByAge = UserModel::selectRaw(
            '
            SUM(CASE WHEN YEAR(tanggal_lahir) < ' . (date('Y') - 45) . ' THEN 1 ELSE 0 END) AS lansiaCount,
            SUM(CASE WHEN YEAR(tanggal_lahir) >= ' . (date('Y') - 45) . ' AND YEAR(tanggal_lahir) < ' . (date('Y') - 25) . ' THEN 1 ELSE 0 END) AS dewasaCount,
            SUM(CASE WHEN YEAR(tanggal_lahir) >= ' . (date('Y') - 25) . ' AND YEAR(tanggal_lahir) < ' . (date('Y') - 11) . ' THEN 1 ELSE 0 END) AS remajaCount,
            SUM(CASE WHEN YEAR(tanggal_lahir) >= ' . (date('Y') - 11) . ' AND YEAR(tanggal_lahir) < ' . (date('Y') - 5) . ' THEN 1 ELSE 0 END) AS anakCount,
            SUM(CASE WHEN YEAR(tanggal_lahir) >= ' . (date('Y') - 5) . ' AND YEAR(tanggal_lahir) < ' . date('Y') . ' THEN 1 ELSE 0 END) AS balitaCount'
        )->join('tb_kartu_keluarga', 'tb_kartu_keluarga.nkk', '=', 'tb_user.nkk')
            ->where('id_rukun_tetangga', '=', $ownedRT->getIdRukunTetangga())->first();

        $umkmCount = UmkmModel::count();
        $pengaduanCount = PengaduanModel::count();
        $propertiCount = PropertiModel::withWhereHas('pemilik.kartuKeluarga', function (Builder $query) use ($ownedRT) {
            $query->where('id_rukun_tetangga', '=', $ownedRT->getIdRukunTetangga());
        })->count();

        $umkmLastAddedAt = UmkmModel::orderBy('dibuat_pada')->first()?->getDiperbaruiPada()->diffForHumans(null, true);
        $pengaduanLastAddedAt = PengaduanModel::orderBy('dibuat_pada')->first()?->getDiperbaruiPada()->diffForHumans(null, true);
        $propertiLastAddedAt = PropertiModel::orderBy('dibuat_pada')->first()?->getDiperbaruiPada()->diffForHumans(null, true);

        $reservasiJadwalTemuInstances = ReservasiJadwalTemuModel::where('nik_penerima', request()->user()->getNik())->get();

        $leaderboardUsers = UserModel::withCount('iuran')->get()->sortBy(function ($user) {
            return $user->iuran_count;
        }, SORT_REGULAR, true);

        $leaderboardUsers = $leaderboardUsers->take(10);

        // iuran line chart dependencies
        $selectRaw = '';

        foreach (IuranBulanEnum::getValues() as $key => $value) {
            $suffix = $key == array_key_last(IuranBulanEnum::getValues()) ? '' : ', ';
            $selectRaw .= 'SUM(CASE WHEN bulan = "' . $value . '" THEN jumlah_bayar ELSE 0 END)' . ' AS ' . $value . $suffix;
        }

        $monthlyIuranCount = IuranModel::selectRaw($selectRaw)->
            join('tb_user', 'tb_user.nik', '=', 'tb_iuran.nik_pembayar')->
            join('tb_kartu_keluarga', 'tb_kartu_keluarga.nkk', '=', 'tb_user.nkk')->
            where('id_rukun_tetangga', '=', $ownedRT->getIdRukunTetangga())->
            where('tahun', date('Y'))->first()?->toArray();

        $data = [
            'lansiaCount' => $usersByAge->lansiaCount,
            'dewasaCount' => $usersByAge->dewasaCount,
            'remajaCount' => $usersByAge->remajaCount,
            'anakCount' => $usersByAge->anakCount,
            'balitaCount' => $usersByAge->balitaCount,
            'umkmCount' => $umkmCount,
            'pengaduanCount' => $pengaduanCount,
            'propertiCount' => $propertiCount,
            'umkmLastAddedAt' => $umkmLastAddedAt,
            'pengaduanLastAddedAt' => $pengaduanLastAddedAt,
            'propertiLastAddedAt' => $propertiLastAddedAt,
            'reservasiJadwalTemuInstances' => $reservasiJadwalTemuInstances,
            'leaderboardUsers' => $leaderboardUsers,
            'unreadNotifications' => request()->user()->getUnreadNotifications(),
            'monthlyIuranCount' => $monthlyIuranCount,
        ];
        return view('pages.rt.dashboard', $data);
    }
}
