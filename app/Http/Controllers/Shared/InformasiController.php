<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Models\PengumumanModel;
use App\Models\UmkmModel;
use App\Models\UserModel;
use App\Models\IuranModel;

class InformasiController extends Controller
{
    public function umkmPage()
    {
        $umkmInstances = UmkmModel::all()->sortByDesc('created_at');

        return view('pages.shared.informasi.umkm.index', compact('umkmInstances'));
    }

    public function pengumumanPage()
{
    $pengumumanInstances = PengumumanModel::where('status', 'publish')->orderBy('diperbarui_pada', 'desc')->get();

    return view('pages.shared.informasi.pengumuman.index', compact('pengumumanInstances'));
}


    public function pengumumanDetailPage(int $idPengumuman)
    {
        $pengumumanInstance = PengumumanModel::where('id_pengumuman', $idPengumuman)->first();

        return view('pages.shared.informasi.pengumuman.detail', compact('pengumumanInstance'));
    }

    public function iuranLeaderboardPage()
    {
        $filters = request()->filters ?? [];

        $isDesc = in_array('desc', array_keys($filters)) ? (bool) $filters['desc'] : true;

        $leaderboardUsers = UserModel::withCount('iuran')->get()->sortBy(function ($user) {
            return $user->iuran_count;
        }, SORT_REGULAR, $isDesc);

        $top3LeaderboardUsers = $leaderboardUsers->take(3);
        $leaderboardUsers = $leaderboardUsers->slice(3);

        return view('pages.shared.informasi.iuran.leaderboard', compact('top3LeaderboardUsers', 'leaderboardUsers'));
    }
}
