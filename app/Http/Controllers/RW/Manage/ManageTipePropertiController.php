<?php

namespace App\Http\Controllers\RW\Manage;

// App
use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\TipePropertiModel;
use App\Models\UserModel;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ManageTipePropertiController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function manageTipePropertiPage()
    {

        $query = request()->q;
        $filters = request()->filters ?? [];
        $paginate = request()->paginate;

        $tipePropertiInstances = (new SearchableDecorator(TipePropertiModel::class))->search(
            $query, 
            $paginate, 
            [],
            $filters
        );
        $count = TipePropertiModel::count();

        $data = [
            "tipePropertiInstances" => $tipePropertiInstances,
            "count" => $count
        ];

        return view('pages.rw.manage.tipeProperti', $data);
    }


    public function addNewTipeProperti()
    {
        request()->validate([
            'nama_tipe' => 'required',
            'iuran_per_bulan' => 'required',
        ]);

        $data = [
            'nama_tipe' => request()->nama_tipe,
            'iuran_per_bulan' => request()->iuran_per_bulan,
        ];

        $newTipeProperti = TipePropertiModel::create($data);

        if (!$newTipeProperti) {
            session()->flash('danger', 'Insert Failed.');
        } else {
            session()->flash('success', 'Insert Success.');
        }

        return redirect()->route('rw.manage.tipeProperti.index');
    }

    public function updateTipeProperti()
    {
        request()->validate([
            'id_tipe_properti' => 'required',
            'nama_tipe' => 'required',
            'iuran_per_bulan' => 'required',
        ]);

        $idTipeProperti = request()->id_tipeProperti;
        $tipeProperti = TipePropertiModel::find($idTipeProperti);

        if (!$tipeProperti) {
            session()->flash('danger', 'Update Failed.');
        } else {
            $tipeProperti->setNamaTipe(request()->nama_tipe);
            $tipeProperti->setIuranPerBulan(request()->iuran_per_bulan);
            $tipeProperti->save();

            session()->flash('success', 'Update Success.');
        }

        //return redirect()->route('rw.manage.tipeProperti');
        return 'done';
    }

    public function deleteTipeProperti()
    {

        request()->validate([
            'id_tipe_properti' => 'required',
        ]);

        $idTipeProperti = request()->id_tipe_properti;

        $tipeProperti = TipePropertiModel::find($idTipeProperti);

        if (!$tipeProperti) {
            session()->flash('danger', 'Delete Failed');
        } else {
            $tipeProperti->delete();
            session()->flash('success', 'Delete Success.');
        }

        //return redirect()->route('rw.manage.tipeProperti');
        return 'done';
    }
}
