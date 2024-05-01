<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Models\PengaduanModel;

class LayananController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */

    public function pengaduanDetail(int $idPengaduan)
    {
        $pengaduanInstance = PengaduanModel::find($idPengaduan);

        return view('pages.shared.layanan.pengaduan.detail', compact('pengaduanInstance'));
    }
}
