{{-- extend to layouts/app --}}
@extends('layouts.app')

{{-- content --}}
@section('content')
@php
$image = Vite::asset('resources/assets/images/handTogether.jpg');
$reservation = Vite::asset('resources/assets/images/reservation.png');
$umkm = Vite::asset('resources/assets/images/store.png');
$information = Vite::asset('resources/assets/images/loud-speaker.png');
$report = Vite::asset('resources/assets/images/no-shouting.png');
$payment = Vite::asset('resources/assets/images/tips.png');
$avatar = Vite::asset('resources/assets/images/avatar.jpg');

$layanan = [
[
'title' => 'Reservasi Temu',
'href' => '#',
'desc' => 'Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed do eiusmod te',
'icon' => $reservation,
],
[
'title' => 'Pengaduan',
'href' => '#',
'desc' => 'Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed do eiusmod te',
'icon' => $report,
],
[
'title' => 'Pembayaran Iuran',
'href' => '#',
'desc' => 'Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed do eiusmod te',
'icon' => $payment,
],
[
'title' => 'Informasi UMKM',
'href' => '#',
'desc' => 'Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed do eiusmod te',
'icon' => $umkm,
],
[
'title' => 'Informasi dan Berita',
'href' => '#',
'desc' => 'Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed do eiusmod te',
'icon' => $information,
],
];

$ucapan = [
[
'name' => 'Husni Mubarok',
'position' => 'Ketua RW 01',
'desc' => '“Dengan adanya website ini, sangat membantu kami dalam menjalankan berbagai aktivitas
administrasi yang ada di lingkungan ini. Harapan saya semoga website ini dapat membantu seluruh
masyarakat RW 01 Landungsari dalam menunjang kebutuhan administrasi mereka.”',
'date' => '12 Agustus 2021',
'image' => $avatar,
],
[
'name' => 'Hary Oswald',
'position' => 'Ketua RT 01',
'desc' => '“Dengan adanya website ini, sangat membantu kami dalam menjalankan berbagai aktivitas
administrasi yang ada di lingkungan ini. Harapan saya semoga website ini dapat membantu seluruh
masyarakat RW 01 Landungsari dalam menunjang kebutuhan administrasi mereka.”',
'date' => '12 Agustus 2021',
'image' => $avatar,
],
[
'name' => 'Muhammad Bagus Fajar',
'position' => 'Ketua RT 02',
'desc' => '“Dengan adanya website ini, sangat membantu kami dalam menjalankan berbagai aktivitas
administrasi yang ada di lingkungan ini. Harapan saya semoga website ini dapat membantu seluruh
masyarakat RW 01 Landungsari dalam menunjang kebutuhan administrasi mereka.”',
'date' => '12 Agustus 2021',
'image' => $avatar,
],
[
'name' => 'Fanessa Bhirawaningtyas',
'position' => 'Bendahara RW 01',
'desc' => '“Dengan adanya website ini, sangat membantu kami dalam menjalankan berbagai aktivitas
administrasi yang ada di lingkungan ini. Harapan saya semoga website ini dapat membantu seluruh
masyarakat RW 01 Landungsari dalam menunjang kebutuhan administrasi mereka.”',
'date' => '12 Agustus 2021',
'image' => $avatar,
],
[
'name' => 'Jihan Karuniawati',
'position' => 'Sekretaris RW 01',
'desc' => '“Dengan adanya website ini, sangat membantu kami dalam menjalankan berbagai aktivitas
administrasi yang ada di lingkungan ini. Harapan saya semoga website ini dapat membantu seluruh
masyarakat RW 01 Landungsari dalam menunjang kebutuhan administrasi mereka.”',
'date' => '12 Agustus 2021',
'image' => $avatar,
],
];

