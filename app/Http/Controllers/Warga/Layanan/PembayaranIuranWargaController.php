<?php

namespace App\Http\Controllers\Warga\Layanan;

use App\Http\Controllers\Controller;
use App\Models\PembayaranIuranModel;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Decorators\SearchableDecorator;
use App\Models\UserModel;

class PembayaranIuranWargaController extends Controller
{

    public function riwayatPembayaranIuranPage()
    {

        $query = request()->q;
        $filters = request()->filters ?? [];
        $paginate = request()->paginate;

        $pembayaranIuranInstances = (new SearchableDecorator(PembayaranIuranModel::class))->search(
            $query, 
            $paginate, 
            ['user' => UserModel::class],
            ['nik_pembayar' => request()->user()->getNik(), ...$filters]
        );
        // $count = PembayaranIuranModel::count();
        $count = PembayaranIuranModel::where('nik_pembayar', auth()->user()->nik)->count();


        $data = [
            "pembayaranIuranInstances" => $pembayaranIuranInstances,
            "count" => $count
        ];

        return view('pages.warga.layanan.pembayaranIuran.riwayatPembayaran', $data);
    }

    public function newPembayaranIuranPage()
    {
        return view('pages.warga.layanan.pembayaranIuran.new');
    }

    public function addNewPembayaranIuran()
    {
        request()->validate([
            'keterangan' => 'required',
            'image' => 'required|image|mimes:' . config('cloudinary.allowed_mimes'),
        ]);

        $imageUrl = '';

        if (request()->hasFile('image')) {
            /** @var \CloudinaryLabs\CloudinaryLaravel\Model\Media $cloudinaryResponse */
            $cloudinaryResponse = Cloudinary::upload(request()->file('image')->getRealPath());
            $imageUrl = $cloudinaryResponse->getSecurePath();
        }

        $data = [
            'nik_pembayar' => auth()->user()->nik,
            'tanggal_bayar' => now(),
            'image_url' => $imageUrl,
            // 'nkk' => auth()->user()->nkk,
            'keterangan' => request('keterangan'),
        ];

        $newIuran = PembayaranIuranModel::create($data);

        if (!$newIuran) {
            session()->flash('danger', 'Insert Failed');
        } else {
            session()->flash('success', 'Insert Success');
        }

        return redirect()->route('warga.layanan.pembayaranIuran.riwayatPembayaranIuran');
    }
}
