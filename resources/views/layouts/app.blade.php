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

<body class="position-relative" style="font-family: Poppins-Regular; ">
    <div>
        @yield('content')
        @stack('modals')
        @stack('scripts')
    </div>
</body>

</html>