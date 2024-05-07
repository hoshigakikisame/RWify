@extends('layouts.app')
@section('content')
@include('pages.shared.includes.navbar')
<section class="dark:text-white mb-36 px-24 pt-14">
    <div class="mb-5">
        <h1 class="text-2xl font-semibold font-Poppins">Informasi Usaha Mikro Kecil dan Menengah (UMKM)</h1>
        <p class="text-lg font-Inter">Informasi mengenai Usaha Mikro Kecil dan Menengah (UMKM) merupakan salah satu fokus utama website ini dalam memberikan dukungan yang komprehensif bagi para pelaku bisnis skala kecil dan menengah. Dengan menyebarkan informasi yang relevan dan berguna, kami berharap dapat membantu UMKM lokal untuk tumbuh dan berkembang serta lebih dikenal secara luas.</p>
    </div>
    <div class="umkm grid grid-cols-8 gap-4 mt-20">
        @foreach ($umkmInstances as $umkm)
        <div class="card bg-gray-300 w-fit rounded-lg overflow-hidden" id="umkm-{{ $umkm->getIdUmkm() }}">
            <div class="">
                <img src="{{$umkm->getImageUrl()}}" alt="">
            </div>
            <div class="card-content px-10 py-5">
                <div class="card-header mb-2">
                    <h5 class="text-lg">{{ $umkm->getNama() }}</h5>
                </div>
                <div class="card-body mb-9">
                    <p class="text-wrap w-60 truncate ...">
                        {{ implode(' ', array_slice(str_word_count($umkm->getDeskripsi(), 1), 0, 13)) }}
                        {{ str_word_count($umkm->getDeskripsi()) > 10 ? '.....' : '' }}
                    </p>
                </div>
                <div class="card-footer text-sm">
                    <p>Alamat: {{ $umkm->getAlamat() }}</p>
                    <p>Telepon: {{ $umkm->getTelepon() }}</p>
                </div>
            </div>
        </div>
        <br>
        @endforeach
    </div>
</section>
@include('pages.shared.includes.footer')
@endsection