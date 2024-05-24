<?php

namespace App\Http\Controllers\RT\Manage;

// App
use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\ReservasiJadwalTemuModel;
use App\Models\UserModel;
use App\Models\RukunTetanggaModel;

class ManageReservasiJadwalTemuController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function manageReservasiJadwalTemuPage()
    {
        $ownedRT = RukunTetanggaModel::where('nik_ketua_rukun_tetangga', '=', request()->user()->getNik())->first();

        $query = request()->q;
        $filters = request()->filters ?? [];
        $paginate = request()->paginate;

        $reservasiJadwalTemuInstances = (new SearchableDecorator(ReservasiJadwalTemuModel::class))->search(
            $query, 
            $paginate, 
            ['pemohon' => UserModel::class],
            ['nik_penerima' => request()->user()->getNik(), ...$filters]
        );
        $count = ReservasiJadwalTemuModel::where('nik_penerima', auth()->user()->nik)->count();
        $diterimaCount = ReservasiJadwalTemuModel::where('nik_penerima', auth()->user()->nik)
                                                    ->where('status', 'diterima')
                                                    ->count();

        $data = [
            "reservasiJadwalTemuInstances" => $reservasiJadwalTemuInstances,
            "count" => $count
        ];


        return view('pages.rt.manage.reservasiJadwalTemu', $data, ['diterimaCount' => $diterimaCount]);
    }

    // update reservasi jadwal temu with validation
    public function updateReservasiJadwalTemu()
    {
        request()->validate([
            'idReservasiJadwalTemu' => 'required',
            'status' => 'required',
        ]);

        $idReservasiJadwalTemu = request()->idReservasiJadwalTemu;
        $reservasiJadwalTemu = ReservasiJadwalTemuModel::find($idReservasiJadwalTemu);

        if (!$reservasiJadwalTemu || $reservasiJadwalTemu->getNikPenerima() != request()->user()->getNik()) {
            session()->flash('danger',['title' => 'Update Failed.', 'description' => 'Update Failed.']);
        } else {
            $reservasiJadwalTemu->setStatus(request()->status);
            $reservasiJadwalTemu->save();

            session()->flash('success',['title' => 'Update Success.', 'description' => 'Update Success.']);
        }

        return redirect()->route('rt.manage.reservasiJadwalTemu.index');
    }
}
