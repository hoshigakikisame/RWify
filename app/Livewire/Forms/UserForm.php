<?php

namespace App\Livewire\Forms;

use Illuminate\Foundation\Auth\User;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\Hash;
use App\Models\UserModel;

use function Laravel\Prompts\password;

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
    public ?string $id_rukun_tetangga = "";
    public string $tipe_warga = "";

    public ?UserModel $user = null;

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
        $required = $this->validate([
            'nik' => 'required',
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
        if (!$this->user) {
            $this->password = Hash::make($this->password);
            $newUser = UserModel::create($this->only($data));
            if (!$newUser) {
                session()->flash('danger', 'Gagal menambahkan warga baru.');
            } else {
                session()->flash('success', 'Berhasil menambahkan warga baru.');
            }
        } else {
            if ($this->password != $this->user->password) {
                $this->password = Hash::make($this->password);
            }
            $this->user->update($this->only($data));
        }


        $this->reset();
    }

    public function update(?UserModel $user = null): void
    {
        $this->user = $user;
        $this->nik = $user->nik;
        $this->nkk = $user->nkk;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->nama_depan = $user->nama_depan;
        $this->nama_belakang = $user->nama_belakang;
        $this->tempat_lahir = $user->tempat_lahir;
        $this->tanggal_lahir = $user->tanggal_lahir;
        $this->agama = $user->agama;
        $this->jenis_kelamin = $user->jenis_kelamin;
        $this->golongan_darah = $user->golongan_darah;
        $this->alamat = $user->alamat;
        $this->status_perkawinan = $user->status_perkawinan;
        $this->pekerjaan = $user->pekerjaan;
        $this->role = $user->role;
        $this->tipe_warga = $user->tipe_warga;
        $this->id_rukun_tetangga = $user->id_rukun_tetangga;
    }

    public function delete($nik): void
    {

        $user = UserModel::find($nik);
        if (!$user) {
            session()->flash('danger', 'Gagal menghapus warga.');
        } else {
            $user->delete();
            session()->flash('success', 'Berhasil menghapus warga.');
        }
        $this->reset();
    }

    public function validationAttributes(): array
    {
        return [
            'nik' => 'nik',
            'nkk' => 'nkk',
        ];
    }

}
