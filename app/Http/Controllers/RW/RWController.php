<?php

namespace App\Http\Controllers\RW;

use App\Enums\Iuran\IuranBulanEnum;
use App\Http\Controllers\Controller;
use App\Models\IuranModel;
use App\Models\PengaduanModel;
use App\Models\UmkmModel;
use App\Models\UserModel;
use App\Models\PropertiModel;
use App\Models\ReservasiJadwalTemuModel;

class RWController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function dashboard()
    {
        $lansiaCount = UserModel::whereYear('tanggal_lahir', '<', date('Y') - 45)->count();
        $dewasaCount = UserModel::whereYear('tanggal_lahir', '>=', date('Y') - 45)->whereYear('tanggal_lahir', '<', date('Y') - 25)->count();
        $remajaCount = UserModel::whereYear('tanggal_lahir', '>=', date('Y') - 25)->whereYear('tanggal_lahir', '<', date('Y') - 11)->count();
        $anakCount = UserModel::whereYear('tanggal_lahir', '>=', date('Y') - 11)->whereYear('tanggal_lahir', '<', date('Y') - 5)->count();
        $balitaCount = UserModel::whereYear('tanggal_lahir', '>=', date('Y') - 5)->whereYear('tanggal_lahir', '<', date('Y'))->count();

        $umkmCount = UmkmModel::count();
        $pengaduanCount = PengaduanModel::count();
        $propertiCount = PropertiModel::count();

        $umkmLastAddedAt = UmkmModel::orderBy('dibuat_pada')->first()->getDiperbaruiPada()->diffForHumans(null, true);
        $pengaduanLastAddedAt = PengaduanModel::orderBy('dibuat_pada')->first()->getDiperbaruiPada()->diffForHumans(null, true);
        $propertiLastAddedAt = PropertiModel::orderBy('dibuat_pada')->first()->getDiperbaruiPada()->diffForHumans(null, true);

        $reservasiJadwalTemuInstances = ReservasiJadwalTemuModel::where('nik_penerima', request()->user()->getNik())->get();


        // leaderboard
        $leaderboardUsers = UserModel::withCount('iuran')->get()->sortBy(function ($user) {
            return $user->iuran_count;
        }, SORT_REGULAR, true);

        $leaderboardUsers = $leaderboardUsers->take(10);


        // iuran line chart
        $selectRaw = '';

        foreach (IuranBulanEnum::getValues() as $key => $value) {
            $suffix = $key == array_key_last(IuranBulanEnum::getValues()) ? '' : ', ';
            $selectRaw .= 'SUM(CASE WHEN bulan = "' . $value . '" THEN 1 ELSE 0 END)' . ' AS ' . $value . $suffix;
        }

        $monthlyIuranCount = IuranModel::selectRaw($selectRaw)->first()->toArray();

        $data = [
            'lansiaCount' => $lansiaCount,
            'dewasaCount' => $dewasaCount,
            'remajaCount' => $remajaCount,
            'anakCount' => $anakCount,
            'balitaCount' => $balitaCount,
            'umkmCount' => $umkmCount,
            'pengaduanCount' => $pengaduanCount,
            'propertiCount' => $propertiCount,
            'umkmLastAddedAt' => $umkmLastAddedAt,
            'pengaduanLastAddedAt' => $pengaduanLastAddedAt,
            'propertiLastAddedAt' => $propertiLastAddedAt,
            'reservasiJadwalTemuInstances' => $reservasiJadwalTemuInstances,
            'leaderboardUsers' => $leaderboardUsers,
            'monthlyIuranCount' => $monthlyIuranCount,
        ];
        return view('pages.rw.dashboard', $data);
    }
}
