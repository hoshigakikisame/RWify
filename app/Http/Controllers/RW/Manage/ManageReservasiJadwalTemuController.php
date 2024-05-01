<?php

namespace App\Http\Controllers\RW\Manage;

// App
use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\ReservasiJadwalTemuModel;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ManageReservasiJadwalTemuController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function manageReservasiJadwalTemuPage()
    {

        $request = request()->q;
        $paginate = request()->paginate;

        $reservasiJadwalTemuInstances = (new SearchableDecorator(ReservasiJadwalTemuModel::class))->search($request, $paginate);
        $count = ReservasiJadwalTemuModel::all()->count();


        $data = [
            "reservasiJadwalTemuInstances" => $reservasiJadwalTemuInstances,
            "count" => $count
        ];

        return view('pages.rw.manage.reservasiJadwalTemu', $data);
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
            session()->flash('danger', 'Update Failed.');
        } else {
            $reservasiJadwalTemu->setStatus(request()->status);
            $reservasiJadwalTemu->save();

            session()->flash('success', 'Update Success.');
        }

        return redirect()->route('rw.manage.reservasiJadwalTemu.index');
    }
}
