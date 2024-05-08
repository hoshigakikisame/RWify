<?php

namespace App\Http\Controllers\Warga\Layanan;

use App\Enums\User\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\ReservasiJadwalTemuModel;
use App\Models\UserModel;

class ReservasiJadwalTemuWargaController extends Controller
{
    public function reservasiJadwalTemuPage()
    {
        return view('pages.warga.layanan.reservasiJadwalTemu.index');
    }

    public function newReservasiJadwalTemuPage()
    {
        $reservationTargets = UserModel::orWhere('role', UserRoleEnum::KETUA_RUKUN_WARGA)
            ->orWhere('role', UserRoleEnum::KETUA_RUKUN_TETANGGA)
            ->get();
        
        return view('pages.warga.layanan.reservasiJadwalTemu.new', compact('reservationTargets'));
    }

    public function addNewReservasiJadwalTemu() {
        request()->validate([
            'subjek' => 'required',
            'pesan' => 'required',
            'jadwal_temu' => 'required',
            'nik_penerima' => 'required'
        ]);

        $data = [
            'nik_pemohon' => auth()->user()->nik,
            'nik_penerima' => request()->nik_penerima,
            'subjek' => request()->subjek,
            'pesan' => request()->pesan,
            'jadwal_temu' => request()->jadwal_temu,
        ];

        $newReservation = ReservasiJadwalTemuModel::create($data);

        if (!$newReservation) {
            session()->flash('danger', 'Insert Failed');
        } else {
            session()->flash('success', 'Insert Success');
        }

        return redirect()->route('warga.layanan.pengaduan.index');
    }
}
