@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Profile</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('user.profile.update') }}">
                            @csrf
                            <div class="form-group">
                                <label for="nik" class="col-md-4 control-label">NIK</label>

                                <div class="col-md-6">
                                    <input id="nik" type="text" class="form-control" name="nik"
                                        value="{{ old('nik', $user->getNik()) }}" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nkk" class="col-md-4 control-label">NKK</label>

                                <div class="col-md-6">
                                    <input id="nkk" type="text" class="form-control" name="nkk"
                                        value="{{ old('nkk', $user->getNkk()) }}" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Email
                                    ({{ $user->getEmailVerifiedAt() ? 'Email Verified' : 'Email Not Verified' }})</label>
                                @if ($user->getEmailVerifiedAt() == null)
                                    <a href="{{ route('user.verification.send') }}" class="btn btn-primary">Send Email
                                        Verification</a>
                                @endif

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                        value="{{ old('email', $user->getEmail()) }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nama_depan" class="col-md-4 control-label">Nama Depan</label>

                                <div class="col-md-6">
                                    <input id="nama_depan" type="text" class="form-control" name="nama_depan"
                                        value="{{ old('nama_depan', $user->getNamaDepan()) }}" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nama_belakang" class="col-md-4 control-label">Nama Belakang</label>

                                <div class="col-md-6">
                                    <input id="nama_belakang" type="text" class="form-control" name="nama_belakang"
                                        value="{{ old('nama_belakang', $user->getNamaBelakang()) }}" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tempat_lahir" class="col-md-4 control-label">Tempat Lahir</label>

                                <div class="col-md-6">
                                    <input id="tempat_lahir" type="text" class="form-control" name="tempat_lahir"
                                        value="{{ old('tempat_lahir', $user->getTempatLahir()) }}" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="agama" class="col-md-4 control-label">Agama</label>

                                <div class="col-md-6">
                                    <input id="agama" type="text" class="form-control" name="agama"
                                        value="{{ old('agama', $user->getAgama()) }}" disabled>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="status_perkawinan" class="col-md-4 control-label">Status Perkawinan</label>

                                <div class="col-md-6">
                                    <input id="status_perkawinan" type="text" class="form-control"
                                        name="status_perkawinan"
                                        value="{{ old('status_perkawinan', $user->getStatusPerkawinan()) }}" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pekerjaan" class="col-md-4 control-label">Pekerjaan</label>

                                <div class="col-md-6">
                                    <input id="pekerjaan" type="text" class="form-control" name="pekerjaan"
                                        value="{{ old('pekerjaan', $user->getPekerjaan()) }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tipe_warga" class="col-md-4 control-label">Tipe Warga</label>

                                <div class="col-md-6">
                                    <input id="tipe_warga" type="text" class="form-control" name="tipe_warga"
                                        value="{{ old('tipe_warga', $user->getTipeWarga()) }}" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="role" class="col-md-4 control-label">Role</label>

                                <div class="col-md-6">
                                    <input id="role" type="text" class="form-control" name="role"
                                        value="{{ old('role', $user->getRole()) }}" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="jenis_kelamin" class="col-md-4 control-label">Jenis Kelamin</label>

                                <div class="col-md-6">
                                    <input id="jenis_kelamin" type="text" class="form-control" name="jenis_kelamin"
                                        value="{{ old('jenis_kelamin', $user->getJenisKelamin()) }}" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="golongan_darah" class="col-md-4 control-label">Golongan Darah</label>

                                <div class="col-md-6">
                                    <input id="golongan_darah" type="text" class="form-control" name="golongan_darah"
                                        value="{{ old('golongan_darah', $user->getGolonganDarah()) }}" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat" class="col-md-4 control-label">Alamat</label>

                                <div class="col-md-6">
                                    <input id="alamat" type="text" class="form-control" name="alamat"
                                        value="{{ old('alamat', $user->getAlamat()) }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="id_rukun_tetangga" class="col-md-4 control-label">Rukun Tetangga</label>

                                <div class="col-md-6">
                                    <input id="id_rukun_tetangga" type="text" class="form-control"
                                        name="id_rukun_tetangga"
                                        value="{{ old('id_rukun_tetangga', $user->getRukunTetangga()->getNomorRukunTetangga()) }}"
                                        disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>

                        <hr>
                        <form class="form-horizontal" method="POST"
                            action="{{ route('user.profile.updatePassword') }}">
                            @csrf
                            <div class="form-group">
                                <label for="current_password" class="col-md-4 col-form-label text-md-right">Current
                                    Password</label>

                                <div class="col-md-6">
                                    <input id="current_password" type="password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        name="current_password" required>

                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="new_password" class="col-md-4 col-form-label text-md-right">New
                                    Password</label>

                                <div class="col-md-6">
                                    <input id="new_password" type="password"
                                        class="form-control @error('new_password') is-invalid @enderror"
                                        name="new_password" required>

                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">New
                                    Password Confirmation</label>

                                <div class="col-md-6">
                                    <input id="new_password_confirmation" type="password"
                                        class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                        name="new_password_confirmation" required>

                                    @error('new_password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
