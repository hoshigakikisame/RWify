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
        $paginate = request()->paginate;

        $propertiInstances = (new SearchableDecorator(PropertiModel::class))->search(
            $query, 
            $paginate, 
            [
                'pemilik' => UserModel::class,
                'tipeProperti' => TipePropertiModel::class
            ],
            $filters
        );
        $count = PropertiModel::count();

        $data = [
            "propertiInstances" => $propertiInstances,
            "count" => $count
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
            session()->flash('danger', 'Insert Failed.');
        } else {
            session()->flash('success', 'Insert Success.');
        }

        return redirect()->route('rw.manage.properti.index');
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
            session()->flash('danger', 'Update Failed.');
        } else {
            $properti->setNamaProperti(request()->nama_properti);
            $properti->setIdTipeProperti(request()->id_tipe_properti);
            $properti->setNikPemilik(request()->nik_pemilik);
            $properti->setAlamat(request()->alamat);
            $properti->setLuasTanah(request()->luas_tanah);
            $properti->setLuasBangunan(request()->luas_bangunan);
            $properti->setJumlahKamar(request()->jumlah_kamar);
            $properti->save();

            session()->flash('success', 'Update Success.');
        }

        //return redirect()->route('rw.manage.properti');
        return 'done';
    }

    public function deleteProperti()
    {

        request()->validate([
            'id_properti' => 'required',
        ]);

        $idProperti = request()->id_properti;

        $properti = PropertiModel::find($idProperti);

        if (!$properti) {
            session()->flash('danger', 'Delete Failed');
        } else {
            $properti->delete();
            session()->flash('success', 'Delete Success.');
        }

        //return redirect()->route('rw.manage.properti');
        return 'done';
    }
}
