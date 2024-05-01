<?php

namespace App\Http\Controllers\Warga\Layanan;

use App\Http\Controllers\Controller;

class ReservasiJadwalTemuWargaController extends Controller
{
    public function reservasiJadwalTemuPage()
    {
        return view('pages.warga.layanan.reservasiJadwalTemu.index');
    }

    public function newReservasiJadwalTemuPage()
    {
        return view('pages.warga.layanan.reservasiJadwalTemu.new');
    }

    public function addNewReservasiJadwalTemu() {
        return 'Add';
    }

    public function deleteReservasiJadwalTemu() {
        return 'Delete';
    }
}
