<?php

namespace App\Http\Controllers\RW\Manage;

// Illuminate
use Illuminate\Support\Facades\Hash;

// App
use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\UserModel;

class ManageWargaController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */

    public function manageWargaPage()
    {
        $query = request()->q;
        $paginate = request()->paginate;

        $users = (new SearchableDecorator(UserModel::class))->search($query, $paginate);

        $count = UserModel::all()->count();

        $data = [
            "users" => $users,
            "count" => $count
        ];

        return view('pages.rw.manage.warga', $data);
    }

    public function addNewWarga()
    {
        request()->validate([
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
            'id_rukun_tetangga' => 'required',
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
            'alamat' => request()->alamat,
            'id_rukun_tetangga' => request()->id_rukun_tetangga,
        ];

        $newUser = UserModel::create($data);

        if (!$newUser) {
            session()->flash('danger', 'Gagal menambahkan warga baru.');
        } else {
            session()->flash('success', 'Berhasil menambahkan warga baru.');
        }

        // return redirect()->route('rw.manage.warga.warga');
        return 'sliwik';
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
            'id_rukun_tetangga' => 'required',
        ]);

        $nik = request()->nik;
        $user = UserModel::find($nik);

        if (!$user) {
            session()->flash('danger', 'Gagal mengupdate warga.');
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
            $user->setIdRukunTetangga(request()->id_rukun_tetangga);

            $user->save();

            session()->flash('success', 'Berhasil mengupdate warga.');
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
            session()->flash('danger', 'Gagal menghapus warga.');
        } else {
            $user->delete();
            session()->flash('success', 'Berhasil menghapus warga.');
        }

        // return redirect()->route('rw.manage.warga.warga');
        return 'delete done';
    }
}
