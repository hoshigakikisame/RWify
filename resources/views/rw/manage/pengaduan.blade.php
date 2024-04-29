{{-- extend to layouts/app --}}
@extends('layouts.sidebar')

@push('style')

@endpush

{{-- content --}}
@section('content')
<div class="container text-gray-900 dark:text-gray-200">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Manage Data Pengaduan</h1>
        </div>
    </div>
    <div class="row">
        <table class="table-auto">
            <thead class="bg-gray-200  dark:bg-gray-800 border-b">
                <tr>
                    <th>ID Pengaduan</th>
                    <th>Judul</th>
                    <th>NIK Pengadu</th>
                    <th>Isi</th>
                    <th>Path Gambar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengaduanInstances as $pengaduan)
                <tr class="border-b">
                    <td>
                        {{ $pengaduan->getIdPengaduan() }}
                    </td>
                    <td>
                        {{ $pengaduan->getJudul() }}
                    </td>
                    <td>
                        {{ $pengaduan->getNikPengadu() }}
                    </td>
                    <td>
                        {{ substr(strip_tags($pengaduan->getIsi()), 50) . '...' }}
                    </td>
                    <td>
                        {{ $pengaduan->getPathGambar() }}
                    </td>
                    <td>
                        {{ $pengaduan->getStatus() }}
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