{{-- extend to layouts/app --}}
@extends('layouts.app')

{{-- content --}}
@section('content')
@php
$image = Vite::asset('resources/assets/images/handTogether.jpg');
@endphp
@include('shared.includes.navbar')
<div class="">
    <section class="">
        <!-- Slider main container -->
        <swiper-container class="mySwiper w-full h-[500px] lg:h-[650px]" pagination-clickable="true" slides-per-view="1" speed="500" loop="true" pagination="true" mousewheel="true" init="false">
            <swiper-slide class=" bg-cover bg-left" style="background-image: url('{{$image}}');">
                <div class="text-container backdrop-brightness-50 dark:backdrop-brightness-75 flex flex-col justify-center items-center h-full w-full">
                    <div class="text-wrap w-3/4 xl:max-w-4xl">
                        <h1 class="text-gray-100 text-5xl text-center font-Poppins font-bold">RW 01 : Berwibawa, Peduli, Resik, Aman dan Serasi.</h1>
                        <h2 class="font-Inter text-center text-gray-100 font-light text-xl">Selamat Datang di Situs Resmi RW 01 Desa Landungsari, Kecamatan Dau, Kabupaten Malang, 65151</h2>
                    </div>
                </div>
            </swiper-slide>
            <swiper-slide class=" dark:bg-white bg-gray-100">Slide 2</swiper-slide>
            <swiper-slide class="dark:bg-white bg-gray-100">Slide 3</swiper-slide>
        </swiper-container>
    </section>
    <section class="px-8 lg:px-16 my-10">
        <div class="header-section mx-6">
            <h1 class="text-2xl font-Poppins font-semibold">Berita dan Informasi</h1>
            <h5 class="font-Inter font-normal">Lihat berita dan pengumuman yang terbaru</h5>
        </div>
        <div class="body-section h-screen">

        </div>
    </section>
</div>
@endsection
@push('scripts')
<script type="module">
    const swiperEl = document.querySelector('swiper-container')

    const params = {
        injectStyles: [`
            .swiper-pagination-horizontal{
                margin-bottom: 60px;
            }
            .swiper-pagination-bullet-active {
                color: #fff;
                background: #fff;
            }
            .swiper-pagination-bullet {
                background: rgb(229 231 235);
            }
      `]
    }

    Object.assign(swiperEl, params)
    swiperEl.initialize();
</script>
@endpush