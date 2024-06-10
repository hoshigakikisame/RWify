<?php

namespace App\Http\Controllers\RW\Manage;

// illuminate
use \Illuminate\Database\Eloquent\Builder;

// App
use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\IuranModel;
use App\Models\PembayaranIuranModel;
use App\Models\UserModel;
use App\Enums\Iuran\IuranBulanEnum;
use App\Enums\User\UserRoleEnum;
use App\Models\NotificationModel;
use Illuminate\Support\Facades\Date;

class ManageIuranController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function manageIuranPage()
    {
        $query = request()->q;
        $filters = request()->filters ?? [];
        $paginate = request()->paginate ?? 10;

        $iuranInstances = (new SearchableDecorator(IuranModel::class))->search(
            $query,
            $paginate,
            [
                'pembayaranIuran' => PembayaranIuranModel::class,
                'user' => UserModel::class
            ],
            $filters
        );
        $count = IuranModel::count();

        $nikPemilikInstances = array_reduce(UserModel::all()->toArray(), function ($carry, $item) {
            $carry[$item['nik']] = $item['nama_depan'] . ' ' . $item['nama_belakang'];
            return $carry;
        }, []);

        $data = [
            "iuranInstances" => $iuranInstances,
            "count" => $count,
            "nikPemilikInstances" => $nikPemilikInstances,
        ];

        return view('pages.rw.manage.iuran', $data);
    }

    public function verifyPembayaranIuranPage()
    {
        $query = request()->q;
        $filters = request()->filters ?? [];
        $paginate = request()->paginate;

        $status = array_key_exists('status', $filters) ? $filters['status'] : null;

        if (array_key_exists('status', $filters)) {
            unset($filters['status']);
        }

        $pembayaranIuranInstances = (new SearchableDecorator(PembayaranIuranModel::class))->search(
            $query,
            $paginate,
            ['user' => UserModel::class],
            $filters,

            function (Builder $queryBuilder) use ($status) {
                $iuranIds = IuranModel::all()->pluck('id_pembayaran_iuran')->toArray();
                if ($status == 'verified') {
                    $queryBuilder->whereIn('id_pembayaran_iuran', $iuranIds);
                } else if ($status == 'unverified') {
                    $queryBuilder->whereNotIn('id_pembayaran_iuran', $iuranIds);
                }
            }
        );

        $count = PembayaranIuranModel::count();

        $data = [
            "pembayaranIuranInstances" => $pembayaranIuranInstances,
            "count" => $count
        ];

        return view('pages.rw.manage.verifyPembayaranIuran', $data);
    }


    public function addNewIuran()
    {
        request()->validate([
            'id_pembayaran_iuran' => 'nullable',
            'nik_pembayar' => 'required',
            'bulan' => [
                'required',
                'in:' . implode(',', IuranBulanEnum::getValues())
            ],
            'tahun' => [
                'required',
                'regex:/^(19|20)[0-9]{2}/'
            ],
            'jumlah_bayar' => 'required',
        ]);

        $idPembayaranIuran = request()->id_pembayaran_iuran;
        $nikPembayar = request()->nik_pembayar;
        $tahun = request()->tahun;
        $bulan = request()->bulan;
        $jumlahBayar = request()->jumlah_bayar;

        if (IuranModel::where('bulan', $bulan)->where('tahun', $tahun)->where('nik_pembayar', $nikPembayar)->exists()) {
            session()->flash('danger', [
                'title' => 'Insert Failed.',
                'description' => "Tagihan $nikPembayar pada bulan $bulan tahun $tahun sudah diverifikasi sebelumnya."
            ]);
            return redirect()->route('rw.manage.iuran.verify');
        }

        $data = [
            'id_pembayaran_iuran' => $idPembayaranIuran,
            'nik_pembayar' => $nikPembayar,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'jumlah_bayar' => $jumlahBayar,
        ];

        $newIuran = IuranModel::create($data);

        if (!$newIuran) {
            session()->flash('danger', ['title' => 'Insert Failed.', 'description' => 'Insert Failed.']);
        } else {
            session()->flash('success', ['title' => 'Insert Success.', 'description' => 'Insert Success.']);


            // notification redirect route based on role
            $relatedUserRole = UserModel::where('nik', $nikPembayar)->first()->getRole();
            $slug = route('warga.layanan.pembayaranIuran.iuran', [], false);
            switch ($relatedUserRole) {
                case UserRoleEnum::KETUA_RUKUN_WARGA->value:
                    $slug = route('rw.manage.iuran.index', [], false);
                    break;
                case UserRoleEnum::KETUA_RUKUN_TETANGGA->value:
                    $slug = route('rt.layanan.pembayaranIuran.iuran', [], false);
                    break;
            }

            NotificationModel::new($nikPembayar, 'Pembayaran iuran anda pada bulan ' . $bulan . ' tahun ' . $tahun . ' berhasil diverifikasi.', $slug);
        }

        // return redirect()->route('rw.manage.iuran.verify');
        return 'add iuran success';
    }

    public function exportCSV()
    {
        $iuranInstances = IuranModel::all();

        $csv = 'nik_pembayar,bulan,tahun,jumlah_bayar,tanggal_bayar' . PHP_EOL;

        foreach ($iuranInstances as $row) {

            $mulaiDimilikiPada = Date::parse($row->getDibuatPada())->format('d-m-Y');

            $csv .= sprintf(
                '%s,%s,%s,%s,%s',
                $row->getNikPembayar(),
                $row->getBulan(),
                $row->getTahun(),
                $row->getJumlahBayar(),
                $mulaiDimilikiPada
            ) . PHP_EOL;
        }

        $filename = 'iuran_' . date('Y-m-d_H-i-s') . '.csv';

        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        echo $csv;
        exit();
    }

    // update warga with validation
    public function updateIuran()
    {
        request()->validate([
            'id_iuran' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
        ]);

        $idIuran = request()->id_iuran;
        $iuran = IuranModel::find($idIuran);

        if (!$iuran) {
            session()->flash('danger', ['title' => 'Update Failed.', 'description' => 'Update Failed.']);
        } else {
            $iuran->setBulan(request()->bulan);
            $iuran->setTahun(request()->tahun);
            $iuran->save();

            session()->flash('success', ['title' => 'Update Success.', 'description' => 'Update Success.']);
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
            session()->flash('danger', ['title' => 'Delete Failed', 'description' => 'Delete Failed']);
        } else {
            $iuran->delete();
            session()->flash('success', ['title' => 'Delete Success.', 'description' => 'Delete Success.']);
        }

        //return redirect()->route('rw.manage.iuran');
        return 'done';
    }
}
