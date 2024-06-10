<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Models\PengaduanModel;

class LayananController extends Controller
{
    public function pengaduanDetail(int $idPengaduan)
    {
        $pengaduanInstance = PengaduanModel::where('id_pengaduan', $idPengaduan);

        return view('pages.shared.layanan.pengaduan.detail', compact('pengaduanInstance'));
    }
}
