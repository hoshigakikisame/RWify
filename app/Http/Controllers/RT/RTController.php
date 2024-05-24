<?php

namespace App\Http\Controllers\RT;

use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\PengaduanModel;
use App\Models\RukunTetanggaModel;
use App\Models\UmkmModel;
use App\Models\UserModel;
use App\Models\PropertiModel;

class RTController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function dashboard()
    {
        $ownedRT = RukunTetanggaModel::where('nik_ketua_rukun_tetangga', '=', request()->user()->getNik())->first();

        $lansiaCount = UserModel::where('id_rukun_tetangga', '=', $ownedRT->getIdRukunTetangga())->whereYear('tanggal_lahir', '<', date('Y') - 45)->count();
        $dewasaCount = UserModel::where('id_rukun_tetangga', '=', $ownedRT->getIdRukunTetangga())->whereYear('tanggal_lahir', '>=', date('Y') - 45)->whereYear('tanggal_lahir', '<', date('Y') - 25)->count();
        $remajaCount = UserModel::where('id_rukun_tetangga', '=', $ownedRT->getIdRukunTetangga())->whereYear('tanggal_lahir', '>=', date('Y') - 25)->whereYear('tanggal_lahir', '<', date('Y') - 11)->count();
        $anakCount = UserModel::where('id_rukun_tetangga', '=', $ownedRT->getIdRukunTetangga())->whereYear('tanggal_lahir', '>=', date('Y') - 11)->whereYear('tanggal_lahir', '<', date('Y') - 5)->count();
        $balitaCount = UserModel::where('id_rukun_tetangga', '=', $ownedRT->getIdRukunTetangga())->whereYear('tanggal_lahir', '>=', date('Y') - 5)->whereYear('tanggal_lahir', '<', date('Y'))->count();

        $umkmCount = UmkmModel::count();
        $pengaduanCount = PengaduanModel::count();
        $propertiCount = PropertiModel::withWhereHas('pemilik', function ($query) use ($ownedRT) {
            $query->where('id_rukun_tetangga', '=', $ownedRT->getIdRukunTetangga());
        })->count();

        $umkmLastAddedAt = UmkmModel::orderBy('dibuat_pada')->first()->getDiperbaruiPada()->diffForHumans(null, true);
        $pengaduanLastAddedAt = PengaduanModel::orderBy('dibuat_pada')->first()->getDiperbaruiPada()->diffForHumans(null, true);
        $propertiLastAddedAt = PropertiModel::orderBy('dibuat_pada')->first()->getDiperbaruiPada()->diffForHumans(null, true);

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
        ];
        return view('pages.rt.dashboard', $data);
    }
}
