@extends('layouts.app')

@section('content')
    @php
        $image = Vite::asset('resources/assets/images/Semeru.png');
    @endphp

    <div class="relative h-screen overflow-hidden">
        <div class="grid h-full grid-rows-4 bg-gray-50 dark:bg-darkBg md:grid-rows-3 lg:grid-cols-2 lg:grid-rows-1">
            <div class="resetPassword-image lg:relative">
                <div
                    class="absolute inset-y-5 right-5 z-50 h-fit w-fit rounded-full bg-gray-100/20 stroke-gray-300 p-2 transition-all hover:bg-gray-300/50 hover:stroke-darkGreen xl:inset-x-5 xl:inset-y-8"
                >
                    <a href="{{ route('auth.signIn') }}" class="fill-inherit">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 fill-inherit stroke-inherit xl:h-10 xl:w-10"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"
                            ></path>
                        </svg>
                    </a>
                </div>
                <div
                    id="resetPassword-image"
                    class="Sign-Image absolute bottom-0 left-0 right-0 top-0 hidden bg-cover lg:block"
                    style="background-image: url('{{ $image }}')"
                >
                    <div
                        class="flex h-full w-full items-center text-wrap backdrop-brightness-75 dark:backdrop-brightness-90"
                    >
                        <h1
                            class="3xl:text-8xl mx-auto hidden max-w-xl px-7 font-Poppins text-xl font-bold text-white lg:block lg:text-6xl xl:ms-28"
                        >
                            BUAT RW MENJADI LEBIH EFISIEN DENGAN RWIFY
                        </h1>
                    </div>
                </div>
            </div>
            <div class="form-login lg:overflow-hidden">
                <div class="no-scrollbar h-screen overflow-scroll">
                    <div class="resetPassword-main 3xl:mx-52 mx-auto my-auto mt-20 flex flex-col items-center gap-28">
                        <div class="resetPassword-wrap my-auto inline-flex flex-col items-center px-5 lg:px-10">
                            <div class="resetPassword-header mb-8 w-fit">
                                <div class="header-wrap mx-auto w-3/5">
                                    <h1
                                        class="text-wrap font-Poppins text-4xl font-bold leading-tight dark:text-white sm:mb-5 sm:text-7xl lg:text-6xl xl:mb-2 xl:text-7xl"
                                    >
                                        Reset Password
                                    </h1>
                                    <p class="font-Inter text-sm font-light dark:text-gray-200 md:text-lg xl:text-xl">
                                        Enter current password and new password for assocoated with your account.
                                    </p>
                                </div>
                            </div>

                            <div class="resetPassword-body md:w-3/5">
                                <form class="form" method="POST" action="{{ route('password.update') }}">
                                    @csrf

                                    {{-- hidden token --}}
                                    <input type="hidden" name="token" value="{{ $token }}" />
                                    <div class="form-group mb-5">
                                        <label for="email" class="text-gray-600 dark:text-gray-300">
                                            E-Mail Address
                                        </label>

                                        <div class="col-md-6">
                                            <input
                                                id="email"
                                                type="email"
                                                class="flex h-12 w-full items-center justify-center rounded-md border border-gray-200 p-3 text-sm outline-none dark:bg-darkBg dark:text-gray-100"
                                                name="email"
                                                value="{{ old('email') }}"
                                                required
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group mb-5">
                                        <label for="password" class="text-gray-600 dark:text-gray-300">Password</label>

                                        <div class="col-md-6">
                                            <input
                                                id="password"
                                                type="password"
                                                class="flex h-12 w-full items-center justify-center rounded-md border border-gray-200 p-3 text-sm outline-none dark:bg-darkBg dark:text-gray-100"
                                                name="password"
                                                required
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 md:mb-4 lg:mb-3">
                                        <label for="password_confirmation" class="text-gray-600 dark:text-gray-300">
                                            Confirm Password
                                        </label>

                                        <div class="col-md-6">
                                            <input
                                                id="password_confirmation"
                                                type="password"
                                                class="flex h-12 w-full items-center justify-center rounded-md border border-gray-200 p-3 text-sm outline-none dark:bg-darkBg dark:text-gray-100"
                                                name="password_confirmation"
                                                required
                                            />
                                        </div>
                                    </div>

                                    <div class="form-group mt-8">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button
                                                type="submit"
                                                class="text-md text-nowrap rounded-lg bg-darkGreen px-5 py-3 font-Poppins text-sm font-medium text-gray-200 dark:bg-green-800"
                                            >
                                                Reset Password
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="my-4 flex justify-center xl:mb-32" id="darkModeButton">
                            <label
                                for="themeSwitcherOne"
                                class="themeSwitcherTwo shadow-two relative inline-flex cursor-pointer select-none items-center justify-center gap-1 rounded-full border bg-white p-1 dark:bg-darkBg dark:text-gray-200"
                            >
                                <span
                                    id="sun"
                                    class="light text-primary bg-gray flex items-center space-x-[2px] rounded-full bg-gray-300 p-2 py-2 text-sm font-medium dark:bg-darkBg dark:fill-slate-200 lg:px-[18px]"
                                >
                                    <svg width="16" height="16" viewBox="0 0 16 16" class="fill-inherit">
                                        <g clip-path="url(#a)">
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M8 0c.368 0 .667.298.667.667V2a.667.667 0 0 1-1.334 0V.667C7.333.298 7.632 0 8 0m0 5.333a2.667 2.667 0 1 0 0 5.334 2.667 2.667 0 0 0 0-5.334M4 8a4 4 0 1 1 8 0 4 4 0 0 1-8 0m4.667 6a.667.667 0 1 0-1.334 0v1.333a.667.667 0 1 0 1.334 0zM2.34 2.342c.26-.26.683-.26.943 0l.947.947a.667.667 0 1 1-.943.943l-.947-.947a.667.667 0 0 1 0-.943m10.37 9.426a.667.667 0 1 0-.943.943l.947.947a.667.667 0 0 0 .943-.943zM0 8c0-.368.298-.667.667-.667H2a.667.667 0 0 1 0 1.334H.667A.667.667 0 0 1 0 8m14-.667a.667.667 0 1 0 0 1.334h1.333a.667.667 0 1 0 0-1.334zm-9.77 4.435c.26.26.26.683 0 .943l-.946.947a.667.667 0 0 1-.943-.943l.947-.947c.26-.26.682-.26.943 0m9.428-8.483a.667.667 0 0 0-.943-.943l-.947.947a.667.667 0 1 0 .943.943z"
                                            />
                                        </g>
                                        <defs>
                                            <clipPath id="a">
                                                <path fill="#fff" d="M0 0h16v16H0z" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span class="hidden md:block">Light</span>
                                </span>
                                <span
                                    id="moon"
                                    class="text-body-color dark flex items-center space-x-[2px] rounded-full p-2 py-2 text-sm font-medium text-gray-800 dark:bg-white lg:px-[18px]"
                                >
                                    <svg width="16" height="16" viewBox="0 0 16 16" class="fill-inherit">
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M8.055 1.673a.67.67 0 0 1-.045.724 4 4 0 0 0 5.594 5.594.667.667 0 0 1 1.06.598 6.667 6.667 0 1 1-7.251-7.252.67.67 0 0 1 .642.336M6.212 2.96a5.333 5.333 0 1 0 6.83 6.83 5.333 5.333 0 0 1-6.83-6.83"
                                        />
                                    </svg>
                                    <span class="hidden md:block">Dark</span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
            sunIcon.classList.toggle(stype);
            moonIcon.classList.toggle(stype);
        }

        // initial theme check
        function checkTheme(stype) {
            if (userTheme === 'dark' || (!userTheme && systemTheme)) {
                document.documentElement.classList.add('dark');
                moonIcon.classList.add(stype);
            } else {
                sunIcon.classList.add(stype);
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
        if (window.innerWidth < 768) {
            checkTheme('hidden');
            moonIcon.addEventListener('click', () => {
                switchTheme('hidden');
            });
            sunIcon.addEventListener('click', () => {
                switchTheme('hidden');
            });
        } else {
            checkTheme('fill-blue-500');
            moonIcon.addEventListener('click', () => {
                switchTheme('fill-blue-500');
            });
            sunIcon.addEventListener('click', () => {
                switchTheme('fill-blue-500');
            });
        }
    </script>
@endpush
