@extends('layouts.app')
@section('content')
@foreach ($umkmInstances as $umkm)
    <div class="card" id="umkm-{{ $umkm->getIdUmkm() }}">
        <div class="card-header">
            <h5>Nama: {{ $umkm->nama }}</h5>
        </div>
        <div class="card-body">
            <p>Deskripsi: {{ $umkm->deskripsi }}</p>
        </div>
        <div class="card-footer">
            <p>Alamat: {{ $umkm->alamat }}</p>
            <p>Telepon: {{ $umkm->telepon }}</p>
        </div>
    </div>
    <br>
@endforeach
@endsection