<?php

namespace App\Http\Controllers\RW\Manage;

// App
use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\PropertiModel;
use App\Models\TipePropertiModel;
use App\Models\UserModel;
use App\Models\NotificationModel;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Date;

class ManagePropertiController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function managePropertiPage()
    {

        $query = request()->q;
        $filters = request()->filters ?? [];
        $paginate = request()->paginate ?? 10;

        $propertiInstances = (new SearchableDecorator(PropertiModel::class))->search(
            $query,
            $paginate,
            [
                'pemilik' => UserModel::class,
                'tipeProperti' => TipePropertiModel::class
            ],
            $filters
        );

        $tipePropertiInstances = array_reduce(TipePropertiModel::all()->toArray(), function ($carry, $item) {
            $carry[$item['id_tipe_properti']] = $item['nama_tipe'];
            return $carry;
        }, []);

        $nikPemilikInstances = array_reduce(UserModel::all()->toArray(), function ($carry, $item) {
            $carry[$item['nik']] = $item['nama_depan'] . ' ' . $item['nama_belakang'];
            return $carry;
        }, []);

        $count = PropertiModel::count();

        $data = [
            "propertiInstances" => $propertiInstances,
            "count" => $count,
            "tipePropertiInstances" => $tipePropertiInstances,
            "nikPemilikInstances" => $nikPemilikInstances,
        ];

        return view('pages.rw.manage.properti', $data);
    }


    public function addNewProperti()
    {
        request()->validate([
            'nama_properti' => 'required',
            'id_tipe_properti' => 'required',
            'nik_pemilik' => 'required',
            'alamat' => 'required',
            'luas_tanah' => 'required',
            'luas_bangunan' => 'required',
            'jumlah_kamar' => 'required',
            'mulai_dimiliki_pada' => 'required',
        ]);

        $data = [
            'nama_properti' => request()->nama_properti,
            'id_tipe_properti' => request()->id_tipe_properti,
            'nik_pemilik' => request()->nik_pemilik,
            'alamat' => request()->alamat,
            'luas_tanah' => request()->luas_tanah,
            'luas_bangunan' => request()->luas_bangunan,
            'jumlah_kamar' => request()->jumlah_kamar,
            'mulai_dimiliki_pada' => request()->mulai_dimiliki_pada,
        ];

        $newProperti = PropertiModel::create($data);

        if (!$newProperti) {
            session()->flash('danger', ['title' => 'Insert Failed.', 'description' => 'Insert Failed.']);
        } else {
            session()->flash('success', ['title' => 'Insert Success.', 'description' => 'Insert Success.']);
            // NotificationModel::new(request()->nik_pemilik, "Properti baru '." . request()->nama_properti . ".' berhasil ditambahkan", route('warga.layanan.properti', [], false));
        }

        return "Add success";
    }

    public function exportCSV()
    {
        $propertiInstances = PropertiModel::with(['pemilik', 'tipeProperti'])->get();

        $csv = 'nama_properti,nama_tipe,nik_pemilik,alamat,luas_tanah,luas_bangunan,jumlah_kamar,mulai_dimiliki_pada' . PHP_EOL;

        foreach ($propertiInstances as $row) {

            $alamat = preg_replace("/\r|\n|,/", "", $row->getAlamat());
            $mulaiDimilikiPada = Date::parse($row->getMulaiDimilikiPada())->format('d-m-Y');

            $csv .= sprintf(
                '%s,%s,%s,%s,%s,%s,%s,%s',
                $row->getNamaProperti(),
                $row->tipeProperti->getNamaTipe(),
                $row->pemilik->getNamaDepan() . ' ' . $row->pemilik->getNamaBelakang(),
                $alamat,
                $row->getLuasTanah(),
                $row->getLuasBangunan(),
                $row->getJumlahKamar(),
                $mulaiDimilikiPada
            ) . PHP_EOL;
        }

        $filename = 'properti_' . date('Y-m-d_H-i-s') . '.csv';

        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        echo $csv;
        exit();
    }

    // update warga with validation
    public function updateProperti()
    {
        request()->validate([
            'id_properti' => 'required',
            'nama_properti' => 'required',
            'id_tipe_properti' => 'required',
            'nik_pemilik' => 'required',
            'alamat' => 'required',
            'luas_tanah' => 'required',
            'luas_bangunan' => 'required',
            'jumlah_kamar' => 'required',
            'mulai_dimiliki_pada' => 'required',
        ]);

        $idProperti = request()->id_properti;
        $properti = PropertiModel::find($idProperti);

        if (!$properti) {
            session()->flash('danger', ['title' => 'Update Failed.', 'description' => 'Update Failed.']);
        } else {
            $properti->setNamaProperti(request()->nama_properti);
            $properti->setIdTipeProperti(request()->id_tipe_properti);
            $properti->setNikPemilik(request()->nik_pemilik);
            $properti->setAlamat(request()->alamat);
            $properti->setLuasTanah(request()->luas_tanah);
            $properti->setLuasBangunan(request()->luas_bangunan);
            $properti->setJumlahKamar(request()->jumlah_kamar);
            $properti->setMulaiDimilikiPada(request()->mulai_dimiliki_pada);
            $properti->save();

            session()->flash('success', ['title' => 'Update Success.', 'description' => 'Update Success.']);
        }

        //return redirect()->route('rw.manage.properti');
        return 'Update success';
    }

    public function deleteProperti()
    {

        request()->validate([
            'id_properti' => 'required',
        ]);

        $idProperti = request()->id_properti;

        $properti = PropertiModel::find($idProperti);

        if (!$properti) {
            session()->flash('danger', ['title' => 'Delete Failed', 'description' => 'Delete Failed']);
        } else {
            $properti->delete();
            session()->flash('success', ['title' => 'Delete Success.', 'description' => 'Delete Success.']);
        }

        //return redirect()->route('rw.manage.properti');
        return 'Delete success';
    }
}
