<?php

namespace App\Http\Controllers\RW\Manage;

// Illuminate
use Illuminate\Support\Facades\Hash;

// App
use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Enums\User\UserRoleEnum;
use App\Models\PengumumanModel;
use App\Models\UserModel;
use App\Models\NotificationModel;

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
        $paginate = request()->paginate ?? 5;

        $pengumumanInstances = (new SearchableDecorator(PengumumanModel::class))->search($query, $paginate, [], $filters);
        $count = PengumumanModel::all()->count();
        $published = PengumumanModel::where('status', 'publish')->count();

        $data = [
            "pengumumanInstances" => $pengumumanInstances,
            "count" => $count,
            "published" => $published
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
            session()->flash('danger', ['title' => 'Insert Failed.', 'description' => 'Insert Failed.']);
        } else {
            session()->flash('success', ['title' => 'Insert Success.', 'description' => 'Insert Success.']);
        }

        return 'add success';
    }

    // update warga with validation
    public function updatePengumuman()
    {
        request()->validate([
            'id_pengumuman' => 'required',
            'judul' => 'required',
            'konten' => 'required',
        ]);

        $idPengumuman = request()->id_pengumuman;
        $pengumuman = PengumumanModel::find($idPengumuman);

        if (!$pengumuman) {
            session()->flash('danger', ['title' => 'Update Failed.', 'description' => 'Update Failed.']);
        } else {

            $pengumuman->setJudul(request()->judul);
            $pengumuman->setKonten(request()->konten);
            
            if (request()->hasFile('image')) {
                /** @var \CloudinaryLabs\CloudinaryLaravel\Model\Media $cloudinaryResponse */
                $cloudinaryResponse = Cloudinary::upload(request()->file('image')->getRealPath());
                $resultUrl = $cloudinaryResponse->getSecurePath();

                $pengumuman->setImageUrl($resultUrl);
            }
            
            $pengumuman->save();

            session()->flash('success', ['title' => 'Update Success.', 'description' => 'Update Success.']);
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
            session()->flash('danger', ['title' => 'Delete Failed', 'description' => 'Delete Failed']);
        } else {
            $pengumuman->delete();
            session()->flash('success', ['title' => 'Delete Success.', 'description' => 'Delete Success.']);
        }

        return 'delete success';
    }

    public function changeStatusPengumuman()
    {
        request()->validate([
            'id_pengumuman' => 'required',
        ]);

        $idPengumuman = request()->id_pengumuman;
        $pengumuman = PengumumanModel::find($idPengumuman);


        if (!$pengumuman) {
            $pengumuman->getStatus() == 'publish' ? session()->flash('danger', ['title' => 'Update Failed', 'description' => 'Cannot move to draft']) : session()->flash('danger', ['title' => 'Update Failed.', 'description' => 'Cannot publish.']);
        } else {
            $pengumuman->getStatus() == 'publish' ? $pengumuman->setStatus('draft') : $pengumuman->setStatus('publish');
            $pengumuman->save();
            $pengumuman->getStatus() == 'publish' ? session()->flash('success', ['title' => 'Updated', 'description' => 'Publish success.']) : session()->flash('success', ['title' => 'Updated', 'description' => 'Move to draft success.']);
        }

        return $pengumuman->getStatus() == 'publish' ? 'move to draft failed' : 'publish success';
    }
}
