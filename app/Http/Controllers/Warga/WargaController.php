<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\IuranModel;
use App\Models\PengaduanModel;
use App\Models\PropertiModel;
use App\Models\ReservasiJadwalTemuModel;
use App\Enums\ReservasiJadwalTemu\ReservasiJadwalTemuStatusEnum;

class WargaController extends Controller
{
    public function dashboard()
    {

        $reservasiJadwalTemuInstances = ReservasiJadwalTemuModel::where('nik_penerima', request()->user()->getNik())->orWhere('nik_pemohon', request()->user()->getNik())->get();

        $pengduanInstances = PengaduanModel::where('nik_pengadu', request()->user()->getNik()); 
        $lastUpdatedPengaduan = $pengduanInstances->orderBy('dibuat_pada', 'desc')->first()->getDibuatPada()->diffForHumans(null, true);
        $pengaduanCount = $pengduanInstances->count();

        $iuranInstances = IuranModel::where('nik_pembayar', request()->user()->getNik());
        $lastUpdatedIuran = $iuranInstances->orderBy('dibuat_pada', 'desc')->first()->getDibuatPada()->diffForHumans(null, true); 
        $iuranSum = $iuranInstances->sum('jumlah_bayar');

        $ownedPropertiInstances = PropertiModel::where('nik_pemilik', request()->user()->getNik());
        $lastUpdatedProperti = $ownedPropertiInstances->orderBy('dibuat_pada', 'desc')->first()->getDibuatPada()->diffForHumans(null, true);
        $ownedPropertiCount = $ownedPropertiInstances->count();

        $reservasiJadwalTemuInstances = ReservasiJadwalTemuModel::where('nik_pemohon', request()->user()->getNik())->where('status', ReservasiJadwalTemuStatusEnum::DITERIMA)->get();

        $data = [
            'reservasiJadwalTemuInstances' => $reservasiJadwalTemuInstances,
            'unreadNotifications' => request()->user()->getUnreadNotifications(),
            'pengaduanCount' => $pengaduanCount,
            'lastUpdatedPengaduan' => $lastUpdatedPengaduan,

            'iuranSum' => $iuranSum,
            'lastUpdatedIuran' => $lastUpdatedIuran,

            'ownedPropertiCount' => $ownedPropertiCount,
            'lastUpdatedProperti' => $lastUpdatedProperti,
        ];

        return view('pages.warga.dashboard', $data);
    }
}
