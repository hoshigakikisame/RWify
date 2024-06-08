<?php

namespace App\Http\Controllers\RT;

use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\PengaduanModel;
use App\Models\RukunTetanggaModel;
use App\Models\UmkmModel;
use App\Models\UserModel;
use App\Models\PropertiModel;
use \Illuminate\Database\Eloquent\Builder;
use App\Models\ReservasiJadwalTemuModel;

class RTController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function dashboard()
    {
        $ownedRT = RukunTetanggaModel::where('nik_ketua_rukun_tetangga', '=', request()->user()->getNik())->first();

        $lansiaCount = UserModel::withWhereHas('kartuKeluarga', function (Builder $query) use ($ownedRT) {
            $query->where('tb_kartu_keluarga.id_rukun_tetangga', '=', $ownedRT->getIdRukunTetangga());
        })->whereYear('tanggal_lahir', '<', date('Y') - 45)->count();

        $dewasaCount = UserModel::withWhereHas('kartuKeluarga', function (Builder $query) use ($ownedRT) {
            $query->where('tb_kartu_keluarga.id_rukun_tetangga', '=', $ownedRT->getIdRukunTetangga());
        })->whereYear('tanggal_lahir', '>=', date('Y') - 45)->whereYear('tanggal_lahir', '<', date('Y') - 25)->count();

        $remajaCount = UserModel::join('tb_kartu_keluarga', 'tb_kartu_keluarga.nkk', '=', 'tb_user.nkk')
            ->where('tb_kartu_keluarga.id_rukun_tetangga', '=', $ownedRT->getIdRukunTetangga())->whereYear('tanggal_lahir', '>=', date('Y') - 25)->whereYear('tanggal_lahir', '<', date('Y') - 11)->count();

        $anakCount = UserModel::join('tb_kartu_keluarga', 'tb_kartu_keluarga.nkk', '=', 'tb_user.nkk')
            ->where('tb_kartu_keluarga.id_rukun_tetangga', '=', $ownedRT->getIdRukunTetangga())->whereYear('tanggal_lahir', '>=', date('Y') - 11)->whereYear('tanggal_lahir', '<', date('Y') - 5)->count();

        $balitaCount = UserModel::join('tb_kartu_keluarga', 'tb_kartu_keluarga.nkk', '=', 'tb_user.nkk')
            ->where('tb_kartu_keluarga.id_rukun_tetangga', '=', $ownedRT->getIdRukunTetangga())->whereYear('tanggal_lahir', '>=', date('Y') - 5)->whereYear('tanggal_lahir', '<', date('Y'))->count();

        $umkmCount = UmkmModel::count();
        $pengaduanCount = PengaduanModel::count();
        $propertiCount = PropertiModel::withWhereHas('pemilik.kartuKeluarga', function (Builder $query) use ($ownedRT) {
            $query->where('id_rukun_tetangga', '=', $ownedRT->getIdRukunTetangga());
        })->count();

        $umkmLastAddedAt = UmkmModel::orderBy('dibuat_pada')->first()->getDiperbaruiPada()->diffForHumans(null, true);
        $pengaduanLastAddedAt = PengaduanModel::orderBy('dibuat_pada')->first()->getDiperbaruiPada()->diffForHumans(null, true);
        $propertiLastAddedAt = PropertiModel::orderBy('dibuat_pada')->first()->getDiperbaruiPada()->diffForHumans(null, true);

        $reservasiJadwalTemuInstances = ReservasiJadwalTemuModel::where('nik_penerima', request()->user()->getNik())->get();

        $leaderboardUsers = UserModel::withCount('iuran')->get()->sortBy(function ($user) {
            return $user->iuran_count;
        }, SORT_REGULAR, true);

        $leaderboardUsers = $leaderboardUsers->take(10);


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
            'unreadNotifications' => request()->user()->getUnreadNotifications(),
        ];
        return view('pages.rt.dashboard', $data);
    }
}
