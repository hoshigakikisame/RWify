<?php

namespace App\Http\Controllers\RW\Manage;

use App\Http\Controllers\Controller;
use App\Models\UmkmModel;
use Illuminate\Http\Request;

class ManageUmkmController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function manageUmkmPage()
    {
        $umkmInstances = UmkmModel::all();
        
        $data = [
            "umkmInstances" => $umkmInstances
        ];

        return view('rw.manage.umkm', $data);
    }

    public function addNewUmkm()
    {
        request()->validate([
            'nama' => 'required',
            'path_gambar' => 'required',
            'nama_pemilik' => 'required',
            'alamat' => 'required',
            'map_url' => 'required',
            'telepon' => 'required',
            'instagram_url' => 'required',
            'deskripsi' => 'required',
        ]);
        
        $data = [
            'nama' => request()->nama,
            'path_gambar' => request()->path_gambar,
            'nama_pemilik' => request()->nama_pemilik,
            'alamat' => request()->alamat,
            'map_url' => request()->map_url,
            'telepon' => request()->telepon,
            'instagram_url' => request()->instagram_url,
            'deskripsi' => request()->deskripsi,
        ];

        $newUMKM = UmkmModel::create($data);

        if(!$newUMKM) {
            session()->flash('alert-danger', 'Insert Failed.');
        } else {
            session()->flash('alert-success', 'Insert Success.');
        }

        return redirect()->route('rw.manage.umkm');
    }

    // update UMKM with validation
    public function updateUmkm()
    {
        request()->validate([
            'id_umkm' => 'required',
            'nama' => 'required',
            'path_gambar' => 'required',
            'nama_pemilik' => 'required',
            'alamat' => 'required',
            'map_url' => 'required',
            'telepon' => 'required',
            'instagram_url' => 'required',
            'deskripsi' => 'required',
        ]);
        
        $idUmkm = request()->id_umkm;
        $umkm = UmkmModel::find($idUmkm);

        if(!$umkm){
            session()->flash('alert-danger', 'Update Failed.');
        } else {
            $umkm->nama = request()->nama;
            $umkm->path_gambar = request()->path_gambar;
            $umkm->nama_pemilik = request()->nama_pemilik;
            $umkm->alamat = request()->alamat;
            $umkm->map_url = request()->map_url;
            $umkm->telepon = request()->telepon;
            $umkm->instagram_url = request()->instagram_url;
            $umkm->deskripsi = request()->deskripsi;
            $umkm->save();

            session()->flash('alert-success', 'Update Success.');   
        }

        return redirect()->route('rw.manage.umkm');
    }

    public function deleteUmkm()
    {
        request()->validate([
            'id_umkm' => 'required',
        ]);

        $idUmkm = request()->id_umkm;
        $umkm = UmkmModel::find($idUmkm);

        if(!$umkm) {
            session()->flash('alert-danger', 'Delete Failed.');
        } else {
            $umkm->delete();
            session()->flash('alert-success', 'Delete Success.');
        }

        return redirect()->route('rw.manage.umkm');
    }
}
