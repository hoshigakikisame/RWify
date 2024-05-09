@php
$reservation = Vite::asset('resources/assets/images/reservation.png');
$umkm = Vite::asset('resources/assets/images/store.png');
$information = Vite::asset('resources/assets/images/loud-speaker.png');
$report = Vite::asset('resources/assets/images/no-shouting.png');
$payment = Vite::asset('resources/assets/images/tips.png');

$layanan = [
    ['title' => 'Reservasi Temu', 'href' => '', 'desc' => 'Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed do eiusmod te', 'icon' => $reservation],
    ['title' => 'Pengaduan', 'href' => route("warga.layanan.pengaduan.index"), 'desc' => 'Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed do eiusmod te', 'icon' => $report],
    ['title' => 'Pembayaran Iuran', 'href' => '', 'desc' => 'Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed do eiusmod te', 'icon' => $payment]
];
$informasi = [
    ['title' => 'Informasi UMKM', 'href' => route("informasi.umkmPage"), 'desc' => 'Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed do eiusmod te', 'icon' => $umkm],
    ['title' => 'Informasi dan Berita', 'href' => '#', 'desc' => 'Lorem ipsum dolor sit amet, consecte tur adipiscing elit, sed do eiusmod te', 'icon' => $information]
]
@endphp
<div class="nav-container px-5 lg:px-10 py-5 dark:bg-gray-800 sticky top-0 bg-gray-50 z-20">
    <nav class="flex justify-between items-center">
        <div class="navbar-brand flex dark:text-gray-200">
            <img src="" alt="logo">
            <h1 class="text-2xl ">RWify</h1>
        </div>
        <div class="navbar-body z-30">
            <ul class="link-container dark:text-gray-400 flex gap-2">
                <a href="{{route('index')}}">
                    <li class="link-item px-2 py-1 dark:hover:text-gray-100 transition-all hover:text-gray-600">Beranda</li>
                </a>
                <li class="link-item px-2 py-1 relative ">
                    <button id="dropdown-button" class="inline-flex justify-center w-full dark:hover:text-gray-100 hover:text-gray-600 transition-all">
                        <span class="">Layanan</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div id="dropdown-menu" class="hidden absolute left-1 mt-2 rounded-md shadow-lg bg-white dark:bg-gray-900 ring-1 ring-black ring-opacity-5 p-1 space-y-1">

                        <!-- Dropdown content goes here -->
                        @foreach($layanan as $item)
                        <x-dropdown.dropdownelementnavbar :title="$item['title']" :href="$item['href']" :desc="$item['desc']" :icon="$item['icon']" />
                        @endforeach
                    </div>
                </li>
                <li class="link-item px-2 py-1 relative" x-data="{ isOpen: false }">
                    <button class="inline-flex justify-center w-full dark:hover:text-gray-100 hover:text-gray-600 transition-all" x-on:click="isOpen = !isOpen" @keydown.escape="isOpen = false">
                        <span class="">Informasi</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div class="absolute left-1 mt-2 rounded-md shadow-lg bg-white dark:bg-gray-900 ring-1 ring-black ring-opacity-5 p-1 space-y-1" style="display: none;" x-show="isOpen" @click.away="isOpen = false">

                        <!-- Dropdown content goes here -->
                        @foreach($informasi as $item)
                        <x-dropdown.dropdownelementnavbar :title="$item['title']" :href="$item['href']" :desc="$item['desc']" :icon="$item['icon']" />
                        @endforeach
                    </div>
                </li>
                <a href="{{route('hubungiKami')}}">
                    <li class="link-item px-2 py-1 dark:hover:text-gray-100 hover:text-gray-600 transition-all">Hubungi Kami</li>
                </a>
            </ul>   
        </div>
        <div class="navbar-action flex gap-3">
            @php
