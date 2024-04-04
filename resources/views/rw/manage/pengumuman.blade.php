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
                <h1 class="text-center">Manage Data Pengumuman</h1>
            </div>
        </div>
        <div class="row">
            <table style="border: 1px solid black;">
                <thead>
                    <tr>
                        <th>ID Pengumuman</th>
                        <th>Judul</th>
                        <th>Path Gambar</th>
                        <th>Konten</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($pengumumanInstances as $pengumuman)
                    <tr>
                        <td>
                            {{ $pengumuman->getIdPengumuman() }}
                        </td>
                        <td>
                            {{ $pengumuman->getJudul() }}
                        </td>
                        <td>
                            {{ $pengumuman->getPathGambar() }}
                        </td>
                        <td>
                            {{ substr(strip_tags($pengumuman->getKonten()), 50) . '...' }}
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
