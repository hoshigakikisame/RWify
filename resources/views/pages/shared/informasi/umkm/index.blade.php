{{-- extend to layouts/app --}}
@extends('layouts.app')

{{-- content --}}
@section('content')
    <div class="overflow-hidden">
        @include('pages.shared.includes.navbar')
        <div class="h-screen overflow-scroll dark:fill-gray-200 dark:text-gray-200">
            <section class="pt-18 mb-36 px-8 lg:px-24">
                <div class="mb-5 pt-12">
                    <h1 class="font-Poppins text-2xl font-semibold">Informasi Usaha Mikro Kecil dan Menengah (UMKM)</h1>
                    <p class="font-Inter text-sm md:text-lg">
                        Informasi mengenai Usaha Mikro Kecil dan Menengah (UMKM) merupakan salah satu fokus utama website
                        ini dalam memberikan dukungan yang komprehensif bagi para pelaku bisnis skala kecil dan menengah.
                        Dengan menyebarkan informasi yang relevan dan berguna, kami berharap dapat membantu UMKM lokal untuk
                        tumbuh dan berkembang serta lebih dikenal secara luas.
                    </p>
                </div>
                <div class="umkm mt-20 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @if (count($umkmInstances) == 0)
                        <div class="h-80"></div>
                    @endif
                    @foreach ($umkmInstances as $umkm)
                        <div class="w-full ">
                            <div class="card w-full overflow-hidden rounded-lg shadow-lg dark:bg-SecondaryBg h-full"
                                id="umkm-{{ $umkm->getIdUmkm() }}">
                                <div class="h-64 w-full">
                                    <img src="{{ $umkm->getImageUrl() }}" alt="Gambar UMKM"
                                        class="h-full w-full object-cover" />
                                </div>
                                <div class="card-content px-10 py-5">
                                    <div class="card-header h-16">
                                        <h5 class="text-lg font-semibold">{{ $umkm->getNama() }}</h5>
                                    </div>
                                    <div class="card-body mb-9 pt-2 h-36">
                                        <p class="... w-full line-clamp-5">
                                            {{ $umkm->getDeskripsi() }}
                                        </p>
                                    </div>
                                    <div class="card-footer text-sm pt-7">
                                        <div class="flex items-center mb-2">
                                            <a href="{{ $umkm->getMapUrl() }}" target="_blank" class="flex items-center">
                                                <div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                        viewBox="0 0 512 512">
                                                        <path fill="currentColor"
                                                            d="M256 32C167.67 32 96 96.51 96 176c0 128 160 304 160 304s160-176 160-304c0-79.49-71.67-144-160-144m0 224a64 64 0 1 1 64-64a64.07 64.07 0 0 1-64 64" />
                                                    </svg>
                                                </div>
                                                <div class="ml-2">
                                                    {{ $umkm->getAlamat() }}
                                                </div>
                                        </div>
                                        <div class="flex items-center mb-2">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 16 16">
                                                    <path fill="currentColor" fill-rule="evenodd"
                                                        d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42a18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                                                </svg>
                                            </div>
                                            <div class="ml-2">
                                                {{ $umkm->getTelepon() }}
                                            </div>
                                        </div>
                                        <div class="flex items-center mb-2">
                                            <a href="https://www.instagram.com/{{ $umkm->getInstagramUrl() }}"
                                                target="_blank" class="flex items-center">
                                                <div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                        viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M13.028 2c1.125.003 1.696.009 2.189.023l.194.007c.224.008.445.018.712.03c1.064.05 1.79.218 2.427.465c.66.254 1.216.598 1.772 1.153a4.908 4.908 0 0 1 1.153 1.772c.247.637.415 1.363.465 2.428c.012.266.022.487.03.712l.006.194c.015.492.021 1.063.023 2.188l.001.746v1.31a78.831 78.831 0 0 1-.023 2.188l-.006.194c-.008.225-.018.446-.03.712c-.05 1.065-.22 1.79-.466 2.428a4.883 4.883 0 0 1-1.153 1.772a4.915 4.915 0 0 1-1.772 1.153c-.637.247-1.363.415-2.427.465a72.11 72.11 0 0 1-.712.03l-.194.006c-.493.014-1.064.021-2.189.023l-.746.001h-1.309a78.43 78.43 0 0 1-2.189-.023l-.194-.006a63.036 63.036 0 0 1-.712-.031c-1.064-.05-1.79-.218-2.428-.465a4.889 4.889 0 0 1-1.771-1.153a4.904 4.904 0 0 1-1.154-1.772c-.247-.637-.415-1.363-.465-2.428a74.1 74.1 0 0 1-.03-.712l-.005-.194A79.047 79.047 0 0 1 2 13.028v-2.056a78.82 78.82 0 0 1 .022-2.188l.007-.194c.008-.225.018-.446.03-.712c.05-1.065.218-1.79.465-2.428A4.88 4.88 0 0 1 3.68 3.678a4.897 4.897 0 0 1 1.77-1.153c.638-.247 1.363-.415 2.428-.465c.266-.012.488-.022.712-.03l.194-.006a79 79 0 0 1 2.188-.023zM12 7a5 5 0 1 0 0 10a5 5 0 0 0 0-10m0 2a3 3 0 1 1 .001 6a3 3 0 0 1 0-6m5.25-3.5a1.25 1.25 0 0 0 0 2.5a1.25 1.25 0 0 0 0-2.5" />
                                                    </svg>
                                                </div>
                                                <div class="ml-2">
                                                    {{ $umkm->getInstagramUrl() }}
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            @include('pages.shared.includes.footer')
        </div>
    </div>
@endsection
