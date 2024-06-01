<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Models\PengumumanModel;
use App\Models\UmkmModel;

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
        $pengumumanInstance = PengumumanModel::find($idPengumuman);

        return view('pages.shared.informasi.pengumuman.detail', compact('pengumumanInstance'));
    }

    public function iuranLeaderboardPage()
    {
        return view('pages.shared.informasi.iuran.leaderboard');
    }
}
