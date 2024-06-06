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

use App\Enums\ReservasiJadwalTemu\ReservasiJadwalTemuStatusEnum;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class RWController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function dashboard()
    {
        // warga statistic dependencies
        $usersByAge = Cache::remember('usersByAge', null, function () {
            return UserModel::selectRaw(
                '
                SUM(CASE WHEN YEAR(tanggal_lahir) < ' . (date('Y') - 45) . ' THEN 1 ELSE 0 END) AS lansiaCount,
                SUM(CASE WHEN YEAR(tanggal_lahir) >= ' . (date('Y') - 45) . ' AND YEAR(tanggal_lahir) < ' . (date('Y') - 25) . ' THEN 1 ELSE 0 END) AS dewasaCount,
                SUM(CASE WHEN YEAR(tanggal_lahir) >= ' . (date('Y') - 25) . ' AND YEAR(tanggal_lahir) < ' . (date('Y') - 11) . ' THEN 1 ELSE 0 END) AS remajaCount,
                SUM(CASE WHEN YEAR(tanggal_lahir) >= ' . (date('Y') - 11) . ' AND YEAR(tanggal_lahir) < ' . (date('Y') - 5) . ' THEN 1 ELSE 0 END) AS anakCount,
                SUM(CASE WHEN YEAR(tanggal_lahir) >= ' . (date('Y') - 5) . ' AND YEAR(tanggal_lahir) < ' . date('Y') . ' THEN 1 ELSE 0 END) AS balitaCount'
            )->first();
        });

        // information panel dependencies
        $umkmInstances = UmkmModel::pluck('dibuat_pada')->all();
        $umkmCount = count($umkmInstances);
        $umkmLastAddedAt = Carbon::parse(array_key_last($umkmInstances))->diffForHumans(null, true);

        $pengaduanInstances = PengaduanModel::pluck('dibuat_pada')->all();
        $pengaduanCount = count($pengaduanInstances);
        $pengaduanLastAddedAt = Carbon::parse(array_key_last($pengaduanInstances))->diffForHumans(null, true);

        $propertiInstances = PropertiModel::pluck('dibuat_pada')->all();
        $propertiCount = count($propertiInstances);
        $propertiLastAddedAt = Carbon::parse(array_key_last($propertiInstances))->diffForHumans(null, true);

        // calendar dependencies
        $reservasiJadwalTemuInstances = ReservasiJadwalTemuModel::where('nik_penerima', request()->user()->getNik())->where('status', ReservasiJadwalTemuStatusEnum::DITERIMA)->get();


        // leaderboard dependencies
        $leaderboardUsers = UserModel::withCount('iuran')->get()->sortBy(function ($user) {
            return $user->iuran_count;
        }, SORT_REGULAR, true);
        $leaderboardUsers = $leaderboardUsers->take(10);


        // iuran line chart dependencies
        $selectRaw = '';

        foreach (IuranBulanEnum::getValues() as $key => $value) {
            $suffix = $key == array_key_last(IuranBulanEnum::getValues()) ? '' : ', ';
            $selectRaw .= 'SUM(CASE WHEN bulan = "' . $value . '" THEN 1 ELSE 0 END)' . ' AS ' . $value . $suffix;
        }

        $monthlyIuranCount = IuranModel::selectRaw($selectRaw)->first()->toArray();

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
            'monthlyIuranCount' => $monthlyIuranCount,
        ];
        return view('pages.rw.dashboard', $data);
    }
}
