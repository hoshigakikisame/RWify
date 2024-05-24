<?php

namespace App\Http\Controllers\RT\Layanan;

use App\Http\Controllers\Controller;
use App\Models\PembayaranIuranModel;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Decorators\SearchableDecorator;
use App\Models\PropertiModel;
use App\Models\TipePropertiModel;
use App\Models\UserModel;
use App\Models\IuranModel;
use Carbon\Carbon;

class PembayaranIuranRtController extends Controller
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

        return view('pages.rt.layanan.pembayaranIuran.riwayatPembayaran', $data);
    }

    public function newPembayaranIuranPage()
    {
        $monthlyTotal = 0;
        $ownedPropertiInstances = (new SearchableDecorator(PropertiModel::class))->search(
            '',
            0,
            ['tipeProperti' => TipePropertiModel::class, 'pemilik' => UserModel::class],
            ['nik_pemilik' => request()->user()->nik]
        );

        foreach ($ownedPropertiInstances as $properti) {
            $monthlyTotal += $properti->getTipeProperti()->getIuranPerBulan();
        }

        // TODO: place it under app / config
        $duesStartDate = Carbon::parse("2000-1-1");
        $diffMonthsFromNow = $duesStartDate->diffInMonths(now(), false);

        $selfIuranInstancesCount = (new SearchableDecorator(IuranModel::class))->search(
            '', 
            0, 
            ['pembayaranIuran' => PembayaranIuranModel::class], 
            ['nik_pembayar' => request()->user()->nik]
        )->count();

        $unpaidDueMonths = (int) ($diffMonthsFromNow - $selfIuranInstancesCount);
        $totalUnpaidDueMonths = $unpaidDueMonths * $monthlyTotal;

        $data = [
            'ownedPropertiInstances' => $ownedPropertiInstances,
            'unpaidDueMonths' => $unpaidDueMonths,
            'totalUnpaidDueMonths' => $totalUnpaidDueMonths,
            'monthlyTotal' => $monthlyTotal
        ];

        return view('pages.warga.layanan.pembayaranIuran.new', $data);
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
            session()->flash('danger',['title' => 'Insert Failed', 'description' => 'Insert Failed']);
        } else {
            session()->flash('success',['title' => 'Insert Success', 'description' => 'Insert Success']);
        }

        return redirect()->route('rt.layanan.pembayaranIuran.riwayatPembayaranIuran');
    }
}
