<?php

namespace App\Http\Controllers\Warga\Layanan;

use App\Http\Controllers\Controller;
use App\Models\PengaduanModel;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Decorators\SearchableDecorator;
use App\Models\UserModel;
use App\Enums\Pengaduan\PengaduanStatusEnum;

class PengaduanWargaController extends Controller
{

    public function pengaduanPage()
    {
        $query = request()->q;
        $filters = request()->filters ?? [];
        $paginate = request()->paginate;

        $pengaduanInstances = (new SearchableDecorator(PengaduanModel::class))->search(
            $query, 
            $paginate, 
            ['user' => UserModel::class], 
            ['nik_pengadu' => request()->user()->getNik(), ...$filters]
        );
        // $count = PengaduanModel::count();
        $count = PengaduanModel::where('nik_pengadu', auth()->user()->nik)->count();


        $data = [
            "pengaduanInstances" => $pengaduanInstances,
            "count" => $count
        ];

        return view('pages.warga.layanan.pengaduan.index', $data);
    }

    public function newPengaduanPage()
    {
        return view('pages.warga.layanan.pengaduan.new');
    }

    public function addNewPengaduan() {
        request()->validate([
            'judul' => 'required',
            'isi' => 'required',
            'image' => "image|mimes:" . config('cloudinary.allowed_mimes'),
        ]);

        $imageUrl = '';

        if (request()->hasFile('image')) {
            /** @var \CloudinaryLabs\CloudinaryLaravel\Model\Media $cloudinaryResponse */
            $cloudinaryResponse = Cloudinary::upload(request()->file('image')->getRealPath());
            $imageUrl = $cloudinaryResponse->getSecurePath();
        }

        $data = [
            'nik_pengadu' => auth()->user()->nik,
            'judul' => request()->judul,
            'isi' => request()->isi,
            'image_url' => $imageUrl,
            'status' => PengaduanStatusEnum::BARU
        ];

        $newUMKM = PengaduanModel::create($data);

        if (!$newUMKM) {
            session()->flash('danger', 'Insert Failed');
        } else {
            session()->flash('success', 'Insert Success');
        }

        return redirect()->route('warga.layanan.pengaduan.index');
    }

    public function deletePengaduan() {
        return 'Delete';
    }
}
