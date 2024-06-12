{{-- extend to layouts/app --}}
@extends('layouts.app')

{{-- content --}}
@section('content')
    @php
        $image1 = Vite::asset('resources/assets/images/handTogether.jpg');
        $image4 = Vite::asset('resources/assets/images/image4.jpg');
        $image3 = Vite::asset('resources/assets/images/image3.jpg');
        $reservation = Vite::asset('resources/assets/images/reservation.png');
        $umkm = Vite::asset('resources/assets/images/store.png');
        $information = Vite::asset('resources/assets/images/loud-speaker.png');
        $report = Vite::asset('resources/assets/images/no-shouting.png');
        $payment = Vite::asset('resources/assets/images/tips.png');
        $avatar = Vite::asset('resources/assets/images/avatar.jpg');

        $layanan = [
            [
                'title' => 'Reservasi Temu',
                'href' => route('warga.layanan.reservasiJadwalTemu.newReservasiJadwalTemuPage'),
                'desc' =>
                    'Buat janji atau reservasi bertemu dengan ketua RW atau ketua RT untuk mengurus dokumen maupun pertemuan penting lainnya dengan lebih mudah.',
                'icon' => $reservation,
            ],
            [
                'title' => 'Pengaduan',
                'href' => route('warga.layanan.pengaduan.newPengaduanPage'),
                'desc' =>
                    'Laporkan masalah terkait infrastruktur, kebersihan, keamanan, atau masalah lainnya dengan detail dan kami akan segera menanganinya.',
                'icon' => $report,
            ],
            [
                'title' => 'Pembayaran Iuran',
                'href' => route('warga.layanan.pembayaranIuran.newIuranPage'),
                'desc' =>
                    'Pembayaran iuran RW secara online, mengelola keuangan pribadi dengan lebih baik, dan menghindari keterlambatan pembayaran.',
                'icon' => $payment,
            ],
            [
                'title' => 'Informasi UMKM',
                'href' => route('informasi.umkmPage'),
                'desc' =>
                    'Temukan informasi kontak, lokasi, dan produk atau layanan yang ditawarkan oleh setiap UMKM di sekitar lingkungan RW.',
                'icon' => $umkm,
            ],
            [
                'title' => 'Informasi dan Berita',
                'href' => route('informasi.pengumuman.index'),
                'desc' =>
                    'Dapatkan akses cepat dan terpercaya untuk informasi serta berita penting seputar kegiatan terkini di lingkungan RW.',
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

    <div class="overflow-hidden">
        @include('pages.shared.includes.navbar')
        <div class="h-screen overflow-scroll dark:fill-gray-200 dark:text-gray-200">
            <section class="mb-10">
                <!-- Slider main container -->
                <swiper-container id="swiper-container-hero" class="mySwiper h-[500px] w-full lg:h-[650px]"
                    pagination-clickable="true" slides-per-view="1" speed="500" loop="true" pagination="true"
                    init="false" effect="fade" autoplay autoplay-delay="7000">
                    <swiper-slide class="bg-cover bg-left" style="background-image: url('{{ $image1 }}')">
                        <div
                            class="text-container flex h-full w-full flex-col items-center justify-center backdrop-brightness-50 dark:backdrop-brightness-75">
                            <div class="w-3/4 text-wrap xl:max-w-4xl">
                                <h1 class="text-center font-Poppins text-3xl md:text-5xl font-bold text-gray-100">
                                    RW 01 : Berwibawa, Peduli, Resik, Aman dan Serasi.
                                </h1>
                                <h2 class="text-center font-Inter text-sm md:text-xl font-light text-gray-100">
                                    Selamat Datang di Situs Resmi RW 01 Desa Landungsari, Kecamatan Dau, Kabupaten
                                    Malang, 65151
                                </h2>
                            </div>
                        </div>
                    </swiper-slide>
                    <swiper-slide class="bg-cover bg-left" style="background-image: url('{{ $image4 }}')">
                        <div
                            class="text-container flex h-full w-full flex-col justify-center backdrop-brightness-50 dark:backdrop-brightness-75">
                            <div class="w-full text-wrap xl:max-w-full px-4 md:px-48">
                                <h1 class="font-Poppins text-5xl font-bold text-gray-100">
                                    RWify.
                                </h1>
                                <h2 class="font-Inter text-sm md:text-xl font-light text-gray-100">
                                    RWify adalah sebuah platform web yang dirancang khusus untuk membantu dalam administrasi
                                    dan manajemen lingkungan RW (Rukun Warga).
                                    Platform ini menyediakan berbagai fitur dan alat yang memudahkan pengurus RW dalam
                                    mengelola data penduduk, mengatur kegiatan komunitas,
                                    menyebarkan informasi penting, serta memfasilitasi komunikasi dan interaksi antara warga
                                    dalam lingkungan RW tersebut.
                                </h2>
                            </div>
                        </div>
                    </swiper-slide>
                    <swiper-slide class="bg-cover bg-left" style="background-image: url('{{ $image3 }}')">
                        <div
                            class="text-container flex h-full w-full flex-col items-center justify-center backdrop-brightness-50 dark:backdrop-brightness-75">
                            <div class="w-3/4 text-wrap xl:max-w-4xl">
                                <h1 class="text-center font-Poppins text-3xl md:text-5xl font-bold text-gray-100">
                                    RWify: RW 01 Landungsari, Landungsari Asri.
                                </h1>
                                <h2 class="text-center font-Inter text-sm md:text-xl font-light text-gray-100">
                                    Menghubungkan Hati, Menyatukan Langkah: RWify, Aplikasi Terdepan untuk Manajemen RW yang
                                    Terintegrasi!
                                </h2>
                            </div>
                        </div>
                    </swiper-slide>
                </swiper-container>
            </section>
            <section class="mb-28 px-8 lg:px-16">
                <div class="header-section md:mx-6 md:mb-9">
                    <h1 class="font-Poppins text-2xl md:text-4xl font-semibold">Berita dan Informasi</h1>
                    <h5 class="font-Inter font-normal text-xs md:text-base dark:text-gray-500">Lihat berita dan pengumuman
                        yang terbaru</h5>
                </div>
                <div class="body-section">
                    <swiper-container id="swiper-container-news" slides-per-view="1" init=false scrollbar-hide="false"
                        draggable="true">
                        @if (count($latest_pengumuman) > 0)
                            @foreach ($latest_pengumuman as $pengumuman)
                                <swiper-slide>
                                    <x-card.card-item :pengumuman="$pengumuman" />
                                </swiper-slide>
                            @endforeach
                        @else
                            <div
                                class="flex justify-center items-center h-40 w-full rounded-lg border border-gray-300 dark:border-gray-700 mt-4 p-6 ml-6">
                                <p class="text-gray-700 dark:text-white text-lg font-Poppins">Belum ada pengumuman yang
                                    dipublikasikan.</p>
                            </div>
                        @endif
                    </swiper-container>
                </div>
            </section>
            <section class="mb-28 mt-10 px-8 lg:px-16">
                <div class="header-section mb-12 text-center">
                    <h1 class="mb-2 font-Poppins text-2xl md:text-4xl font-semibold">Layanan Kami</h1>
                    <h5 class="font-Inter text-xs md:text-base dark:text-gray-500">Layanan Pada Website yang Perlu Anda
                        Ketahui</h5>
                </div>
                <div class="layanan-emblem flex flex-wrap justify-center">
                    @php
                        $cursor =
                            request()->user()?->getRole() != \App\Enums\User\UserRoleEnum::KETUA_RUKUN_WARGA->value
                                ? 'cursor-pointer'
                                : 'cursor-not-allowed active:pointer-events-none';
                    @endphp
                    @foreach ($layanan as $item)
                        <x-card.card-item-emblem :title="$item['title']" :href="$item['href']" :desc="$item['desc']" :icon="$item['icon']"
                            class="{{ !str_contains($item['title'], 'Informasi') ? $cursor : 'cursor-pointer' }}" />
                    @endforeach
                </div>
            </section>

            <section class="mb-56 px-8 lg:px-16">
                <div class="header-section mb-11 md:ms-10">
                    <h1 class="font-Poppins text-2xl md:text-4xl font-semibold">Apa Kata Mereka?</h1>
                </div>
                <div class="body-section">
                    <swiper-container id="swiper-container-testi" scrollbar-hide="false" draggable="true" init=false>
                        @foreach ($ucapan as $item)
                            <swiper-slide>
                                <x-card.card-item-message :name="$item['name']" :position="$item['position']" :desc="$item['desc']"
                                    :date="$item['date']" :image="$item['image']" />
                            </swiper-slide>
                        @endforeach
                    </swiper-container>
                </div>
            </section>
            @include('pages.shared.includes.footer')
        </div>
    </div>
@endsection

@push('scripts')
    <script type="module">
        const swiperElHero = document.querySelector('#swiper-container-hero');
        const swiperElTesti = document.querySelector('#swiper-container-testi');
        const swiperElNews = document.querySelector('#swiper-container-news');

        const params = {
            injectStyles: [
                `
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
      `,
            ],
        };

        const paramsTesti = {
            // Default parameters
            slidesPerView: 1,
            spaceBetween: 10,
            // Responsive breakpoints
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 1,
                    spaceBetween: 20
                },
                // when window width is >= 480px
                640: {
                    slidesPerView: 2,
                    spaceBetween: 30
                },
                // when window width is >= 640px
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 40
                }
            }
        }


        Object.assign(swiperElHero, params);
        swiperElHero.initialize();
        Object.assign(swiperElTesti, paramsTesti);
        swiperElTesti.initialize();
        Object.assign(swiperElNews, paramsTesti);
        swiperElNews.initialize();
    </script>
@endpush
