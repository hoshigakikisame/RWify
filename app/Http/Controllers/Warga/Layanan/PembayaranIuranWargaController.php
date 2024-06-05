<?php

namespace App\Http\Controllers\Warga\Layanan;

use App\Http\Controllers\Controller;
use App\Models\PembayaranIuranModel;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Decorators\SearchableDecorator;
use App\Models\PropertiModel;
use App\Models\TipePropertiModel;
use App\Models\UserModel;
use App\Models\IuranModel;
use App\Models\NotificationModel;
use Carbon\Carbon;

class PembayaranIuranWargaController extends Controller
{

    public function iuran()
    {
        $query = request()->q;
        $filters = request()->filters ?? [];
        $paginate = request()->paginate ?? 10;

        $iuranInstances = (new SearchableDecorator(IuranModel::class))->search(
            $query,
            $paginate,
            ['pembayaranIuran' => PembayaranIuranModel::class],
            ['nik_pembayar' => request()->user()->getNik(), ...$filters],
        );
        $count = IuranModel::where('nik_pembayar', auth()->user()->nik)->count();

        $data = [
            "iuranInstances" => $iuranInstances,
            "count" => $count
        ];

        return view('pages.warga.layanan.pembayaranIuran.iuran', $data);
    }
    
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

        $monthlyTotal = 0;
        $ownedPropertiInstances = (new SearchableDecorator(PropertiModel::class))->search(
            '',
            0,
            ['tipeProperti' => TipePropertiModel::class, 'pemilik' => UserModel::class],
            ['nik_pemilik' => request()->user()->nik]
        );

        $oldestMonthDiff = 0;
        $totalUnpaidDueMonths = 0;

        foreach ($ownedPropertiInstances as $properti) {
            $monthlyTotal += $properti->getTipeProperti()->getIuranPerBulan();
            $monthDiff = $properti->getMulaiDimilikiPada()->diffInMonths(now(), false);
            $oldestMonthDiff = floor($monthDiff > $oldestMonthDiff ? $monthDiff : $oldestMonthDiff);
            $totalUnpaidDueMonths += $monthDiff * $properti->getTipeProperti()->getIuranPerBulan();
        }

        $data = [
            'ownedPropertiInstances' => $ownedPropertiInstances,
            'oldestMonthDiff' => $oldestMonthDiff,
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

        // current ketua rukun warga
        $ketuaRW = request()->user()->getKetuaRukunWarga();

        // send notification to ketua rukun warga
        NotificationModel::new($ketuaRW->getNik(), request()->user()->getNamaLengkap() . ' telah melakukan pembayaran iuran.', route('rw.manage.iuran.verify', [], false));

        return redirect()->route('warga.layanan.pembayaranIuran.riwayatPembayaranIuran');
    }
}
