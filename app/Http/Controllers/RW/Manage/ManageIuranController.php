<?php

namespace App\Http\Controllers\RW\Manage;

// App
use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\IuranModel;
use App\Models\PembayaranIuranModel;
use App\Models\UserModel;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ManageIuranController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function manageIuranPage()
    {

        $query = request()->q;
        $filters = request()->filters ?? [];
        $paginate = request()->paginate;

        $iuranInstances = (new SearchableDecorator(IuranModel::class))->search(
            $query, 
            $paginate, 
            ['pembayaranIuran' => PembayaranIuranModel::class], 
            $filters
        );
        $count = IuranModel::count();

        $data = [
            "iuranInstances" => $iuranInstances,
            "count" => $count
        ];

        return view('pages.rw.manage.iuran', $data);
    }


    public function addNewIuran()
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

        $newIuran = IuranModel::create($data);

        if (!$newIuran) {
            session()->flash('danger',['title' => 'Insert Failed.', 'description' => 'Insert Failed.']);
        } else {
            session()->flash('success',['title' => 'Insert Success.', 'description' => 'Insert Success.']);
        }

        return redirect()->route('rw.manage.iuran');
    }

    // update warga with validation
    public function updateIuran()
    {
        request()->validate([
            'status' => 'required',
        ]);

        $idIuran = request()->id_iuran;
        $iuran = IuranModel::find($idIuran);

        if (!$iuran) {
            session()->flash('danger',['title' => 'Update Failed.', 'description' => 'Update Failed.']);
        } else {
            $iuran->setStatus(request()->status);
            $iuran->save();

            session()->flash('success',['title' => 'Update Success.', 'description' => 'Update Success.']);
        }

        //return redirect()->route('rw.manage.iuran');
        return 'done';
    }

    public function deleteIuran()
    {

        request()->validate([
            'id_iuran' => 'required',
        ]);

        $idIuran = request()->id_iuran;

        $iuran = IuranModel::find($idIuran);

        if (!$iuran) {
            session()->flash('danger',['title' => 'Delete Failed', 'description' => 'Delete Failed']);
        } else {
            $iuran->delete();
            session()->flash('success',['title' => 'Delete Success.', 'description' => 'Delete Success.']);
        }

        //return redirect()->route('rw.manage.iuran');
        return 'done';
    }
}
