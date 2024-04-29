{{-- extend to layouts/app --}}
@extends('layouts.sidebar')

@push('style')

@endpush

{{-- content --}}
@section('content')
<div class="container text-gray-900 dark:text-gray-200">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Manage Data Pengumuman</h1>
        </div>
    </div>
    <div class="row">
        <table class="table-auto">
            <thead class="bg-gray-200  dark:bg-gray-800 border-b">
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
                <tr class="border-b">
                    <td>
                        {{ $pengumuman->getIdPengumuman() }}
                    </td>
                    <td>
                        {{ $pengumuman->getJudul() }}
                    </td>
                    <td>
                        {{ $pengumuman->getImageUrl() }}
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