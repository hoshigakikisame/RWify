<?php

namespace App\Http\Controllers\RW\Manage;

// App
use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\PengaduanModel;
use App\Models\UserModel;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ManagePengaduanController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function managePengaduanPage()
    {

        $query = request()->q;
        $filters = request()->filters ?? [];
        $paginate = request()->paginate;

        $pengaduanInstances = (new SearchableDecorator(PengaduanModel::class))->search(
            $query, 
            $paginate, 
            ['user' => UserModel::class], 
            $filters
        );
        $count = PengaduanModel::count();

        $data = [
            "pengaduanInstances" => $pengaduanInstances,
            "count" => $count
        ];

        return view('pages.rw.manage.pengaduan', $data);
    }


    public function addNewPengaduan()
    {
        request()->validate([
            'judul' => 'required',
            'isi' => 'required',
            'image' => "required|image|mimes:" . config('cloudinary.allowed_mimes'),
            'status' => 'required',
        ]);

        /** @var \CloudinaryLabs\CloudinaryLaravel\Model\Media $cloudinaryResponse */
        $cloudinaryResponse = Cloudinary::upload(request()->file('image')->getRealPath());
        $resultUrl = $cloudinaryResponse->getSecurePath();

        $data = [
            'judul' => request()->judul,
            'nik_pengadu' => request()->user()->getNik(),
            'isi' => request()->isi,
            'image_url' => $resultUrl,
            'status' => request()->status,
        ];

        $newPengaduan = PengaduanModel::create($data);

        if (!$newPengaduan) {
            session()->flash('danger',['title' => 'Insert Failed.', 'description' => 'Insert Failed.']);
        } else {
            session()->flash('success',['title' => 'Insert Success.', 'description' => 'Insert Success.']);
        }

        return redirect()->route('rw.manage.pengaduan');
    }

    // update warga with validation
    public function updatePengaduan()
    {
        request()->validate([
            'status' => 'required',
        ]);

        $idPengaduan = request()->id_pengaduan;
        $pengaduan = PengaduanModel::find($idPengaduan);

        if (!$pengaduan) {
            session()->flash('danger',['title' => 'Update Failed.', 'description' => 'Update Failed.']);
        } else {
            $pengaduan->setStatus(request()->status);
            $pengaduan->save();

            session()->flash('success',['title' => 'Update Success.', 'description' => 'Update Success.']);
        }

        //return redirect()->route('rw.manage.pengaduan');
        return 'done';
    }

    public function deletePengaduan()
    {

        request()->validate([
            'id_pengaduan' => 'required',
        ]);

        $idPengaduan = request()->id_pengaduan;

        $pengaduan = PengaduanModel::find($idPengaduan);

        if (!$pengaduan) {
            session()->flash('danger',['title' => 'Delete Failed', 'description' => 'Delete Failed']);
        } else {
            $pengaduan->delete();
            session()->flash('success',['title' => 'Delete Success.', 'description' => 'Delete Success.']);
        }

        //return redirect()->route('rw.manage.pengaduan');
        return 'done';
    }
}
