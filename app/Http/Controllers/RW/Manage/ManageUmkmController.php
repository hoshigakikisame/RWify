<?php

namespace App\Http\Controllers\RW\Manage;

use App\Http\Controllers\Controller;
use App\Models\UmkmModel;
use App\Decorators\SearchableDecorator;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ManageUmkmController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function manageUmkmPage()
    {
        $reqQuery = request()->q;
        $paginate = request()->paginate ?? 10;

        $umkmInstances = (new SearchableDecorator(UmkmModel::class))->search($reqQuery, $paginate);

        $data = [
            "umkmInstances" => $umkmInstances
        ];

        return view('pages.rw.manage.umkm', $data);
    }

    public function addNewUmkm()
    {
        request()->validate([
            'nama' => 'required',
            'image' => "image|mimes:" . config('cloudinary.allowed_mimes'),
            'nama_pemilik' => 'required',
            'alamat' => 'required',
            'map_url' => 'required',
            'telepon' => 'required',
            'instagram_url' => 'required',
            'deskripsi' => 'required',
        ]);

        $imageUrl = '';

        if (request()->hasFile('image')) {
            /** @var \CloudinaryLabs\CloudinaryLaravel\Model\Media $cloudinaryResponse */
            $cloudinaryResponse = Cloudinary::upload(request()->file('image')->getRealPath());
            $imageUrl = $cloudinaryResponse->getSecurePath();
        }

        $data = [
            'nama' => request()->nama,
            'image_url' => $imageUrl,
            'nama_pemilik' => request()->nama_pemilik,
            'alamat' => request()->alamat,
            'map_url' => request()->map_url,
            'telepon' => request()->telepon,
            'instagram_url' => request()->instagram_url,
            'deskripsi' => request()->deskripsi,
        ];

        $newUMKM = UmkmModel::create($data);

        if (!$newUMKM) {
            session()->flash('danger', ['title' => 'Gagal Menambahkan UMKM', 'description' => 'Gagal Menambahkan UMKM']);
        } else {
            session()->flash('success', ['title' => 'Berhasil Menambahkan UMKM', 'description' => 'Berhasil Menambahkan UMKM']);
        }

        return 'success';
    }

    // update UMKM with validation
    public function updateUmkm()
    {
        request()->validate([
            'id_umkm' => 'required',
            'nama' => 'required',
            'image' => "image|mimes:" . config('cloudinary.allowed_mimes'),
            'nama_pemilik' => 'required',
            'alamat' => 'required',
            'map_url' => 'required',
            'telepon' => 'required',
            'instagram_url' => 'required',
            'deskripsi' => 'required',
        ]);

        $idUmkm = request()->id_umkm;
        $umkm = UmkmModel::find($idUmkm);

        if (!$umkm) {
            session()->flash('danger', ['title' => 'Gagal Mengupdate UMKM', 'description' => 'Gagal Mengupdate UMKM']);
        } else {

            if (request()->hasFile('image')) {
                /** @var \CloudinaryLabs\CloudinaryLaravel\Model\Media $cloudinaryResponse */
                $cloudinaryResponse = Cloudinary::upload(request()->file('image')->getRealPath());
                $imageUrl = $cloudinaryResponse->getSecurePath();
                $umkm->setImageUrl($imageUrl);
            }

            $umkm->setNama(request()->nama);
            $umkm->setNamaPemilik(request()->nama_pemilik);
            $umkm->setAlamat(request()->alamat);
            $umkm->setMapUrl(request()->map_url);
            $umkm->setTelepon(request()->telepon);
            $umkm->setInstagramUrl(request()->instagram_url);
            $umkm->setDeskripsi(request()->deskripsi);
            $umkm->save();

            session()->flash('success', ['title' => 'Berhasil Mengupdate UMKM', 'description' => 'Berhasil Mengupdate UMKM']);
        }

        //return redirect()->route('rw.manage.umkm');
        return 'done';
    }

    public function deleteUmkm()
    {
        request()->validate([
            'id_umkm' => 'required',
        ]);

        $idUmkm = request()->id_umkm;
        $umkm = UmkmModel::find($idUmkm);

        if (!$umkm) {
            session()->flash('danger', ['title' => 'Gagal Menghapus UMKM', 'description' => 'Gagal Menghapus UMKM']);
        } else {
            $umkm->delete();
            session()->flash('success', ['title' => 'Berhasil Menghapus UMKM', 'description' => 'Berhasil Menghapus UMKM']);
        }

        //return redirect()->route('rw.manage.umkm');
        return 'delete done';
    }
}
