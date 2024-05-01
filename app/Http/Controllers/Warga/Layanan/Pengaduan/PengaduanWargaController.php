<?php

namespace App\Http\Controllers\Warga\Layanan\Pengaduan;

use App\Http\Controllers\Controller;

class PengaduanWargaController extends Controller
{
    public function pengaduanPage()
    {
        return view('pages.warga.layanan.pengaduan');
    }

    public function addNewPengaduan() {
        return 'Add new';
    }

    public function deletePengaduan() {
        return 'Delete';
    }
}
