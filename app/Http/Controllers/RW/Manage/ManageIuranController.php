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
        $paginate = request()->paginate ?? 5;

        $iuranInstances = (new SearchableDecorator(IuranModel::class))->search(
            $query,
            $paginate,
            ['pembayaranIuran' => PembayaranIuranModel::class],
            $filters,
            function (Builder $queryBuilder) {
                // dd($queryBuilder->toRawSql());
            }
        );
        $count = IuranModel::count();

        $data = [
            "iuranInstances" => $iuranInstances,
            "count" => $count
        ];

        return view('pages.rw.manage.iuran', $data);
    }

    public function verifyPembayaranIuranPage()
    {
        $query = request()->q;
        $filters = request()->filters ?? [];
        $paginate = request()->paginate;

        $pembayaranIuranInstances = (new SearchableDecorator(PembayaranIuranModel::class))->search(
            $query,
            $paginate,
            ['user' => UserModel::class],
            $filters,
            function (Builder $queryBuilder) use ($filters) {
                $iuranIds = IuranModel::all()->pluck('id_pembayaran_iuran')->toArray();
                if (array_key_exists('status', $filters)) {
                    if (request()->filters['status'] == 'verified') {
                        $queryBuilder->whereIn('id_pembayaran_iuran', $iuranIds);
                    } else if (request()->filters['status'] == 'unverified') {
                        $queryBuilder->whereNotIn('id_pembayaran_iuran', $iuranIds);
                    }
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

    public function iuranLeaderboardPage()
    {
        return view('pages.rw.manage.leaderboardIuran');
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
            session()->flash('danger', ['title' => 'Insert Failed.', 'description' => 'Insert Failed.']);
        } else {
            session()->flash('success', ['title' => 'Insert Success.', 'description' => 'Insert Success.']);
        }

        return redirect()->route('rw.manage.iuran');
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
