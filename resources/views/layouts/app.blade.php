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

<body class="relative dark:bg-gray-900">
    <div class="">
        @include('components.flash-message')
        @yield('content')
        @stack('modals')
        @stack('scripts')
    </div>
</body>

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

</html>