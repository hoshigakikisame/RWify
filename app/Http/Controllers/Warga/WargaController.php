<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\ReservasiJadwalTemuModel;

class WargaController extends Controller
{
    public function dashboard()
    {

        $reservasiJadwalTemuInstances = ReservasiJadwalTemuModel::where('nik_penerima', request()->user()->getNik())->orWhere('nik_pemohon', request()->user()->getNik())->get();

        $data = [
            'reservasiJadwalTemuInstances' => $reservasiJadwalTemuInstances,
            'unreadNotifications' => request()->user()->getUnreadNotifications(),
        ];

        return view('pages.warga.dashboard', $data);
    }
}
