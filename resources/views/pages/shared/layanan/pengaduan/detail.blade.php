@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Pengaduan</h3>
                <div class="card">
                    <div class="card-header">
                        <h5>Judul: {{ $pengaduanInstance->judul }}</h5>
                    </div>
                    <div class="card-body">
                        <p>Isi: {{ $pengaduanInstance->isi }}</p>
                    </div>
                    <div class="card-footer">
                        <p>Dibuat pada: {{ $pengaduanInstance->created_at }}</p>
                        <p>Diupdate pada: {{ $pengaduanInstance->updated_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection