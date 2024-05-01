@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Detail Pengumuman</h3>
                <div class="card">
                    <div class="card-header">
                        <h5>Judul: {{ $pengumumanInstance->getJudul() }}</h5>
                    </div>
                    <div class="card-body bg-cover bg-center" style="background-image: url('{{ $pengumumanInstance->getImageUrl() }}');">
                    <div class="card-body">
                        <p>Konten: {{ $pengumumanInstance->getKonten() }}</p>
                    </div>
                    <div class="card-footer">
                        <p>Dibuat pada: {{ $pengumumanInstance->getDibuatPada() }}</p>
                        <p>Diupdate pada: {{ $pengumumanInstance->getDiperbaruiPada() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection