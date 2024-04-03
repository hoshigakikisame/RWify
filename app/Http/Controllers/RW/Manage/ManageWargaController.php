<?php

namespace App\Http\Controllers\RW\Manage;

// Illuminate
use Illuminate\Support\Facades\Hash;

// App
use App\Http\Controllers\Controller;
use App\Models\UserModel;


class ManageWargaController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function manageWargaPage()
    {
        $users = UserModel::all();
        
        $data = [
            "users" => $users
        ];

        // add test flash message
        session()->flash('alert-info', 'This is a test flash message.');

        return view('rw.manage.warga', $data);
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
            'agama' => 'required',
            'status_perkawinan' => 'required',
            'pekerjaan' => 'required',
            'tipe_warga' => 'required',
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
            'agama' => request()->agama,
            'status_perkawinan' => request()->status_perkawinan,
            'pekerjaan' => request()->pekerjaan,
            'tipe_warga' => request()->tipe_warga,
            'role' => request()->role,
            'jenis_kelamin' => request()->jenis_kelamin,
            'golongan_darah' => request()->golongan_darah,
            'alamat' => request()->alamat,
            'id_rukun_tetangga' => request()->id_rukun_tetangga,
        ];

        $newUser = UserModel::create($data);

        if(!$newUser) {
            session()->flash('alert-danger', 'Gagal menambahkan warga baru.');
        } else {
            session()->flash('alert-success', 'Berhasil menambahkan warga baru.');
        }

        return redirect()->route('rw.manage.warga');
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
            'tipe_warga' => 'required',
            'role' => 'required',
            'jenis_kelamin' => 'required',
            'golongan_darah' => 'required',
            'alamat' => 'required',
            'id_rukun_tetangga' => 'required',
        ]);

        $nik = request()->nik;
        $user = UserModel::find($nik);

        if(!$user) {
            session()->flash('alert-danger', 'Gagal mengupdate warga.');
        } else {
            $user->nik = request()->nik;
            $user->nkk = request()->nkk;
            $user->email = request()->email;
            $user->nama_depan = request()->nama_depan;
            $user->nama_belakang = request()->nama_belakang;
            $user->tempat_lahir = request()->tempat_lahir;
            $user->agama = request()->agama;
            $user->status_perkawinan = request()->status_perkawinan;
            $user->pekerjaan = request()->pekerjaan;
            $user->tipe_warga = request()->tipe_warga;
            $user->role = request()->role;
            $user->jenis_kelamin = request()->jenis_kelamin;
            $user->golongan_darah = request()->golongan_darah;
            $user->alamat = request()->alamat;
            $user->id_rukun_tetangga = request()->id_rukun_tetangga;

            $user->save();

            session()->flash('alert-success', 'Berhasil mengupdate warga.');
        }

        return redirect()->route('rw.manage.warga');
    }

    public function deleteWarga($id)
    {
        $user = UserModel::find($id);

        if(!$user) {
            session()->flash('alert-danger', 'Gagal menghapus warga.');
        } else {
            $user->delete();
            session()->flash('alert-success', 'Berhasil menghapus warga.');
        }

        return redirect()->route('rw.manage.warga');
    }
}
