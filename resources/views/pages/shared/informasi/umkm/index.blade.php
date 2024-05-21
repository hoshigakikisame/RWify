@extends('layouts.app')
@section('content')
    @include('pages.shared.includes.navbar')
    <div class="h-screen overflow-scroll">
        <section class="mb-36 px-24 pt-14 dark:text-white">
            <div class="mb-5">
                <h1 class="font-Poppins text-2xl font-semibold">Informasi Usaha Mikro Kecil dan Menengah (UMKM)</h1>
                <p class="font-Inter text-lg">
                    Informasi mengenai Usaha Mikro Kecil dan Menengah (UMKM) merupakan salah satu fokus utama website
                    ini dalam memberikan dukungan yang komprehensif bagi para pelaku bisnis skala kecil dan menengah.
                    Dengan menyebarkan informasi yang relevan dan berguna, kami berharap dapat membantu UMKM lokal untuk
                    tumbuh dan berkembang serta lebih dikenal secara luas.
                </p>
            </div>
            <div class="umkm mt-20 grid grid-cols-8 gap-4">
                @foreach ($umkmInstances as $umkm)
                    <div class="card w-fit overflow-hidden rounded-lg bg-gray-300" id="umkm-{{ $umkm->getIdUmkm() }}">
                        <div class="">
                            <img src="{{ $umkm->getImageUrl() }}" alt="" />
                        </div>
                        <div class="card-content px-10 py-5">
                            <div class="card-header mb-2">
                                <h5 class="text-lg">{{ $umkm->getNama() }}</h5>
                            </div>
                            <div class="card-body mb-9">
                                <p class="... w-60 truncate text-wrap">
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
                    <br />
                @endforeach
            </div>
        </section>
        @include('pages.shared.includes.footer')
    </div>
@endsection