$login = 'Sign In';
if (Auth::user()) {
    $login = 'Dashboard';
}
            @endphp

            <a class="login-button bg-green-900 text-gray-100 dark:text-gray-200 dark:bg-green-700 px-4 py-1 border border-gray-200 border-opacity-10 rounded-lg " href="{{route('auth.signIn')}}">{{$login}}</a>
            <div class=" flex justify-center" id="darkModeButton">
                <label for="themeSwitcherOne" class="themeSwitcherTwo shadow-two relative inline-flex cursor-pointer select-none items-center justify-center bg-white dark:bg-gray-900 p-1 dark:text-gray-200 border rounded-full gap-1">
                    <span id="sun" class="light text-primary bg-gray dark:bg-gray-800 bg-gray-300 flex items-center space-x-[2px] rounded-full py-2 p-2 text-sm font-medium dark:fill-slate-200">
                        <svg viewBox="0 0 16 16" class="w-3 fill-inherit">
                            <g clip-path="url(#a)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 0c.368 0 .667.298.667.667V2a.667.667 0 0 1-1.334 0V.667C7.333.298 7.632 0 8 0m0 5.333a2.667 2.667 0 1 0 0 5.334 2.667 2.667 0 0 0 0-5.334M4 8a4 4 0 1 1 8 0 4 4 0 0 1-8 0m4.667 6a.667.667 0 1 0-1.334 0v1.333a.667.667 0 1 0 1.334 0zM2.34 2.342c.26-.26.683-.26.943 0l.947.947a.667.667 0 1 1-.943.943l-.947-.947a.667.667 0 0 1 0-.943m10.37 9.426a.667.667 0 1 0-.943.943l.947.947a.667.667 0 0 0 .943-.943zM0 8c0-.368.298-.667.667-.667H2a.667.667 0 0 1 0 1.334H.667A.667.667 0 0 1 0 8m14-.667a.667.667 0 1 0 0 1.334h1.333a.667.667 0 1 0 0-1.334zm-9.77 4.435c.26.26.26.683 0 .943l-.946.947a.667.667 0 0 1-.943-.943l.947-.947c.26-.26.682-.26.943 0m9.428-8.483a.667.667 0 0 0-.943-.943l-.947.947a.667.667 0 1 0 .943.943z" />
                            </g>
                            <defs>
                                <clipPath id="a">
                                    <path fill="#fff" d="M0 0h16v16H0z" />
                                </clipPath>
                            </defs>
                        </svg>
                    </span>
                    <span id="moon" class="dark text-body-color flex items-center space-x-[2px] p-2  rounded-full py-2 text-sm font-medium dark:bg-white text-gray-800 border-opacity-20">
                        <svg viewBox="0 0 16 16" class="w-3 fill-inherit">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.055 1.673a.67.67 0 0 1-.045.724 4 4 0 0 0 5.594 5.594.667.667 0 0 1 1.06.598 6.667 6.667 0 1 1-7.251-7.252.67.67 0 0 1 .642.336M6.212 2.96a5.333 5.333 0 1 0 6.83 6.83 5.333 5.333 0 0 1-6.83-6.83" />
                        </svg>
                    </span>
                </label>
            </div>
        </div>
    </nav>
</div>

@push('scripts')
<script type="module">
    // dropdown
    const dropdownButton = document.getElementById('dropdown-button');
    const dropdownMenu = document.getElementById('dropdown-menu');
    let isOpen = true;

    function toggleDropdown() {
        isOpen = !isOpen;
        dropdownMenu.classList.toggle('hidden', !isOpen);
    }

    // Set initial state
    toggleDropdown();

    dropdownButton.addEventListener('click', () => {
        toggleDropdown();
    });


    // Close the dropdown when clicking outside of it
    document.addEventListener('click', (event) => {
        if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
            isOpen = false;
        }

    })



    // handle dark mode
    // get icon 
    const sunIcon = document.getElementById('sun')
    const moonIcon = document.getElementById('moon')

    // get vars
    const userTheme = localStorage.getItem('theme')
    const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches

    // toogle Icon active
    function iconToogle(stype) {
        $(sunIcon).toggleClass(stype)
        $(moonIcon).toggleClass(stype)

    }

    // initial theme check
    function checkTheme(stype, ftype) {
        if (userTheme === 'dark' || (!userTheme && systemTheme)) {
            document.documentElement.classList.add('dark')
            $(moonIcon).addClass(stype)
        } else {
            $(sunIcon).addClass(stype)
        }
    }

    // switch theme
    function switchTheme(stype) {
        if (document.documentElement.classList.contains("dark")) {
            document.documentElement.classList.remove('dark')
            localStorage.setItem('theme', 'light')
            iconToogle(stype)
        } else {
            document.documentElement.classList.add('dark')
            localStorage.setItem('theme', 'dark')
            iconToogle(stype)
        }
    }

    // check if user prefers dark mode in responsive device
    checkTheme('hidden')

    moonIcon.addEventListener('click', () => {
        switchTheme('hidden');

    })

    sunIcon.addEventListener('click', () => {
        switchTheme('hidden');
    })
</script>
@endpush