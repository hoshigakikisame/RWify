<?php

namespace App\Http\Controllers\RW\Manage;

// App
use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\TipePropertiModel;

class ManageTipePropertiController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function manageTipePropertiPage()
    {

        $query = request()->q;
        $filters = request()->filters ?? [];
        $paginate = request()->paginate ?? 5;

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
            session()->flash('danger', ['title' => 'Insert Failed.', 'description' => 'Insert Failed.']);
        } else {
            session()->flash('success', ['title' => 'Insert Success.', 'description' => 'Insert Success.']);
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

        $idTipeProperti = request()->id_tipe_properti;
        $tipeProperti = TipePropertiModel::find($idTipeProperti);

        if (!$tipeProperti) {
            session()->flash('danger', ['title' => 'Update Failed.', 'description' => 'Update Failed.']);
        } else {
            $tipeProperti->setNamaTipe(request()->nama_tipe);
            $tipeProperti->setIuranPerBulan(request()->iuran_per_bulan);
            $tipeProperti->save();

            session()->flash('success', ['title' => 'Update Success.', 'description' => 'Update Success.']);
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
            session()->flash('danger', ['title' => 'Delete Failed', 'description' => 'Delete Failed']);
        } else {
            $tipeProperti->delete();
            session()->flash('success', ['title' => 'Delete Success.', 'description' => 'Delete Success.']);
        }

        //return redirect()->route('rw.manage.tipeProperti');
        return 'done';
    }
}
