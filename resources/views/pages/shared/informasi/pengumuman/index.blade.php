@extends('layouts.app')
@section('content')
    <div class="section">
        @foreach ($pengumumanInstances as $pengumuman)
            <div class="card" id="pengumuman-{{ $pengumuman->getIdPengumuman() }}">
                <div class="card-header">
                    <h5>Nama: {{ $pengumuman->getJudul() }}</h5>
                </div>
                <div
                    class="card-body bg-cover bg-center"
                    style="background-image: url('{{ $pengumuman->getImageUrl() }}')"
                >
                    <div class="card-body">
                        <p>Konten: {{ $pengumuman->getKonten() }}</p>
                    </div>
                    <div class="card-footer">
                        <p>Dibuat Pada: {{ $pengumuman->getDibuatPada() }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
