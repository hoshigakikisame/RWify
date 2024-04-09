<?php

namespace App\Livewire\Forms;

use Illuminate\Foundation\Auth\User;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\Hash;
use App\Models\UserModel;


class UserForm extends Form
{
    public string $nik = '';
    public string $nkk = '';
    public string $email = "";
    public string $password = "";
    public string $nama_depan = "";
    public string $nama_belakang = "";
    public string $tempat_lahir = "";
    public string $tanggal_lahir = "";
    public string $jenis_kelamin = "";
    public string $golongan_darah = "";
    public string $alamat = "";
    public string $agama = "";
    public string $status_perkawinan = "";
    public string $pekerjaan = "";
    public string $role = "";
    public string $id_rukun_tetangga = "";
    public string $tipe_warga = "";


    public function save(): void
    {
        $data = [
            'nik',
            'nkk',
            'email',
            'password',
            'nama_depan',
            'nama_belakang',
            'tempat_lahir',
            'tanggal_lahir',
            'agama',
            'status_perkawinan',
            'pekerjaan',
            'tipe_warga',
            'role',
            'jenis_kelamin',
            'golongan_darah',
            'alamat',
            'id_rukun_tetangga',
        ];
        $this->validate([
            'nik' => ['required'],
            'nkk' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
            'nama_depan' => ['required'],
            'nama_belakang' => ['required'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'agama' => [''],
            'status_perkawinan' => ['required'],
            'pekerjaan' => [''],
            'tipe_warga' => ['required'],
            'role' => ['required'],
            'jenis_kelamin' => ['required'],
            'golongan_darah' => ['required'],
            'alamat' => ['required'],
            'id_rukun_tetangga' => ['required'],
        ]);

        $newUser = UserModel::create($this->only($data));

        if (!$newUser) {
            session()->flash('alert-danger', 'Gagal menambahkan warga baru.');
        } else {
            session()->flash('alert-success', 'Berhasil menambahkan warga baru.');
        }
        $this->reset();
    }

    public function delete($nik): void
    {

        $user = UserModel::find($nik);
        if (!$user) {
            session()->flash('alert-danger', 'Gagal menghapus warga.');
        } else {
            $user->delete();
            session()->flash('alert-success', 'Berhasil menghapus warga.');
        }
        $this->reset();
    }

}
