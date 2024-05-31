{{-- extend to layouts/app --}}
@extends('layouts.sidebar.warga-sidebar')

{{-- content --}}
@section('content')
    <head>
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>   
    </head>
    <section class="pb-20 px-10 mt-7">
        <div class="header mb-5 border-b pb-5">
            <h1 class="text-lg font-medium text-gray-950 dark:text-gray-100">Reservasi</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Buat reservasi menggunakan form ini</p>
        </div>
        <div class="flex flex-col flex-col-reverse lg:flex-row gap-8 ">
            <div class="form w-full rounded-lg bg-gray-50 px-8 py-4 pb-8 shadow-sm dark:bg-gray-800/50">
                <form action="{{ route('warga.layanan.reservasiJadwalTemu.new') }}" method="POST" enctype="">
                    @csrf
                    <div class="form-header mb-6 mt-2">
                        <h1 class="font-medium dark:text-gray-100">Form Reservasi</h1>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Buat reservasi dengan lengkap dengan deskripsi yang jelas
                        </p>
                    </div>
                    <div class="form-body">
                        <x-form.input-form
                            title="Judul Reservasi"
                            key="subjek"
                            type="text"
                            placeholder="Masukkan Judul Reservasi"
                            value="{{old('subjek')}}"
                        />
                        <x-form.textarea-input-form
                            title="Pesan Reservasi"
                            key="pesan"
                            type="text"
                            placeholder="Masukkan Pesan Atau Keterangan Reservasi"
                            value="{{old('subjek')}}"
                        />
                        <div class="">
                            <x-form.input-form
                                title="Tanggal Reservasi"
                                key="jadwal_temu"
                                type="datetime-local"
                                placeholder="Enter date"
                            />
                            <div class="mt-4">
                                <label
                                    for="reservationTargets"
                                    class="block text-sm capitalize text-gray-700 dark:text-gray-300"
                                >
                                    Target
                                </label>
                                <select
                                    name="nik_penerima"
                                    id="reservationTargets"
                                    class="mt-2 block w-full rounded-md border border-gray-200 bg-white px-3 py-2 text-gray-600 placeholder-gray-400 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-300 dark:focus:ring-blue-200"
                                >
                                    <option value="" disabled selected>- Pilih Tujuan Temu -</option>
                                    @foreach ($reservationTargets as $user)
                                        <option value="{{ $user->getNik() }}">
                                            {{ $user->getNamaLengkap() }} - {{ $user->getRole() }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 flex justify-end">
                        <button
                            type="submit"
                            class="transform rounded-md bg-blue-500 px-3 py-2 text-sm capitalize tracking-wide text-white transition-colors duration-200 hover:bg-blue-600 focus:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700"
                        >
                            Buat Reservasi
                        </button>
                    </div>
                </form>
            </div>
            <div class="swiper-container mySwiper w-full h-full relative overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach ($reservationTargets as $user)
                    <div class="swiper-slide">
                        <div class="flex flex-col rounded-lg border p-7 dark:border-gray-700 w-full">
                            <div class="profile flex gap-2">
                                <div class="p-12 mr-4 h-20 w-20 rounded-full bg-white bg-cover bg-center dark:bg-gray-900" style="background-image: url('{{ $user->image_url }}')"></div>
                                <div class="flex flex-col justify-center">
                                    <p class="font-Poppins text-md font-medium leading-5 text-gray-800 dark:text-gray-200">
                                        {{ $user->getNamaLengkap() }} - {{ $user->getRole() }}
                                    </p>
                                    <p class="font-light dark:text-gray-100">{{ $user->getAlamat() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination absolute inset-x-0 bottom-0 flex justify-center mt-4"></div>
            </div>                  
        </div>
    </section>
@endsection

@push('scripts')
<script>
    const swiper = new Swiper('.swiper-container', {
        loop: true,
        autoplay: {
            delay: 7000,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
    });
</script>
@endpush