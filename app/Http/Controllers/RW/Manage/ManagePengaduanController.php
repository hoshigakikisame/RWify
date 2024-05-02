<?php

namespace App\Http\Controllers\RW\Manage;

// App
use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\PengaduanModel;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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
        $count = PengaduanModel::all()->count();


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
            'image' => "image|mimes:" . config('cloudinary.allowed_mimes'),
            'status' => 'required',
        ]);

        $idPengaduan = request()->id_pengaduan;
        $pengaduan = PengaduanModel::find($idPengaduan);

        if (!$pengaduan) {
            session()->flash('danger', 'Update Failed.');
        } else {

            if (request()->hasFile('image')) {
                /** @var \CloudinaryLabs\CloudinaryLaravel\Model\Media $cloudinaryResponse */
                $cloudinaryResponse = Cloudinary::upload(request()->file('image')->getRealPath());
                $resultUrl = $cloudinaryResponse->getSecurePath();
                $pengaduan->setImageUrl($resultUrl);
            }

            $pengaduan->setJudul(request()->judul);
            $pengaduan->setIsi(request()->isi);
            $pengaduan->setStatus(request()->status);
            $pengaduan->save();

            session()->flash('success', 'Update Success.');
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
            session()->flash('danger', 'Delete Failed');
        } else {
            $pengaduan->delete();
            session()->flash('success', 'Delete Success.');
        }

        //return redirect()->route('rw.manage.pengaduan');
        return 'done';
    }
}
