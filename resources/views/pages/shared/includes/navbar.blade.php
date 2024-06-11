@php
    $reservation = Vite::asset('resources/assets/images/reservation.png');
    $umkm = Vite::asset('resources/assets/images/store.png');
    $information = Vite::asset('resources/assets/images/loud-speaker.png');
    $report = Vite::asset('resources/assets/images/no-shouting.png');
    $payment = Vite::asset('resources/assets/images/tips.png');

    $layanan = [
        [
            'title' => 'Reservasi Temu',
            'href' => route('warga.layanan.reservasiJadwalTemu.newReservasiJadwalTemuPage'),
            'desc' => 'Jadwalkan reservasi temu dengan ketua RW/RT',
            'icon' => $reservation,
        ],
        [
            'title' => 'Pengaduan',
            'href' => route('warga.layanan.pengaduan.newPengaduanPage'),
            'desc' => 'Laporkan pengaduan dengan cepat dan responsif',
            'icon' => $report,
        ],
        [
            'title' => 'Pembayaran Iuran',
            'href' => route('warga.layanan.pembayaranIuran.newIuranPage'),
            'desc' => 'Bayar iuran secara online dengan mudah',
            'icon' => $payment,
        ],
    ];
    $informasi = [
        [
            'title' => 'Informasi UMKM',
            'href' => route('informasi.umkmPage'),
            'desc' => 'Temukan UMKM di lingkungan RW',
            'icon' => $umkm,
        ],
        [
            'title' => 'Informasi dan Berita',
            'href' => route('informasi.pengumuman.index'),
            'desc' => 'Temukan berita dan informasi terkini',
            'icon' => $information,
        ],
    ];
@endphp

