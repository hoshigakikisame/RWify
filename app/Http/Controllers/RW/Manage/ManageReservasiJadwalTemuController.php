<?php

namespace App\Http\Controllers\RW\Manage;

// App
use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\ReservasiJadwalTemuModel;
use App\Models\UserModel;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ManageReservasiJadwalTemuController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function manageReservasiJadwalTemuPage()
    {

        $query = request()->q;
        $filters = request()->filters ?? [];
        $paginate = request()->paginate ?? 5;

        $reservasiJadwalTemuInstances = (new SearchableDecorator(ReservasiJadwalTemuModel::class))->search(
            $query,
            $paginate,
            ['pemohon' => UserModel::class],
            ['nik_penerima' => request()->user()->getNik(), ...$filters]
        );
        
        $count = ReservasiJadwalTemuModel::where('nik_penerima', request()->user()->getNik())->count();
        $diterimaCount = ReservasiJadwalTemuModel::where('nik_penerima', request()->user()->getNik())
                                                    ->where('status', 'diterima')
                                                    ->count();

        $data = [
            "reservasiJadwalTemuInstances" => $reservasiJadwalTemuInstances,
            "count" => $count
        ];


        return view('pages.rw.manage.reservasiJadwalTemu', $data, ['diterimaCount' => $diterimaCount]);
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

        if (!$reservasiJadwalTemu) {
            session()->flash('danger', ['title' => 'Update Failed.', 'description' => 'Update Failed.']);
        } else {
            $reservasiJadwalTemu->setStatus(request()->status);
            $reservasiJadwalTemu->save();

            session()->flash('success', ['title' => 'Update Success.', 'description' => 'Update Success.']);
        }

        return redirect()->route('rw.manage.reservasiJadwalTemu.index');
    }
}