@endphp
@include('pages.shared.includes.navbar')
<div class="dark:text-gray-200 dark:fill-gray-200">
    <section class="mb-10">
        <!-- Slider main container -->
        <swiper-container id="swiper-container-hero" class="mySwiper w-full h-[500px] lg:h-[650px]" pagination-clickable="true" slides-per-view="1" speed="500" loop="true" pagination="true" init="false">
            <swiper-slide class=" bg-cover bg-left" style="background-image: url('{{ $image }}');">
                <div class="text-container backdrop-brightness-50 dark:backdrop-brightness-75 flex flex-col justify-center items-center h-full w-full">
                    <div class="text-wrap w-3/4 xl:max-w-4xl">
                        <h1 class="text-gray-100 text-5xl text-center font-Poppins font-bold">RW 01 : Berwibawa, Peduli,
                            Resik, Aman dan Serasi.</h1>
                        <h2 class="font-Inter text-center text-gray-100 font-light text-xl">Selamat Datang di Situs
                            Resmi RW 01 Desa Landungsari, Kecamatan Dau, Kabupaten Malang, 65151</h2>
                    </div>
                </div>
            </swiper-slide>
            <swiper-slide class=" bg-cover bg-left" style="background-image: url('{{ $image }}');">
                <div class="text-container backdrop-brightness-50 dark:backdrop-brightness-75 flex flex-col justify-center items-center h-full w-full">
                    <div class="text-wrap w-3/4 xl:max-w-4xl">
                        <h1 class="text-gray-100 text-5xl text-center font-Poppins font-bold">RW 01 : Berwibawa, Peduli,
                            Resik, Aman dan Serasi.</h1>
                        <h2 class="font-Inter text-center text-gray-100 font-light text-xl">Selamat Datang di Situs
                            Resmi RW 01 Desa Landungsari, Kecamatan Dau, Kabupaten Malang, 65151</h2>
                    </div>
                </div>
            </swiper-slide>
            <swiper-slide class=" bg-cover bg-left" style="background-image: url('{{ $image }}');">
                <div class="text-container backdrop-brightness-50 dark:backdrop-brightness-75 flex flex-col justify-center items-center h-full w-full">
                    <div class="text-wrap w-3/4 xl:max-w-4xl">
                        <h1 class="text-gray-100 text-5xl text-center font-Poppins font-bold">RW 01 : Berwibawa, Peduli,
                            Resik, Aman dan Serasi.</h1>
                        <h2 class="font-Inter text-center text-gray-100 font-light text-xl">Selamat Datang di Situs
                            Resmi RW 01 Desa Landungsari, Kecamatan Dau, Kabupaten Malang, 65151</h2>
                    </div>
                </div>
            </swiper-slide>
        </swiper-container>
    </section>
    <section class="px-8 lg:px-16 mb-28 ">
        <div class="header-section mx-6 mb-9">
            <h1 class="text-4xl font-Poppins font-semibold">Berita dan Informasi</h1>
            <h5 class="font-Inter font-normal dark:text-gray-500">Lihat berita dan pengumuman yang terbaru</h5>
        </div>
        <div class="body-section">
            <swiper-container slides-per-view="3" scrollbar-hide="false" draggable="true">
                <swiper-slide>
                    <x-card.carditem></x-card.carditem>
                </swiper-slide>
                <swiper-slide>
                    <x-card.carditem></x-card.carditem>
                </swiper-slide>
                <swiper-slide>
                    <x-card.carditem></x-card.carditem>
                </swiper-slide>
                <swiper-slide>
                    <x-card.carditem></x-card.carditem>
                </swiper-slide>
            </swiper-container>
        </div>
    </section>
    <section class="px-8 lg:px-16 mt-10 mb-28">
        <div class="header-section text-center mb-12">
            <h1 class="text-4xl font-Poppins font-semibold mb-3">Layanan Kami</h1>
            <h5 class="font-Inter dark:text-gray-500">Layanan Pada Website yang Perlu Anda Ketahui</h5>
        </div>
        <div class="layanan-emblem flex flex-wrap justify-center">
            @foreach ($layanan as $item)
            <x-card.carditememblem :title="$item['title']" :href="$item['href']" :desc="$item['desc']" :icon="$item['icon']" />
            @endforeach
        </div>
    </section>

    <section class=" px-8 lg:px-16 mb-56">
        <div class="header-section mb-11 ms-10">
            <h1 class="text-4xl font-Poppins font-semibold">Apa Kata Mereka?</h1>
        </div>
        <div class="body-section ">
            <swiper-container slides-per-view="3" scrollbar-hide="false" draggable="true">
                @foreach ($ucapan as $item)
                <swiper-slide>
                    <x-card.carditemmessage :name="$item['name']" :position="$item['position']" :desc="$item['desc']" :date="$item['date']" :image="$item['image']" />
                </swiper-slide>
                @endforeach
            </swiper-container>
        </div>
    </section>
    @include('pages.shared.includes.footer')

</div>
@endsection
@push('scripts')
<script type="module">
    const swiperEl = document.querySelector('#swiper-container-hero')

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