<div class="sticky top-0 z-20 w-full bg-gray-50 dark:bg-darkBg dark:shadow-lg">
    <div class="mx-auto flex max-w-screen-xl flex-col px-4 md:flex-row md:items-center md:justify-between xl:px-6 2xl:px-8"
        x-data="{ sideNavOpen: false }">
        <div class="nav-container w-full py-5">
            <nav class="flex items-center justify-between md:gap-10">
                <a href="{{ route('index') }}" class="navbar-brand flex gap-1 dark:text-gray-200">

                    <div class="h-7 w-7 rounded-lg">
                        {!! file_get_contents(Vite::asset('resources/assets/elements/rwify-logo.svg')) !!}
                    </div>
                    <h1 class="text-lg md:text-2xl pl-2 font-semibold">RWify</h1>
                </a>

                <div :class="{ 'right-0': sideNavOpen, '-right-full': !sideNavOpen }"
                    class="navbar-body absolute top-[78px] z-30 h-screen w-3/4 bg-gray-50 pb-4 transition-all dark:bg-darkBg md:static md:flex md:h-auto md:w-auto md:flex-row md:justify-end md:bg-transparent md:pb-0 md:dark:bg-transparent">
                    <ul
                        class="link-container md:p- flex flex-col justify-end fill-gray-900 px-4 pt-4 transition-all dark:fill-gray-100 dark:text-gray-200 md:flex-row md:justify-end md:px-0 md:pt-0">
                        <li
                            class="rounded-md text-end transition-all hover:bg-gray-100 dark:hover:bg-gray-700 md:text-start md:hover:bg-transparent md:hover:text-gray-600 md:dark:hover:bg-transparent md:dark:hover:text-gray-400">
                            <a href="{{ route('index') }}"
                                class="link-item flex items-center justify-end px-5 py-2 md:px-1 md:py-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="mr-3 w-4 md:hidden">
                                    <path
                                        d="m23.121 9.069-7.585-7.586a5.01 5.01 0 0 0-7.072 0L.879 9.069A2.98 2.98 0 0 0 0 11.19v9.817a3 3 0 0 0 3 3h18a3 3 0 0 0 3-3V11.19a2.98 2.98 0 0 0-.879-2.121M15 22.007H9v-3.934a3 3 0 0 1 6 0Zm7-1a1 1 0 0 1-1 1h-4v-3.934a5 5 0 0 0-10 0v3.934H3a1 1 0 0 1-1-1V11.19a1 1 0 0 1 .293-.707L9.878 2.9a3.01 3.01 0 0 1 4.244 0l7.585 7.586a1 1 0 0 1 .293.704Z" />
                                </svg>
                                <h1 class="mr-2">Beranda</h1>
                            </a>
                        </li>
                        <li class="link-item relative" x-data="{ dropdownIsOpen: false }">
                            <button
                                class="inline-flex w-full justify-end rounded-md px-2 py-2 transition-all hover:bg-gray-100 dark:hover:bg-gray-700 md:py-1 md:hover:bg-transparent md:hover:text-gray-600 md:dark:hover:bg-transparent md:dark:hover:text-gray-400"
                                x-on:click="dropdownIsOpen = !dropdownIsOpen" @keydown.escape="isOpen = false">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="mr-3 w-4 md:hidden">
                                    <path
                                        d="M11 2a2 2 0 1 1 3.999-.001A2 2 0 0 1 11 2m.942 3A3.5 3.5 0 0 1 13 7.5V8h2.407c.37 0 .665-.344.578-.704A3 3 0 0 0 13.068 5zM8 5a2 2 0 1 0 .001-3.999A2 2 0 0 0 8 5M.593 8H3v-.5c0-.98.407-1.864 1.058-2.5H2.932c-1.414 0-2.6.979-2.917 2.296-.087.36.208.704.578.704m22.642 5.015-6.804 7.637A10 10 0 0 1 8.964 24H3.999c-2.206 0-4-1.794-4-4v-5c0-2.206 1.794-4 4-4h8.857a3.14 3.14 0 0 1 2.689 1.519l3.217-3.534a2.98 2.98 0 0 1 2.085-.981 2.97 2.97 0 0 1 2.169.782 3.02 3.02 0 0 1 .218 4.23Zm-1.565-2.752a1.03 1.03 0 0 0-.728-.262 1 1 0 0 0-.699.329l-4.427 4.865a3.16 3.16 0 0 1-2.514 2.058l-5.161.737a1 1 0 1 1-.283-1.979l5.161-.737c.559-.08.98-.566.98-1.131 0-.63-.513-1.142-1.143-1.142H4c-1.103 0-2 .897-2 2v5c0 1.103.897 2 2 2h4.965a8 8 0 0 0 5.973-2.678l6.805-7.638a1.015 1.015 0 0 0-.072-1.421ZM5.607 9h4.786c.379 0 .68-.344.591-.704C10.66 6.979 9.447 6 8 6s-2.66.979-2.984 2.296c-.089.36.213.704.591.704M3 4A2 2 0 1 0 3.001.001 2 2 0 0 0 3 4" />
                                </svg>
                                <h1 class="mr-1">Layanan</h1>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    :class="{ 'rotate-180': dropdownIsOpen, 'rotate-0': !dropdownIsOpen }"
                                    class="h-5 w-5 transition-transform duration-200" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            @php
                                $cursor =
                                    request()->user()?->getRole() !=
                                    \App\Enums\User\UserRoleEnum::KETUA_RUKUN_WARGA->value
                                        ? 'cursor-pointer'
                                        : 'cursor-not-allowed active:pointer-events-none';
                            @endphp
                            <div class="left-1 flex flex-col space-y-1 rounded-md p-1 md:absolute md:mt-2 md:bg-white md:shadow-lg md:ring-1 md:ring-black md:ring-opacity-5 md:dark:bg-darkBg"
                                style="display: none" x-show="dropdownIsOpen" @click.away="dropdownIsOpen = false"
                                x-transition.opacity x-transition.duration.300ms>
                                <!-- Dropdown content goes here -->
                                @foreach ($layanan as $item)
                                    <x-dropdown.dropdown-element-navbar :title="$item['title']" :href="$item['href']"
                                        :desc="$item['desc']" :icon="$item['icon']" :class="$cursor" />
                                @endforeach
                            </div>
                        </li>
                        <li class="link-item relative" x-data="{ dropdownIsOpen: false }">
                            <button
                                class="inline-flex w-full justify-end rounded-md px-2 py-2 transition-all hover:bg-gray-100 dark:hover:bg-gray-700 md:py-1 md:hover:bg-transparent md:hover:text-gray-600 md:dark:hover:bg-transparent md:dark:hover:text-gray-400"
                                x-on:click="dropdownIsOpen = !dropdownIsOpen" @keydown.escape="isOpen = false">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="mr-3 w-4 md:hidden">
                                    <path
                                        d="M23.938 17.305 21.966 6.131A4.99 4.99 0 0 0 17.042 2H6.958C3.5 2 2.294 4.655 2.034 6.131L.062 17.305a4 4 0 0 0 .875 3.267 4 4 0 0 0 3.064 1.429H5a1 1 0 1 0 0-2h-.999a2 2 0 0 1-1.532-.715 2 2 0 0 1-.438-1.633L4.003 6.479c.062-.354.185-.684.355-.979l2.339 12.426a5.004 5.004 0 0 0 4.914 4.075h8.387a3.99 3.99 0 0 0 3.064-1.429 4 4 0 0 0 .875-3.267Zm-2.407 1.98a2 2 0 0 1-1.532.715h-8.387a3 3 0 0 1-2.948-2.444L6.133 4.115q.396-.113.824-.114h10.085a2.995 2.995 0 0 1 2.954 2.479l1.972 11.174a2 2 0 0 1-.438 1.633ZM10 9a1 1 0 0 1 0-2h7a1 1 0 0 1 0 2zm.731 4a1 1 0 0 1 0-2h7a1 1 0 0 1 0 2zm8.769 3a1 1 0 0 1-1 1h-7a1 1 0 1 1 0-2h7a1 1 0 0 1 1 1" />
                                </svg>
                                <h1 class="mr-1">Informasi</h1>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    :class="{ 'rotate-180': dropdownIsOpen, 'rotate-0': !dropdownIsOpen }"
                                    class="h-5 w-5 transition-transform duration-200" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div class="left-1 flex flex-col space-y-1 rounded-md p-1 md:absolute md:mt-2 md:bg-white md:shadow-lg md:ring-1 md:ring-black md:ring-opacity-5 md:dark:bg-darkBg"
                                style="display: none" x-show="dropdownIsOpen" @click.away="dropdownIsOpen = false"
                                x-transition.opacity x-transition.duration.300ms>
                                <!-- Dropdown content goes here -->
                                @foreach ($informasi as $item)
                                    <x-dropdown.dropdown-element-navbar :title="$item['title']" :href="$item['href']"
                                        :desc="$item['desc']" :icon="$item['icon']" />
                                @endforeach
                            </div>
                        </li>
                        <li
                            class="rounded-md text-end transition-all hover:bg-gray-100 dark:hover:bg-gray-700 md:text-start md:hover:bg-transparent md:hover:text-gray-600 md:dark:hover:bg-transparent md:dark:hover:text-gray-400">
                            <a href="{{ route('hubungiKami') }}"
                                class="link-item flex items-center justify-end px-5 py-2 md:px-1 md:py-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="mr-3 w-4 md:hidden">
                                    <path
                                        d="M11 13.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5m1.5 3.5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5 1.5-.67 1.5-1.5-.67-1.5-1.5-1.5m5-2c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5-1.5.67-1.5 1.5.67 1.5 1.5 1.5m0 5c.83 0 1.5-.67 1.5-1.5s-.67-1.5-1.5-1.5-1.5.67-1.5 1.5.67 1.5 1.5 1.5M24 6.24V19c0 2.76-2.24 5-5 5H4c-2.21 0-4-1.79-4-4V8c0-2.21 1.79-4 4-4s4 1.79 4 4h2V4c0-2.21 1.79-4 4-4h3.76c1.07 0 2.07.42 2.83 1.17l2.24 2.24c.74.74 1.17 1.77 1.17 2.83M6 8c0-1.1-.9-2-2-2s-2 .9-2 2v12c0 1.1.9 2 2 2s2-.9 2-2zm6 0h10V6.24c0-.08 0-.16-.02-.24H20c-1.1 0-2-.9-2-2V2.02c-.08 0-.16-.02-.24-.02H14c-1.1 0-2 .9-2 2zm10 2H8v10c0 .73-.2 1.41-.54 2H19c1.65 0 3-1.35 3-3z" />
                                </svg>
                                <h1>Hubungi Kami</h1>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="navbar-action ms-2 flex items-center gap-3">
                    @php
                        $login = 'Sign In';
                        if (Auth::user()) {
                            $login = 'Dashboard';
                        }
                    @endphp

                    <a class="login-button order-2 h-fit rounded-lg border border-gray-200 border-opacity-10 bg-green-900 px-2 py-1 text-gray-100 dark:bg-green-700 dark:text-gray-200 md:order-1 md:px-4"
                        href="{{ route('auth.signIn') }}">
                        <h1 class="text-xs md:text-sm">{{ $login }}</h1>
                    </a>
                    <x-button.dark-mode-button isSimple=true class="order-1 md:order-2"></x-button.dark-mode-button>

                    {{-- <div class="order-1 flex justify-center md:order-2" id="darkModeButton">
                        <label for="themeSwitcherOne"
                            class="themeSwitcherTwo shadow-two relative inline-flex cursor-pointer select-none items-center justify-center gap-1 rounded-full border bg-white p-1 dark:bg-darkBg dark:text-gray-200">
                            <span id="sun"
                                class="light text-primary bg-gray flex items-center space-x-[2px] rounded-full bg-gray-300 p-2 py-2 text-sm font-medium dark:bg-darkBg dark:fill-slate-200">
                                <svg viewBox="0 0 16 16" class="w-3 fill-inherit">
                                    <g clip-path="url(#a)">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8 0c.368 0 .667.298.667.667V2a.667.667 0 0 1-1.334 0V.667C7.333.298 7.632 0 8 0m0 5.333a2.667 2.667 0 1 0 0 5.334 2.667 2.667 0 0 0 0-5.334M4 8a4 4 0 1 1 8 0 4 4 0 0 1-8 0m4.667 6a.667.667 0 1 0-1.334 0v1.333a.667.667 0 1 0 1.334 0zM2.34 2.342c.26-.26.683-.26.943 0l.947.947a.667.667 0 1 1-.943.943l-.947-.947a.667.667 0 0 1 0-.943m10.37 9.426a.667.667 0 1 0-.943.943l.947.947a.667.667 0 0 0 .943-.943zM0 8c0-.368.298-.667.667-.667H2a.667.667 0 0 1 0 1.334H.667A.667.667 0 0 1 0 8m14-.667a.667.667 0 1 0 0 1.334h1.333a.667.667 0 1 0 0-1.334zm-9.77 4.435c.26.26.26.683 0 .943l-.946.947a.667.667 0 0 1-.943-.943l.947-.947c.26-.26.682-.26.943 0m9.428-8.483a.667.667 0 0 0-.943-.943l-.947.947a.667.667 0 1 0 .943.943z" />
                                    </g>
                                    <defs>
                                        <clipPath id="a">
                                            <path fill="#fff" d="M0 0h16v16H0z" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </span>
                            <span id="moon"
                                class="text-body-color dark flex items-center space-x-[2px] rounded-full border-opacity-20 p-2 py-2 text-sm font-medium text-gray-800 dark:bg-white">
                                <svg viewBox="0 0 16 16" class="w-3 fill-inherit">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.055 1.673a.67.67 0 0 1-.045.724 4 4 0 0 0 5.594 5.594.667.667 0 0 1 1.06.598 6.667 6.667 0 1 1-7.251-7.252.67.67 0 0 1 .642.336M6.212 2.96a5.333 5.333 0 1 0 6.83 6.83 5.333 5.333 0 0 1-6.83-6.83" />
                                </svg>
                            </span>
                        </label>
                    </div> --}}
                    <div class="button-mobile order-last flex flex-col justify-center">
                        <button
                            class="focus:shadow-outline rounded-lg fill-gray-900 focus:outline-none dark:fill-gray-100 md:hidden"
                            @click="sideNavOpen = !sideNavOpen">
                            <svg viewBox="0 0 20 20" class="h-6 w-6">
                                <path x-show="!sideNavOpen" x-cloak fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                                <path x-show="sideNavOpen" fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
@push('scripts')
    <script type="module">
        // handle dark mode
        // get icon
        const sunIcon = document.getElementById('sun');
        const moonIcon = document.getElementById('moon');

        // get vars
        const userTheme = localStorage.getItem('theme');
        const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches;

        // toogle Icon active
        function iconToogle(stype) {
            $(sunIcon).toggleClass(stype);
            $(moonIcon).toggleClass(stype);
        }

        // initial theme check
        function checkTheme(stype, ftype) {
            if (userTheme === 'dark' || (!userTheme && systemTheme)) {
                document.documentElement.classList.add('dark');
                $(moonIcon).addClass(stype);
            } else {
                $(sunIcon).addClass(stype);
            }
        }

        // switch theme
        function switchTheme(stype) {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
                iconToogle(stype);
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                iconToogle(stype);
            }
        }

        // check if user prefers dark mode in responsive device
        checkTheme('hidden');

        moonIcon.addEventListener('click', () => {
            switchTheme('hidden');
        });

        sunIcon.addEventListener('click', () => {
            switchTheme('hidden');
        });
    </script>
@endpush
