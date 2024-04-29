<?php

namespace App\Http\Controllers\RW\Manage;

// Illuminate
use Illuminate\Support\Facades\Hash;

// App
use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\PengaduanModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;

class ManagePengaduanController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function managePengaduanPage()
    {

        $request = request()->q;
        $paginate = request()->paginate;

        $pengaduanInstances = (new SearchableDecorator(PengaduanModel::class))->search($request, $paginate);
        
        
        $data = [
            "pengaduanInstances" => $pengaduanInstances
        ];

        return view('rw.manage.pengaduan', $data);
    }

    public function addNewPengaduan()
    {
        request()->validate([
            'judul' => 'required',
            'isi' => 'required',
            'path_gambar' => '',
            'status' => 'required',
        ]);
        
        $data = [
            'judul' => request()->judul,
            'nik_pengadu' => request()->user()->getNik(),
            'isi' => request()->isi,
            'path_gambar' => request()->path_gambar,
            'status' => request()->status,
        ];

        $newPengaduan = PengaduanModel::create($data);

        if(!$newPengaduan) {
            session()->flash('danger', 'Insert Failed.');
        } else {
            session()->flash('success', 'Insert Success.');
        }

        return redirect()->route('rw.manage.pengaduan');
    }

    // update warga with validation
    public function updatePengaduan()
    {
        request()->validate([
            'id_pengaduan' => 'required',
            'judul' => 'required',
            'isi' => 'required',
            'path_gambar' => '',
            'status' => 'required',
        ]);

        $idPengaduan = request()->id_pengaduan;
        $pengaduan = PengaduanModel::find($idPengaduan);

        if(!$pengaduan) {
            session()->flash('danger', 'Update Failed.');
        } else {
            $pengaduan->judul = request()->judul;
            $pengaduan->isi = request()->isi;
            $pengaduan->path_gambar = request()->path_gambar;
            $pengaduan->status = request()->status;
            $pengaduan->save();

            session()->flash('success', 'Update Success.');
        }

        return redirect()->route('rw.manage.pengaduan');
    }

    public function deletePengaduan()
    {

        request()->validate([
            'id_pengaduan' => 'required',
        ]);

        $idPengaduan = request()->id_pengaduan;

        $pengaduan = PengaduanModel::find($idPengaduan);

        if(!$pengaduan) {
            session()->flash('danger', 'Delete Failed');
        } else {
            $pengaduan->delete();
            session()->flash('success', 'Delete Success.');
        }

        return redirect()->route('rw.manage.pengaduan');
    }
}
