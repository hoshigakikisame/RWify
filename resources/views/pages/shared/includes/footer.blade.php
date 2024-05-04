@php
$image = Vite::asset('resources/assets/elements/waveLanding.svg');
@endphp
<footer class="bg-darkGreen relative">
    <div class="footer-devided relative">
        <img src="{{ $image }}" alt="WaveBackground" class="absolute -bottom-5 left-0 z-0">
    </div>
    <div class="footer-container-body pt-10 px-20 pb-5 text-gray-400 ">
        <div class="footer-body mb-10  font-Inter font-light">
            <div class="flex gap-16 text-sm px-2">
                <div class="shrink grow-0 text-wrap ">
                    <h4 class="font-Poppins font-semibold text-xl text-gray-200 mb-2">Lokasi</h4>
                    <p class="">Perumahan Landungsari Asri, Jl. Tirto Utomo, Desa Landungsari, Kecamatan Dau,
                        Kabupaten Malang</p>
                </div>
                <div class="grow text-nowrap">
                    <h4 class="font-Poppins font-semibold text-xl text-gray-200 mb-2">Featured Link</h4>
                    <ul class="flex flex-col gap-1">
                        <li>Desa Landungsari</li>
                        <li>Kecamatan Dau</li>
                        <li>Kabupaten Malang</li>
                        <li>Dispendukcapil Kab. Malang</li>
                        <li>Humas POLRI Malang</li>
                    </ul>
                </div>
                <div class="grow text-nowrap">
                    <h4 class="font-Poppins font-semibold text-xl text-gray-200 mb-2">Layanan</h4>
                    <ul class="flex flex-col gap-1">
                        <li>Pembayaran Iuran</li>
                        <li>Template Dokumen</li>
                        <li>Permintaan Dokumen</li>
                        <li>Pengaduan Warga</li>
                        <li>Verifikasi Warga</li>
                    </ul>
                </div>
                <div class="grow text-nowrap ">
                    <h4 class="font-Poppins font-semibold text-xl text-gray-200 mb-2">Informasi</h4>
                    <ul class="flex flex-col gap-1">
                        <li>Berita dan Informasi</li>
                        <li>UMKM</li>
                    </ul>
                </div>
                <div class="grow text-nowrap">
                    <h4 class="font-Poppins font-semibold text-xl text-gray-200 mb-2">Hubungi Kami</h4>
                    <p>Desa Landungsari, Kode Pos 651515</p>
                    <ul class="flex flex-col gap-1">
                        <li class="flex">
                            <img src="" alt="whatshapp">
                            <a href="https://wa.me/6285259478161" class="">+62 852 5947 8161</a>
                        </li>
                        <li>
                            <a href="">rwsatulds@gmail.com</a>
                        </li>
                        <li>
                            <a href="">RW 01 Landungsari</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="devide h-[1px] bg-white mb-5"></div>
        <div class="footer-copyright ">
            <p class="text-center text-xs text-gray-200">© 2024 RWify. All Rights Reserved.</p>
        </div>
    </div>
</footer>