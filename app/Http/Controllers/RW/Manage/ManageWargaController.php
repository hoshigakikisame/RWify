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
use Exception;
use Illuminate\Support\Facades\Validator;
use PDOException;

class ManageWargaController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */

    public function manageWargaPage()
    {
        $query = request()->q;
        $paginate = request()->paginate ?? 10;
        $filters = request()->filters ?? [];

        $users = (new SearchableDecorator(UserModel::class))->search($query, $paginate, [], $filters);
        $kartuKeluargaInstances = KartuKeluargaModel::all();

        $count = UserModel::count();

        $data = [
            "users" => $users,
            "kartuKeluargaInstances" => $kartuKeluargaInstances,
            "count" => $count
        ];

        return view('pages.rw.manage.warga', $data);
    }

    public function addNewWarga()
    {
        request()->validate([
            'nik' => 'required|min:16|max:16',
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
            'alamat' => 'required'
        ]);

        $data = [
            'nik' => request()->nik,
            'nkk' => request()->nkk,
            'email' => request()->email,
            'password' => Hash::make(request()->password),
            'nama_depan' => request()->nama_depan,
            'nama_belakang' => request()->nama_belakang,
            'tempat_lahir' => request()->tempat_lahir,
            'tanggal_lahir' => request()->tanggal_lahir,
            'agama' => request()->agama,
            'status_perkawinan' => request()->status_perkawinan,
            'pekerjaan' => request()->pekerjaan,
            'role' => request()->role,
            'jenis_kelamin' => request()->jenis_kelamin,
            'golongan_darah' => request()->golongan_darah,
            'alamat' => request()->alamat
        ];

        $newUser = UserModel::create($data);

        if (!$newUser) {
            session()->flash('danger', ['title' => 'Gagal menambahkan warga baru.', 'description' => 'Gagal menambahkan warga baru.']);
        } else {
            session()->flash('success', ['title' => 'Berhasil menambahkan warga baru.', 'description' => 'Berhasil menambahkan warga baru.']);
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

        $newUsers = [];

        $i = 1;
        foreach ($data as $row) {
            $validate = Validator::make($row, [
                'nik' => 'required|min:16|max:16',
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
                return redirect()->route('rw.manage.pendataan.warga.warga');
            }

            $isKartuKeluargaExists = KartuKeluargaModel::where('nkk', $row['nkk'])->exists();
            if (!$isKartuKeluargaExists) {
                session()->flash('danger', [
                    'title' => sprintf('Gagal mengimport warga pada baris %d', $i),
                    'description' => 'Kartu keluarga tidak ditemukan.'
                ]);
                return redirect()->route('rw.manage.pendataan.warga.warga');
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
            return redirect()->route('rw.manage.pendataan.warga.warga');
        }

        if (!$newUsers) {
            session()->flash('danger', ['title' => 'Gagal mengimport warga.', 'description' => 'Gagal mengimport warga.']);
        } else {
            session()->flash('success', ['title' => 'Berhasil mengimport warga.', 'description' => 'Berhasil mengimport warga.']);
        }

        return redirect()->route('rw.manage.pendataan.warga.warga');
    }

    // export
    public function exportCSV()
    {
        $userInstances = UserModel::all();

        $csv = 'nik,nkk,image_url,email,nama_depan,nama_belakang,tempat_lahir,tanggal_lahir,agama,status_perkawinan,pekerjaan,role,jenis_kelamin,golongan_darah,alamat' . PHP_EOL;

        foreach ($userInstances as $row) {
            
            $alamat = preg_replace("/\r|\n|,/", "", $row->getAlamat());

            $csv .= sprintf(
                '%s,%s,%s,%s,%s,%s,%s,%s,%s', 
                $row->getNik(),
                $row->getNkk(),
                $row->getImageUrl(),
                $row->getEmail(),
                $row->getNamaDepan(),
                $row->getNamaBelakang(),
                $row->getTempatLahir(),
                $row->getTanggalLahir(),
                $row->getAgama(),
                $row->getStatusPerkawinan(),
                $row->getPekerjaan(),
                $row->getRole(),
                $row->getJenisKelamin(),
                $row->getGolonganDarah(),
                $alamat
                ) . PHP_EOL;
            }
            
            $filename = 'warga_' . date('Y-m-d_H-i-s') . '.csv';

        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        echo $csv;
        exit();
    }

    // update warga with validation
    public function updateWarga()
    {
        request()->validate([
            'nik' => 'required',
            'nkk' => 'required',
            'email' => 'required',
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'tempat_lahir' => 'required',
            'agama' => 'required',
            'status_perkawinan' => 'required',
            'pekerjaan' => 'required',
            'role' => 'required',
            'jenis_kelamin' => 'required',
            'golongan_darah' => 'required',
            'alamat' => 'required',
        ]);

        $nik = request()->nik;
        $user = UserModel::find($nik);

        if (!$user) {
            session()->flash('danger', ['title' => 'Gagal mengupdate warga.', 'description' => 'Gagal mengupdate warga.']);
        } else {
            $user->setNik(request()->nik);
            $user->setNkk(request()->nkk);
            $user->setEmail(request()->email);
            $user->setNamaDepan(request()->nama_depan);
            $user->setNamaBelakang(request()->nama_belakang);
            $user->setTempatLahir(request()->tempat_lahir);
            $user->setTanggalLahir(request()->tanggal_lahir);
            $user->setAgama(request()->agama);
            $user->setStatusPerkawinan(request()->status_perkawinan);
            $user->setPekerjaan(request()->pekerjaan);
            $user->setRole(request()->role);
            $user->setJenisKelamin(request()->jenis_kelamin);
            $user->setGolonganDarah(request()->golongan_darah);
            $user->setAlamat(request()->alamat);

            if (request()->password) {
                $user->setPassword(Hash::make(request()->password));
            }

            $user->save();

            session()->flash('success', ['title' => 'Berhasil mengupdate warga.', 'description' => 'Berhasil mengupdate warga.']);
        }

        // return redirect()->route('rw.manage.warga.warga');
        return 'done';
    }

    public function deleteWarga()
    {

        request()->validate([
            'nik' => 'required',
        ]);

        $nik = request()->nik;

        $user = UserModel::find($nik);

        if (!$user) {
            session()->flash('danger', ['title' => 'Gagal menghapus warga.', 'description' => 'Gagal menghapus warga.']);
        } else {
            $user->delete();
            session()->flash('success', ['title' => 'Berhasil menghapus warga.', 'description' => 'Berhasil menghapus warga.']);
        }

        // return redirect()->route('rw.manage.warga.warga');
        return 'delete done';
    }
}
