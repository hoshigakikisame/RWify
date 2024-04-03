{{-- extend to layouts/app --}}
@extends('layouts.app')

@push('style')
<style>
    table, th, td {
        border: 1px solid black;
    }
</style>
@endpush

{{-- content --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Manage Data Warga</h1>
            </div>
        </div>
        <div class="row">
            <table style="border: 1px solid black;">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>NKK</th>
                        <th>Nama</th>
                        <th>Tempat Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $user) :
                    <tr>
                        <td>
                            {{ $user->getNIK() }}
                        </td>
                        <td>
                            {{ $user->getNKK() }}
                        </td>
                        <td>
                            {{ $user->getNamaDepan() . " " . $user->getNamaBelakang() }}
                        </td>
                        <td>
                            {{ $user->getTempatLahir() . ", " . $user->getTanggalLahir() }}
                        </td>
                        <td>
                            {{ $user->getAlamat() }}
                        </td>
                        <td>
                            <div class="d-flex" id="action_wrapper">
                                <a href="">Update</a>
                                <a href="">Delete</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
