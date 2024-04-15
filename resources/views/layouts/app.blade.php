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

</html>