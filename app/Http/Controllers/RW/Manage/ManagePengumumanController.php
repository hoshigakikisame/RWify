<?php

namespace App\Http\Controllers\RW\Manage;

// Illuminate
use Illuminate\Support\Facades\Hash;

// App
use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\PengumumanModel;
use App\Models\UserModel;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ManagePengumumanController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function managePengumumanPage()
    {

        $query = request()->q;
        $filters = request()->filters ?? [];
        $paginate = request()->paginate;

        $pengumumanInstances = (new SearchableDecorator(PengumumanModel::class))->search($query, $paginate, [], $filters);
        $count = PengumumanModel::all()->count();

        $data = [
            "pengumumanInstances" => $pengumumanInstances,
            "count" => $count,
        ];

        return view('pages.rw.manage.pengumuman', $data);
    }

    public function addNewPengumuman()
    {
        request()->validate([
            'judul' => 'required',
            'image' => "required|image|mimes:" . config('cloudinary.allowed_mimes'),
            'konten' => 'required',
        ]);

        /** @var \CloudinaryLabs\CloudinaryLaravel\Model\Media $cloudinaryResponse */
        $cloudinaryResponse = Cloudinary::upload(request()->file('image')->getRealPath());
        $resultUrl = $cloudinaryResponse->getSecurePath();

        $data = [
            'judul' => request()->judul,
            'image_url' => $resultUrl,
            'konten' => request()->konten,
        ];

        $newPengumuman = PengumumanModel::create($data);

        if (!$newPengumuman) {
            session()->flash('danger', 'Insert Failed.');
        } else {
            session()->flash('success', 'Insert Success.');
        }

        return 'add success';
    }

    // update warga with validation
    public function updatePengumuman()
    {
        request()->validate([
            'id_pengumuman' => 'required',
            'judul' => 'required',
            'image' => "required|image|mimes:" . config('cloudinary.allowed_mimes'),
            'konten' => 'required',
        ]);

        $idPengumuman = request()->id_pengumuman;
        $pengumuman = PengumumanModel::find($idPengumuman);

        if (!$pengumuman) {
            session()->flash('danger', 'Update Failed.');
        } else {

            /** @var \CloudinaryLabs\CloudinaryLaravel\Model\Media $cloudinaryResponse */
            $cloudinaryResponse = Cloudinary::upload(request()->file('image')->getRealPath());
            $resultUrl = $cloudinaryResponse->getSecurePath();

            $pengumuman->setJudul(request()->judul);
            $pengumuman->setImageUrl($resultUrl);
            $pengumuman->setKonten(request()->konten);
            $pengumuman->save();

            session()->flash('success', 'Update Success.');
        }

        return 'update success';
    }

    public function deletePengumuman()
    {

        request()->validate([
            'id_pengumuman' => 'required',
        ]);

        $idPengumuman = request()->id_pengumuman;

        $pengumuman = PengumumanModel::find($idPengumuman);

        if (!$pengumuman) {
            session()->flash('danger', 'Delete Failed');
        } else {
            $pengumuman->delete();
            session()->flash('success', 'Delete Success.');
        }

        return 'delete success';
    }
}
