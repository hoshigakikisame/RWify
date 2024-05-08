<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    @stack('style')
</head>

<body class="relative bg-white dark:bg-gray-900">
    <x-loading.loading />
    <main class="flex">
        @php
        $footerMenu = ['Profile' => ['link'=> route('user.profile.index'),'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4">
            <path d="M12 12a6 6 0 1 0-6-6 6.006 6.006 0 0 0 6 6m0-10a4 4 0 1 1-4 4 4 4 0 0 1 4-4m0 12a9.01 9.01 0 0 0-9 9 1 1 0 0 0 2 0 7 7 0 0 1 14 0 1 1 0 0 0 2 0 9.01 9.01 0 0 0-9-9" />
        </svg>'], 'Sign Out' => ['link'=> route('auth.signOut'),'icon'=>'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4">
            <path d="M11.476 15a1 1 0 0 0-1 1v3a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3h2.476a3 3 0 0 1 3 3v3a1 1 0 0 0 2 0V5a5.006 5.006 0 0 0-5-5H5a5.006 5.006 0 0 0-5 5v14a5.006 5.006 0 0 0 5 5h2.476a5.006 5.006 0 0 0 5-5v-3a1 1 0 0 0-1-1" />
            <path d="m22.867 9.879-4.586-4.586a1 1 0 1 0-1.414 1.414l4.262 4.263L6 11a1 1 0 0 0 0 2l15.188-.031-4.323 4.324a1 1 0 1 0 1.414 1.414l4.586-4.586a3 3 0 0 0 .002-4.242" />
        </svg>']];
        @endphp
        <x-sidebar.sidebarwrap email="{{auth()->user()->getEmail()}}" role="{{auth()->user()->getRole()}}" :imageProfile="auth()->user()->getImageUrl()" :footerMenu="$footerMenu">
            @yield('menu')
        </x-sidebar.sidebarwrap>
        <div class=" overflow-hidden w-full">
            @include('components.message.flash-message')
            <div class="h-screen overflow-scroll no-scrollbar w-full ">
                @yield('content')
            </div>
            @stack('modals')
        </div>
    </main>
    @stack('scripts')
    <script type="module">
        //dropdown selector
        const footerMenuButton = document.querySelectorAll('#moreButton');
        const footerMenu = document.getElementById('moreMenu');
        let isFooterMenuOpen = !false; // Set to true to open the dropdown by default, false to close it by default

        // Function to toggle the dropdown
        function toggleDropdown() {
            isFooterMenuOpen = !isFooterMenuOpen;
            if (isFooterMenuOpen) {
                footerMenu.classList.remove('hidden');
            } else {
                footerMenu.classList.add('hidden');
            }
        }

        // Initialize the dropdown state
        toggleDropdown();

        // Toggle the dropdown when the button is clicked
        footerMenuButton.forEach((e) => {
            e.addEventListener('click', toggleDropdown);
        })


        // Close the dropdown when clicking outside of it
        document.addEventListener('click', (event) => {
            if (!footerMenuButton[0].contains(event.target) && !footerMenuButton[1].contains(event.target) && !footerMenu.contains(event.target)) {
                footerMenu.classList.add('hidden');
                isFooterMenuOpen = false;
            }

        })


        // hover for mobile views
        $('.nav-item a').on('mouseover', (e) => {
            if ($(window).width() < 1024) {
                $($(e.currentTarget).children('span')).fadeIn(200, () => {
                    $(e.currentTarget).children('span').removeClass('hidden')
                });
            }
        })

        $('.nav-item a').on('mouseleave', (e) => {
            if ($(window).width() < 1024) {
                $($(e.currentTarget).children('span')).fadeOut(50, () => {
                    $(e.currentTarget).children('span').addClass('hidden')
                });
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
        if (window.innerWidth < 1024) {
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


        //handle hover truncate for profile
        $('.overflow-data').on('mouseover', (e) => {
            $(e.currentTarget).removeClass('truncate')
            $(e.currentTarget).addClass('absolute -top-1 text-xs rounded-lg border dark:border-gray-200 z-10 p-2')
        })

        $('.overflow-data').on('mouseleave', (e) => {
            $(e.currentTarget).addClass('truncate')
            $(e.currentTarget).removeClass('absolute -top-1 text-xs rounded-lg border dark:border-gray-200 z-10 p-2')

        })
    </script>

</body>

</html>