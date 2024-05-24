<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
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
            'reservasiJadwalTemuInstances' => $reservasiJadwalTemuInstances
        ];
        return view('pages.rw.dashboard', $data);
    }
}
