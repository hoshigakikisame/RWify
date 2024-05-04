@extends('layouts.app')
@section('content')
@include('pages.shared.includes.navbar')
<section class="dark:text-white mb-36">
    @foreach ($umkmInstances as $umkm)
    <div class="card" id="umkm-{{ $umkm->getIdUmkm() }}">
        <div class="card-header">
            <h5>Nama: {{ $umkm->getNama() }}</h5>
        </div>
        <div class="card-body">
            <p>Deskripsi: {{ $umkm->getDeskripsi() }}</p>
        </div>
        <div class="card-footer">
            <p>Alamat: {{ $umkm->getAlamat() }}</p>
            <p>Telepon: {{ $umkm->getTelepon() }}</p>
        </div>
    </div>
    <br>
    @endforeach
</section>
@include('pages.shared.includes.footer')
@endsection