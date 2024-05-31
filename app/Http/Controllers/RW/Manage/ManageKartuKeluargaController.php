<?php

namespace App\Http\Controllers\RW\Manage;

// Illuminate
use Illuminate\Support\Facades\Hash;

// App
use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\KartuKeluargaModel;
use App\Models\RukunTetanggaModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Validator;
use PDOException;

class ManageKartuKeluargaController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */

    public function manageKartuKeluargaPage()
    {
        $query = request()->q;
        $paginate = request()->paginate ?? 5;
        $filters = request()->filters ?? [];

        $kartuKeluargaInstances = (new SearchableDecorator(KartuKeluargaModel::class))->search($query, $paginate, [], $filters);

        $count = KartuKeluargaModel::count();

        $data = [
            "kartuKeluargaInstances" => $kartuKeluargaInstances,
            "count" => $count
        ];

        return view('pages.rw.manage.kartuKeluarga', $data);
    }

    public function addNewKartuKeluarga()
    {
        request()->validate([
            'nkk' => 'required',
            'alamat' => 'required',
            'id_rukun_tetangga' => 'required',
            'tagihan_listrik_per_bulan' => 'required',
            'jumlah_pekerja' => 'required',
            'total_penghasilan_per_bulan' => 'required',
            'total_pajak_per_tahun' => 'required',
            'total_properti_dimiliki' => 'required',
            'tagihan_air_per_bulan' => 'required',
        ]);

        $data = [
            'nkk' => request()->nkk,
            'alamat' => request()->alamat,
            'id_rukun_tetangga' => request()->id_rukun_tetangga,
            'tagihan_listrik_per_bulan' => request()->tagihan_listrik_per_bulan,
            'jumlah_pekerja' => request()->jumlah_pekerja,
            'total_penghasilan_per_bulan' => request()->total_penghasilan_per_bulan,
            'total_pajak_per_tahun' => request()->total_pajak_per_tahun,
            'total_properti_dimiliki' => request()->total_properti_dimiliki,
            'tagihan_air_per_bulan' => request()->tagihan_air_per_bulan,
        ];

        $newUser = UserModel::create($data);

        if (!$newUser) {
            session()->flash('danger', ['title' => 'Gagal menambahkan kartu keluarga baru.', 'description' => 'Gagal menambahkan kartu keluarga baru.']);
        } else {
            session()->flash('success', ['title' => 'Berhasil menambahkan kartu keluarga baru.', 'description' => 'Berhasil menambahkan kartu keluarga baru.']);
        }

        // return redirect()->route('rw.manage.warga.warga');
        return 'completed';
    }

    public function importCSV()
    {
        request()->validate([
            'csv' => 'required|mimes:csv,txt'
        ]);

        $csv = request()->file('csv');

        $csvData = array_map('str_getcsv', file($csv));

        $header = array_map('strtolower', $csvData[0]);

        $csvData = array_slice($csvData, 1);

        $data = [];

        foreach ($csvData as $row) {
            $data[] = array_combine($header, $row);
        }

        $rukunTetanggaInstances = [];

        RukunTetanggaModel::all()->each(function ($row) use (&$rukunTetanggaInstances) {
            $rukunTetanggaInstances[$row['nomor_rukun_tetangga']] = $row['id_rukun_tetangga'];
        });

        $newUsers = [];

        $i = 1;
        foreach ($data as $row) {
            $validate = Validator::make($row, [
                'nik' => 'required',
                'nkk' => 'required',
                'email' => 'required',
                'password' => 'required',
                'nama_depan' => 'required',
                'nama_belakang' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'agama' => '',
                'status_perkawinan' => 'required',
                'pekerjaan' => '',
                'role' => 'required',
                'jenis_kelamin' => 'required',
                'golongan_darah' => 'required',
                'alamat' => 'required',
                'rt' => 'required',
            ]);

            if ($validate->fails()) {
                $description = '';
                foreach ($validate->errors()->all() as $error) {
                    $description .= $error . ' ';
                }
                session()->flash('danger', [
                    'title' => sprintf('Gagal mengimport warga pada baris %d', $i),
                    'description' => $description
                ]);
                return redirect()->route('rw.manage.warga.warga');
            }

            array_push($newUsers, [
                'nik' => $row['nik'],
                'nkk' => $row['nkk'],
                'email' => $row['email'],
                'password' => Hash::make($row['password']),
                'nama_depan' => $row['nama_depan'],
                'nama_belakang' => $row['nama_belakang'],
                'tempat_lahir' => $row['tempat_lahir'],
                'tanggal_lahir' => date('Y-m-d', strtotime($row['tanggal_lahir'])),
                'agama' => $row['agama'],
                'status_perkawinan' => $row['status_perkawinan'],
                'pekerjaan' => $row['pekerjaan'],
                'role' => $row['role'],
                'jenis_kelamin' => $row['jenis_kelamin'],
                'golongan_darah' => $row['golongan_darah'],
                'alamat' => $row['alamat'],
                'id_rukun_tetangga' => $rukunTetanggaInstances[$row['rt']]
            ]);

            $i++;
        }

        try {
            $newUsers = UserModel::insert($newUsers);
        } catch (PDOException $e) {
            session()->flash('danger', [
                'title' => sprintf('Gagal mengimport warga'),
                'description' => $e->errorInfo[2]
            ]);
            return redirect()->route('rw.manage.warga.warga');
        }

        if (!$newUsers) {
            session()->flash('danger', ['title' => 'Gagal mengimport warga.', 'description' => 'Gagal mengimport warga.']);
        } else {
            session()->flash('success', ['title' => 'Berhasil mengimport warga.', 'description' => 'Berhasil mengimport warga.']);
        }

        return redirect()->route('rw.manage.warga.warga');
    }

    // update warga with validation
    public function updateKartuKeluarga()
    {
        request()->validate([
            'nkk' => 'required',
            'alamat' => 'required',
            'id_rukun_tetangga' => 'required',
            'tagihan_listrik_per_bulan' => 'required',
            'jumlah_pekerja' => 'required',
            'total_penghasilan_per_bulan' => 'required',
            'total_pajak_per_tahun' => 'required',
            'total_properti_dimiliki' => 'required',
            'tagihan_air_per_bulan' => 'required',
        ]);

        $nik = request()->nik;
        $user = UserModel::find($nik);

        if (!$user) {
            session()->flash('danger', ['title' => 'Gagal mengupdate kartu keluarga.', 'description' => 'Gagal mengupdate kartu keluarga.']);
        } else {
            $user->setNkk(request()->nkk);
            $user->setAlamat(request()->alamat);
            $user->setIdRukunTetangga(request()->id_rukun_tetangga);
            $user->setTagihanListrikPerBulan(request()->tagihan_listrik_per_bulan);
            $user->setJumlahPekerja(request()->jumlah_pekerja);
            $user->setTotalPenghasilanPerBulan(request()->total_penghasilan_per_bulan);
            $user->setTotalPajakPerTahun(request()->total_pajak_per_tahun);
            $user->setTotalPropertiDimiliki(request()->total_properti_dimiliki);
            $user->setTagihanAirPerBulan(request()->tagihan_air_per_bulan);

            $user->save();

            session()->flash('success', ['title' => 'Berhasil mengupdate kartu keluarga.', 'description' => 'Berhasil mengupdate kartu keluarga.']);
        }

        // return redirect()->route('rw.manage.warga.warga');
        return 'done';
    }

    public function deleteKartuKeluarga()
    {

        request()->validate([
            'nkk' => 'required'
        ]);

        $nik = request()->nik;

        $kartuKeluargaInstance = KartuKeluargaModel::find($nik);

        if (!$kartuKeluargaInstance) {
            session()->flash('danger', ['title' => 'Gagal menghapus kartu keluarga.', 'description' => 'Gagal menghapus kartu keluarga.']);
        } else {
            $kartuKeluargaInstance->delete();
            session()->flash('success', ['title' => 'Berhasil menghapus kartu keluarga.', 'description' => 'Berhasil menghapus kartu keluarga.']);
        }

        // return redirect()->route('rw.manage.warga.warga');
        return 'completed';
    }
}
