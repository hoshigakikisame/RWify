<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite('resources/css/app.css')
    @vite('resources/css/fonts.css')

    @vite('resources/js/app.js')
</head>

<body class="relataive">
    <main class="flex">
        <x-sidebar>
            <li class="opacity-40">Dashboard</li>
            <li>Pendataan</li>
            <li>Iuran Warga</li>
            <li>Pengaduan</li>
            <li>Dokumen</li>
            <li>Pengumuman</li>
            <li>UMKM</li>
        </x-sidebar>
        @yield('content')
        @stack('modals')
    </main>
    @stack('scripts')
</body>

</html>