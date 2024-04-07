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
                <h1 class="text-center">Manage Data UMKM</h1>
            </div>
        </div>
        <div class="row">
            <table style="border: 1px solid black;">
                <thead>
                    <tr>
                        <th>ID UMKM</th>
                        <th>Nama</th>
                        <th>Path Gambar</th>
                        <th>Nama Pemilik</th>
                        <th>Alamat</th>
                        <th>Map URL</th>
                        <th>Telepon</th>
                        <th>Instagram URL</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($umkmInstances as $umkm)
                    <tr>
                        <td>
                            {{ $umkm->getIdUmkm() }}
                        </td>
                        <td>
                            {{ $umkm->getNama() }}
                        </td>
                        <td>
                            {{ $umkm->getPathGambar() }}
                        </td>
                        <td>
                            {{ $umkm->getNamaPemilik() }}
                        </td>
                        <td>
                            {{ $umkm->getAlamat() }}
                        </td>
                        <td>
                            {{ $umkm->getMapUrl() }}
                        </td>
                        <td>
                            {{ $umkm->getTelepon() }}
                        </td>
                        <td>
                            {{ $umkm->getInstagramUrl() }}
                        </td>
                        <td>
                            {{ $umkm->getDeskripsi() }}
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
