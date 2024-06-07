{{-- extend to layouts/app --}}
@extends('layouts.app')

{{-- content --}}
@section('content')
@include('pages.shared.includes.navbar')
<div class="h-screen overflow-scroll dark:fill-gray-200 dark:text-gray-200">
    <section class="pt-18 mb-36 px-24">
        <div class="mb-5 pt-12">
            <h1 class="font-Poppins text-2xl font-semibold">Berita dan Informasi</h1>
            <p class="font-Inter text-lg">
                Berita dan informasi adalah sarana utama bagi warga untuk terhubung secara langsung dan mudah dengan perkembangan terkini di wilayah RW ini. 
                Dengan adanya berita dan informasi sebagai sarana utama, warga dapat secara aktif mengikuti perkembangan penting di sekitar mereka, 
                mulai dari kegiatan sosial, proyek pembangunan, hingga informasi keamanan dan kesehatan.
            </p>
        </div>
        <div class="pengumuman mt-20 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($pengumumanInstances as $pengumuman)
            <div class="w-full">
                <div class="card w-full overflow-hidden rounded-lg shadow-lg dark:bg-darkBg hover:shadow:900" id="pengumuman-{{ $pengumuman->getIdPengumuman() }}">
                    <div class="h-64 w-full">
                        <img src="{{ $pengumuman->getImageUrl() }}" alt="Gambar Pengumuman" class="h-full w-full object-cover"/>
                    </div>
                    <div class="card-content px-10 py-5">
                        <div class="card-header h-16">
                            <p class="text-sm font-light">{{ $pengumuman->getReadableDiperbaruiPada() }} </p>
                            <h5 class="text-lg font-semibold pt-2  line-clamp-2">{{ $pengumuman->getJudul() }}</h5>
                        </div>
                        <div class="card-body mb-9 pt-8 h-36">
                            <p class="... w-full line-clamp-5">
                                {{$pengumuman->getKonten()}}
                            </p>
                        </div>
                        <a href="{{ route('informasi.pengumuman.detail', [$pengumuman->getIdPengumuman()]) }}" target="_blank" class="flex items-center ">
                            <span class="py-2 text-sm dark:text-green-500 text-green-700">Selengkapnya</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5 pt-1 text-green-700" fill="green">
                                <path d="M18 12a2 2 0 0 0-.59-1.4l-4.29-4.3a1 1 0 0 0-1.41 0 1 1 0 0 0 0 1.42L15 11H5a1 1 0 0 0 0 2h10l-3.29 3.29a1 1 0 0 0 1.41 1.42l4.29-4.3A2 2 0 0 0 18 12"/>
                            </svg>
                        </a>    
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
