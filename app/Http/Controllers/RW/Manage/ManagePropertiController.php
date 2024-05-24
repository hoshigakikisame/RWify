<?php

namespace App\Http\Controllers\RW\Manage;

// App
use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\PropertiModel;
use App\Models\TipePropertiModel;
use App\Models\UserModel;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ManagePropertiController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function managePropertiPage()
    {

        $query = request()->q;
        $filters = request()->filters ?? [];
        $paginate = request()->paginate ?? 5;

        $propertiInstances = (new SearchableDecorator(PropertiModel::class))->search(
            $query,
            $paginate,
            [
                'pemilik' => UserModel::class,
                'tipeProperti' => TipePropertiModel::class
            ],
            $filters
        );

        $tipePropertiInstances = array_reduce(TipePropertiModel::all()->toArray(), function ($carry, $item) {
            $carry[$item['id_tipe_properti']] = $item['nama_tipe'];
            return $carry;
        }, []);

        $count = PropertiModel::count();

        $data = [
            "propertiInstances" => $propertiInstances,
            "count" => $count,
            "tipePropertiInstances" => $tipePropertiInstances
        ];

        return view('pages.rw.manage.properti', $data);
    }


    public function addNewProperti()
    {
        request()->validate([
            'nama_properti' => 'required',
            'id_tipe_properti' => 'required',
            'nik_pemilik' => 'required',
            'alamat' => 'required',
            'luas_tanah' => 'required',
            'luas_bangunan' => 'required',
            'jumlah_kamar' => 'required',
        ]);

        $data = [
            'nama_properti' => request()->nama_properti,
            'id_tipe_properti' => request()->id_tipe_properti,
            'nik_pemilik' => request()->nik_pemilik,
            'alamat' => request()->alamat,
            'luas_tanah' => request()->luas_tanah,
            'luas_bangunan' => request()->luas_bangunan,
            'jumlah_kamar' => request()->jumlah_kamar,
        ];

        $newProperti = PropertiModel::create($data);

        if (!$newProperti) {
            session()->flash('danger', ['title' => 'Insert Failed.', 'description' => 'Insert Failed.']);
        } else {
            session()->flash('success', ['title' => 'Insert Success.', 'description' => 'Insert Success.']);
        }

        // return redirect()->route('rw.manage.properti.index');
        return "Add success";
    }

    // update warga with validation
    public function updateProperti()
    {
        request()->validate([
            'id_properti' => 'required',
            'nama_properti' => 'required',
            'id_tipe_properti' => 'required',
            'nik_pemilik' => 'required',
            'alamat' => 'required',
            'luas_tanah' => 'required',
            'luas_bangunan' => 'required',
            'jumlah_kamar' => 'required',
        ]);

        $idProperti = request()->id_properti;
        $properti = PropertiModel::find($idProperti);

        if (!$properti) {
            session()->flash('danger', ['title' => 'Update Failed.', 'description' => 'Update Failed.']);
        } else {
            $properti->setNamaProperti(request()->nama_properti);
            $properti->setIdTipeProperti(request()->id_tipe_properti);
            $properti->setNikPemilik(request()->nik_pemilik);
            $properti->setAlamat(request()->alamat);
            $properti->setLuasTanah(request()->luas_tanah);
            $properti->setLuasBangunan(request()->luas_bangunan);
            $properti->setJumlahKamar(request()->jumlah_kamar);
            $properti->save();

            session()->flash('success', ['title' => 'Update Success.', 'description' => 'Update Success.']);
        }

        //return redirect()->route('rw.manage.properti');
        return 'Update success';
    }

    public function deleteProperti()
    {

        request()->validate([
            'id_properti' => 'required',
        ]);

        $idProperti = request()->id_properti;

        $properti = PropertiModel::find($idProperti);

        if (!$properti) {
            session()->flash('danger', ['title' => 'Delete Failed', 'description' => 'Delete Failed']);
        } else {
            $properti->delete();
            session()->flash('success', ['title' => 'Delete Success.', 'description' => 'Delete Success.']);
        }

        //return redirect()->route('rw.manage.properti');
        return 'Delete success';
    }
}
