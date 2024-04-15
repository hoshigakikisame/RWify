{{-- extend to layouts/app --}}
@extends('layouts.sidebar')

@push('style')
<style>

</style>
@endpush

{{-- content --}}
@section('content')
<div class="dark:text-white text-gray-900">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Manage Data UMKM</h1>
        </div>
    </div>
    <div class="row">
        <div class="-mx-4 -my-2 sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-h-full overflow-hidden">
                <div class="overflow-x-scroll">
                    <table class="table-auto ">
                        <thead class="bg-gray-200  dark:bg-gray-800 border-b">
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
                            <tr class="border-b">
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
    </div>
</div>
</div>
@endsection