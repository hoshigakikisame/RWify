@php
    $image = Vite::asset('resources/assets/elements/waveLanding.svg');
@endphp

<footer class="relative bg-darkGreen pb-5">
    <div class="footer-devided relative">
        <img src="{{ $image }}" alt="WaveBackground" class="absolute -bottom-2 left-0 z-0 sm:-bottom-5" />
    </div>
    <div class="footer-container-body mb-16 pb-5 pt-10 text-gray-400 sm:px-20">
        <div class="footer-body mb-10 hidden font-Inter font-light lg:block">
            <div class="flex gap-16 px-2 text-sm">
                <div class="shrink grow-0 text-wrap">
                    <h4 class="mb-2 font-Poppins text-xl font-semibold text-gray-200">Lokasi</h4>
                    <a href="https://maps.app.goo.gl/XrTjTRXE31fawi9d9" target="_blank" class="hover:text-white">
                        <p class="">
                            Perumahan Landungsari Asri, Jl. Tirto Utomo, Desa Landungsari, Kecamatan Dau, Kabupaten
                            Malang
                        </p>
                    </a>
                </div>
                <div class="grow text-nowrap">
                    <h4 class="mb-2 font-Poppins text-xl font-semibold text-gray-200">Featured Link</h4>
                    <ul class="flex flex-col gap-1">
                        <a href="http://landungsari-malangkab.desa.id/" target="_blank" class="hover:text-white">
                            <li>Desa Landungsari</li>
                        </a>
                        <a href="https://dau.malangkab.go.id/pd/" target="_blank" class="hover:text-white">
                            <li>Kecamatan Dau</li>
                        </a>
                        <a href="https://www.malangkab.go.id/" target="_blank" class="hover:text-white">
                            <li>Kabupaten Malang</li>
                        </a>
                        <a href="https://dispendukcapil.malangkab.go.id/pd/" target="_blank" class="hover:text-white">
                            <li>Dispendukcapil Kab. Malang</li>
                        </a>
                        <a href="https://humaspolresmalang.com/" target="_blank" class="hover:text-white">
                            <li>Humas Polri Malang</li>
                        </a>
                    </ul>
                </div>
                <div class="grow text-nowrap">
                    <h4 class="mb-2 font-Poppins text-xl font-semibold text-gray-200">Layanan</h4>
                    <ul class="flex flex-col gap-1">
                        <a href={{ route('warga.layanan.pembayaranIuran.newIuranPage') }} target="_blank"
                            class="hover:text-white">
                            <li>Pembayaran Iuran</li>
                        </a>
                        <a href={{ route('warga.layanan.reservasiJadwalTemu.newReservasiJadwalTemuPage') }}
                            target="_blank" class="hover:text-white">
                            <li>Reservasi Temu</li>
                        </a>
                        <a href={{ route('warga.layanan.pengaduan.newPengaduanPage') }} target="_blank"
                            class="hover:text-white">
                            <li>Pengaduan Warga</li>
                        </a>

                    </ul>
                </div>
                <div class="grow text-nowrap">
                    <h4 class="mb-2 font-Poppins text-xl font-semibold text-gray-200">Informasi</h4>
                    <ul class="flex flex-col gap-1">
                        <a href={{ route('informasi.pengumuman.index') }} target="_blank" class="hover:text-white">
                            <li>Berita dan Informasi</li>
                        </a>
                        <a href={{ route('informasi.umkmPage') }} target="_blank" class="hover:text-white">
                            <li>Informasi UMKM</li>
                        </a>
                    </ul>
                </div>
                <div class="grow text-nowrap">
                    <h4 class="mb-2 font-Poppins text-xl font-semibold text-gray-200">Hubungi Kami</h4>
                    <p>Desa Landungsari, Kode Pos 651515</p>
                    <ul class="mt-4 flex flex-col gap-1">
                        <li class="flex">
                            <a href="https://wa.me/6285259478161" target="_blank"
                                class="flex items-center hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M19.05 4.91A9.816 9.816 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.264 8.264 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.183 8.183 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07c0 1.22.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28" />
                                </svg>
                                <span>+62 852 5947 8161</span>
                            </a>
                        </li>
                        <li class="flex">
                            <a href="mailto:rwsatulds@gmail.com" class="flex items-center hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" viewBox="0 0 24 24">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M6.712 3.97a59.38 59.38 0 0 1 10.576 0l1.518.136A3.28 3.28 0 0 1 21.76 6.9a35.257 35.257 0 0 1 0 10.2a3.28 3.28 0 0 1-2.954 2.793l-1.518.136a59.38 59.38 0 0 1-10.576 0l-1.518-.136A3.28 3.28 0 0 1 2.24 17.1a35.257 35.257 0 0 1 0-10.2a3.28 3.28 0 0 1 2.954-2.794zm-.856 2.87a.75.75 0 0 0-1.106.66V17a.75.75 0 0 0 1.5 0V8.756l5.394 2.904c.222.12.49.12.712 0l5.394-2.904V17a.75.75 0 0 0 1.5 0V7.5a.75.75 0 0 0-1.106-.66L12 10.148z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>rwsatulds@gmail.com</span>
                            </a>
                        </li>
                        <li class="flex">
                            <a href="https://www.facebook.com/RW01Landungsari" target="_blank"
                                class="flex items-center hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95" />
                                </svg>
                                <span>RW 01 Landungsari</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="devide mb-5 hidden h-[1px] bg-white sm:block"></div>
        <div class="footer-copyright">
            <p class="text-center text-xs text-gray-200">© 2024 RWify. All Rights Reserved.</p>
        </div>
    </div>
</footer>
