<?php

namespace App\Http\Controllers\RW\Manage;

// Illuminate
use Illuminate\Support\Facades\Hash;

// App
use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\PengumumanModel;
use App\Models\UserModel;


class ManagePengumumanController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function managePengumumanPage()
    {

        $reqQuery = request()->q;

        $pengumumanInstances = (new SearchableDecorator(PengumumanModel::class))->search($reqQuery);
        
        
        $data = [
            "pengumumanInstances" => $pengumumanInstances
        ];

        return view('rw.manage.pengumuman', $data);
    }

    public function addNewPengumuman()
    {
        request()->validate([
            'judul' => 'required',
            'path_gambar' => 'required',
            'konten' => 'required',
        ]);
        
        $data = [
            'judul' => request()->judul,
            'path_gambar' => request()->path_gambar,
            'konten' => request()->konten,
        ];

        $newUser = UserModel::create($data);

        if(!$newUser) {
            session()->flash('alert-danger', 'Insert Failed.');
        } else {
            session()->flash('alert-success', 'Insert Success.');
        }

        return redirect()->route('rw.manage.pengumuman');
    }

    // update warga with validation
    public function updatePengumuman()
    {
        request()->validate([
            'id_pengumuman' => 'required',
            'judul' => 'required',
            'path_gambar' => 'required',
            'konten' => 'required',
        ]);

        $idPengumuman = request()->id_pengumuman;
        $pengumuman = PengumumanModel::find($idPengumuman);

        if(!$pengumuman) {
            session()->flash('alert-danger', 'Update Failed.');
        } else {
            $pengumuman->judul = request()->judul;
            $pengumuman->path_gambar = request()->path_gambar;
            $pengumuman->konten = request()->konten;
            $pengumuman->save();

            session()->flash('alert-success', 'Update Success.');
        }

        return redirect()->route('rw.manage.pengumuman');
    }

    public function deletePengumuman()
    {

        request()->validate([
            'id_pengumuman' => 'required',
        ]);

        $idPengumuman = request()->id_pengumuman;

        $pengumuman = PengumumanModel::find($idPengumuman);

        if(!$pengumuman) {
            session()->flash('alert-danger', 'Delete Failed');
        } else {
            $pengumuman->delete();
            session()->flash('alert-success', 'Delete Success.');
        }

        return redirect()->route('rw.manage.pengumuman');
    }
}
