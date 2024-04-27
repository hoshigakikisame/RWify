@extends('layouts.app')

@section('content')
@php
$image = Vite::asset('resources/assets/images/Semeru.png');
@endphp

<div class="overflow-hidden h-screen relative">
    <div class="grid grid-rows-4 md:grid-rows-3 lg:grid-rows-1 lg:grid-cols-2 h-full bg-gray-100 dark:bg-gray-900">
        <div class="forgotPassword-image lg:relative">
            <div class="z-50 absolute right-5 xl:inset-x-5 inset-y-5 xl:inset-y-8 w-fit h-fit rounded-full p-2 bg-gray-100/20 hover:bg-gray-300/50 hover:stroke-darkGreen stroke-gray-300 transition-all">
                <a href="{{route('auth.signIn')}}" class="fill-inherit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 xl:h-10 w-8 xl:w-10 fill-inherit stroke-inherit" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
            </div>
            <div id="sign-image" class="absolute Sign-Image top-0 bottom-0 right-0 left-0 bg-cover hidden lg:block" style="background-image: url('{{$image}}')">
                <div class="text-wrap backdrop-brightness-75 dark:backdrop-brightness-90 w-full h-full flex items-center">
                    <h1 class="font-bold font-Poppins text-xl lg:text-6xl 3xl:text-8xl text-white px-7 mx-auto xl:ms-28 lg:block hidden max-w-xl">BUAT RW MENJADI LEBIH EFISIEN DENGAN RWIFY</h1>
                </div>
            </div>
        </div>
        <div class="forgotPassword-main 3xl:mx-52 mx-auto flex flex-col justify-between gap-52 lg:gap-0">
            <div class="forgotPassword-wrap px-5 lg:px-10  my-auto">
                <div class="forgotPassword-header mb-8">
                    <h1 class="2xl:text-9xl text-4xl sm:text-7xl xl:text-8xl lg:text-6xl font-bold text-wrap font-Poppins leading-tight sm:mb-5 xl:mb-2 dark:text-white">Forgot Password?</h1>
                    <p class="text-sm md:text-lg xl:text-xl font-Inter font-light dark:text-gray-200 ">Enter the email address assocoated with your account. </p>
                </div>

                <div class="forgotPassword-body md:w-3/5 xl:w-4/5">
                    <form class="form" method="POST" action="{{ route('auth.forgotPassword') }}">
                        @csrf
                        <div class="form-group mb-3 md:mb-4 lg:mb-2 {{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="">
                                <div class="mb-3">
                                    <input type=" email" name="email" id="email" class="flex h-12 w-full items-center justify-center rounded-md border p-3 text-sm outline-none border-gray-200 dark:bg-gray-900 dark:text-gray-100" placeholder="Email">
                                </div>
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="text-nowrap text-xs bg-darkGreen px-5 py-3 rounded-xl text-md font-Poppins text-gray-200 dark:bg-green-800 ">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="flex justify-center xl:mb-32 my-4" id="darkModeButton">
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
@endpush