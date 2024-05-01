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
        $pengumumanInstances = PengumumanModel::all()->sortByDesc('created_at');

        return view('pages.shared.informasi.pengumuman.index', compact('pengumumanInstances'));
    }

    public function pengumumanDetailPage(int $idPengumuman)
    {
        $pengumumanInstance = PengumumanModel::find($idPengumuman);

        return view('pages.shared.informasi.pengumuman.detail', compact('pengumumanInstance'));
    }
}
