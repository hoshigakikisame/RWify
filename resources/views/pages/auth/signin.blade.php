{{-- extend to layouts/app --}}
@extends('layouts.app')

{{-- content --}}
@section('content')
@php
$image = Vite::asset('resources/assets/images/Semeru.png');
$signInElement = Vite::asset('resources/assets/elements/signInElement.svg');
$signInElementDark = Vite::asset('resources/assets/elements/signInElementDark.svg');
$googleIcon = Vite::asset('resources/assets/elements/google-icon.svg');
@endphp
<div class="grid grid-rows-4 md:grid-rows-3 lg:grid-rows-1 lg:grid-cols-2 h-screen">

    <div class="relative">
        <div class="invisible hidden bg-rose-200 text-rose-700">
        </div>
        <div class="z-50 absolute right-5 xl:inset-x-5 inset-y-5 xl:inset-y-8 w-fit h-fit rounded-full p-2 bg-gray-100/20 hover:bg-gray-300/50 hover:stroke-darkGreen stroke-gray-300 transition-all">
            <a href="{{route('index')}}" class="fill-inherit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 xl:h-10 w-8 xl:w-10 fill-inherit stroke-inherit" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
        </div>
        <div id="sign-image" class="absolute Sign-Image top-0 bottom-0 right-0 left-0 bg-cover " style="background-image: url('{{$image}}')">
            <div class="text-wrap backdrop-brightness-75 dark:backdrop-brightness-90 w-full h-full flex items-center">
                <h1 class="font-bold font-Poppins text-xl lg:text-6xl 3xl:text-8xl text-white px-7 mx-auto xl:ms-28 lg:block hidden max-w-xl">BUAT RW MENJADI LEBIH EFISIEN DENGAN RWIFY</h1>
                <img src="{{$signInElement}}" class="lg:hidden absolute -bottom-1 bg-transparent w-full z-10 dark:hidden" alt="data">
                <img src="{{$signInElementDark}}" class="dark:lg:hidden absolute -bottom-1 bg-transparent w-full z-10 hidden dark:block" alt="data">
            </div>
        </div>
    </div>

    <div class="form-login lg:overflow-hidden">
        <div class="h-screen overflow-scroll no-scrollbar ">
            <div class="container-fluid flex flex-col items-center text-darkLightGrey gap-5 lg:gap-2 lg:mt-12 xl:mt-32 lg:mb-10">
                <div class="signIn-header text-center lg:w-2/3 2xl:w-1/2 md:px-10 flex flex-col gap-2 mb-4">
                    <h1 class=" text-5xl my-1 font-Inter font-bold dark:text-gray-100">Sign In</h1>
                    <p class="font-light font-Inter px-16 lg:p-2 dark:text-gray-200">Silahkan Sign In Untuk Pengalaman Terhubung yang Lebih Baik</p>
                </div>
                @csrf
                <div class="signIn-body pt-2 md:px-24 w-full p-8 pb-0 2xl:w-2/3 lg:p-9 2xl:p-5 flex flex-col gap-3">

                    <!-- Image Sign -->
                    <button class="sso sm:w-full border sm:rounded-md text-center sm:p-2 cursor-pointer flex justify-center gap-3 items-center order-last lg:order-none mb-6 hover:bg-gray-100 transition-all focus:opacity-[0.85] w-fit p-4 rounded-full mx-auto sm:mx-0 dark:hover:bg-gray-800" onclick="window.open(`{{ route('auth.google.index') }}`, '_self');">
                        <img src="{{$googleIcon}}" alt="Google">
                        <h1 class="hidden lg:block dark:text-gray-200">Log In dengan Google</h1>
                    </button>
                    <!-- Devider  -->
                    <div class="devide flex justify-between items-center gap-2 sm:gap-7 w-full order-2 lg:order-none mb-2">
                        <div class="line h-[0.15vh] bg-alum grow "></div>
                        <p class="text-[9px] sm:text-xs shrink dark:text-gray-200">Atau Melanjutkan Menggunakan</p>
                        <div class="line h-[0.15vh] grow bg-alum"></div>
                    </div>
                    @include('components.message.flash-message')

                    <!-- Sign In with Forms -->
                    <form action="{{ route('auth.signIn') }}" method="post" class="mb-2 ">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="font-Inter text-xs text-darkBlue font-normal opacity-70 dark:text-white">Email</label>
                            <input type=" email" name="email" id="email" class="flex h-12 w-full items-center justify-center rounded-md border p-3 text-sm outline-none border-gray-200 dark:bg-gray-900 dark:text-gray-100" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="font-Inter text-xs text-darkBlue font-normal opacity-70 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" class="flex h-12 w-full items-center justify-center rounded-md border p-3 text-sm outline-none focus:border-gray-200 focus:ring-0  border-gray-200 dark:bg-gray-900 dark:text-gray-100" placeholder="Password">
                        </div>
                        <p class="font-Inter text-xs dark:text-gray-400">Lupa Password Anda? <a href="{{route('auth.forgotPassword')}}" class="text-darkGreen dark:text-green-600">Klik Disini</a></p>
                        <div class="submit-btn" style="margin-top: 20px;">
                            <button type="submit" class="middle none center w-full rounded-md bg-darkGreen py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-darkGreen/20 transition-all hover:shadow-lg hover:shadow-darkGreen/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none dark:bg-green-700 dark:hover:shadow-green-700/40">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="flex justify-center xl:mb-32" id="darkModeButton">
                <label for="themeSwitcherOne" class="themeSwitcherTwo shadow-two relative inline-flex cursor-pointer select-none items-center justify-center bg-white dark:bg-gray-900 p-1 dark:text-gray-200 border rounded-full gap-1">
                    <span id="sun" class="light text-primary bg-gray dark:bg-gray-800 bg-gray-300 flex items-center space-x-[2px] rounded-full py-2 p-2 lg:px-[18px] text-sm font-medium dark:fill-slate-200">
                        <svg width="16" height="16" viewBox="0 0 16 16" class="fill-inherit">
                            <g clip-path="url(#a)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 0c.368 0 .667.298.667.667V2a.667.667 0 0 1-1.334 0V.667C7.333.298 7.632 0 8 0m0 5.333a2.667 2.667 0 1 0 0 5.334 2.667 2.667 0 0 0 0-5.334M4 8a4 4 0 1 1 8 0 4 4 0 0 1-8 0m4.667 6a.667.667 0 1 0-1.334 0v1.333a.667.667 0 1 0 1.334 0zM2.34 2.342c.26-.26.683-.26.943 0l.947.947a.667.667 0 1 1-.943.943l-.947-.947a.667.667 0 0 1 0-.943m10.37 9.426a.667.667 0 1 0-.943.943l.947.947a.667.667 0 0 0 .943-.943zM0 8c0-.368.298-.667.667-.667H2a.667.667 0 0 1 0 1.334H.667A.667.667 0 0 1 0 8m14-.667a.667.667 0 1 0 0 1.334h1.333a.667.667 0 1 0 0-1.334zm-9.77 4.435c.26.26.26.683 0 .943l-.946.947a.667.667 0 0 1-.943-.943l.947-.947c.26-.26.682-.26.943 0m9.428-8.483a.667.667 0 0 0-.943-.943l-.947.947a.667.667 0 1 0 .943.943z" />
                            </g>
                            <defs>
                                <clipPath id="a">
                                    <path fill="#fff" d="M0 0h16v16H0z" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span class="hidden md:block">Light</span>
                    </span>
                    <span id="moon" class="dark text-body-color flex items-center space-x-[2px] p-2 lg:px-[18px] rounded-full py-2 text-sm font-medium dark:bg-white text-gray-800">
                        <svg width="16" height="16" viewBox="0 0 16 16" class="fill-inherit">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.055 1.673a.67.67 0 0 1-.045.724 4 4 0 0 0 5.594 5.594.667.667 0 0 1 1.06.598 6.667 6.667 0 1 1-7.251-7.252.67.67 0 0 1 .642.336M6.212 2.96a5.333 5.333 0 1 0 6.83 6.83 5.333 5.333 0 0 1-6.83-6.83" />
                        </svg>
                        <span class="hidden md:block">Dark</span>
                    </span>
                </label>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="module">
    // handle dark mode
    // get icon 
    const sunIcon = document.getElementById('sun')
    const moonIcon = document.getElementById('moon')

    // get vars
    const userTheme = localStorage.getItem('theme')
    const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches

    // toogle Icon active
    function iconToogle(stype) {
        sunIcon.classList.toggle(stype)
        moonIcon.classList.toggle(stype)
    }

    // initial theme check
    function checkTheme(stype) {
        if (userTheme === 'dark' || (!userTheme && systemTheme)) {
            document.documentElement.classList.add('dark')
            moonIcon.classList.add(stype)
        } else {
            sunIcon.classList.add(stype)
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
    if (window.innerWidth < 768) {
        checkTheme('hidden')
        moonIcon.addEventListener('click', () => {
            switchTheme('hidden');
        })
        sunIcon.addEventListener('click', () => {
            switchTheme('hidden');
        })
    } else {
        checkTheme('fill-blue-500')
        moonIcon.addEventListener('click', () => {
            switchTheme('fill-blue-500');
        })
        sunIcon.addEventListener('click', () => {
            switchTheme('fill-blue-500');
        })
    }
</script>
<script>
    const unsplashUrl = "https://api.unsplash.com/photos/random?query=malang"
    const pexelsUrl = "https://api.pexels.com/v1/search?query=malang"
    const apiKeyUnsplash = "Client-ID vBq0Ro-C7xFRg_Fz3X6j_iYqw3eDsQag0jpWYmBI95o"
    const apiKeyPexels = " UaEae7XJhvIEK5BUTRVuRVGbGUuQkPHtIzNTgt3tWzfCFcneAdBaGUK5"
    async function getMalangImage(url, token) {
        let headers = new Headers();
        headers.append("Authorization", `${token}`);
        const response = await fetch(`${url}`, {
            headers: headers
        });
        const data = await response.json();
        return data.urls.regular;
    }

    const malangImage = async () => {
        try {
            const imgUrl = await getMalangImage(unsplashUrl, apiKeyUnsplash);
            setImageUrl(imgUrl)
        } catch (e) {
            console.error(e)
        }
    }

    function setImageUrl(imgUrl) {
        const image = document.getElementById('sign-image');
        image.style.backgroundImage = `url(${imgUrl})`;
        $(image).addClass('absolute Sign-Image top-0 bottom-0 right-0 left-0 bg-cover')
    }

    const interval = 72_000;
    setInterval(() => {
        $('#sign-image').fadeOut('slow', async () => {
            await malangImage();
            $('#sign-image').fadeIn(2000)
        });
    }, interval);
</script>
@endpush