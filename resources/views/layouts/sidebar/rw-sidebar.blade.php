@extends('layouts.sidebar.sidebar')
@section('menu')
    @php
        $activeStyle = [
            'default' =>
                'sidebar-item flex w-full items-center justify-center gap-3 text-nowrap rounded-lg px-3 py-2 text-gray-800 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-800 lg:justify-normal',
            'active' =>
                'sidebar-item flex w-full items-center justify-center gap-3 text-nowrap rounded-lg rounded-lg bg-gray-100 fill-ColorWhiteSidebar px-3 py-2 text-ColorWhiteSidebar dark:bg-gray-800 dark:fill-ColorButton dark:text-ColorButton dark:hover:bg-gray-800 lg:justify-normal',
        ];

        $activeDropIuran = request()->routeIs([
            'rw.manage.iuran.leaderboard',
            'rw.manage.iuran.index',
            'rw.manage.iuran.verify',
        ]);

        $activeDropPendataan = request()->routeIs([
            'rw.manage.pendataan.kartuKeluarga.kartuKeluarga',
            'rw.manage.pendataan.warga.warga',
        ]);

        $activeDropProperti = request()->routeIs(['rw.manage.properti.index', 'rw.manage.tipeProperti.index']);

        $activeDropBansos = request()->routeIs(['rw.manage.bansos.mfep', 'rw.manage.bansos.saw']);
    @endphp

    <x-sidebar.sidebar-item href="{{ route('rw.dashboard') }}" title="Dashboard" :active="request()->routeIs(['rw.dashboard'])">
        <svg xmlns=" http://www.w3.org/2000/svg" viewBox="0 0 512 512" xml:space="preserve"
            class="w-5 fill-inherit transition-all">
            <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
            <path
                d="M362.667 383.841v128H448c35.346 0 64-28.654 64-64V253.26a42.67 42.67 0 0 0-12.011-29.696l-181.29-195.99c-31.988-34.61-85.976-36.735-120.586-4.747a85 85 0 0 0-4.747 4.747L12.395 223.5A42.67 42.67 0 0 0 0 253.58v194.261c0 35.346 28.654 64 64 64h85.333v-128c.399-58.172 47.366-105.676 104.073-107.044 58.604-1.414 108.814 46.899 109.261 107.044" />
            <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
        </svg>
    </x-sidebar.sidebar-item>
    <li class="relative" x-data="{ sideDropdown: false }">
        <button class="{{ $activeDropPendataan ? $activeStyle['active'] : $activeStyle['default'] }}"
            @click="sideDropdown = !sideDropdown" x-ref="dropdown"
            @mouseover="$($refs.dropdown).find('svg').addClass('!w-7')"
            @mouseleave="$($refs.dropdown).find('svg').removeClass('!w-7')"
            x-effect="
                document.location.pathname.split('/').includes('pendataan')
                    ? (sideDropdown = true)
                    : (sideDropdown = false)
            ">
            <svg xmlns=" http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24" class="w-6 fill-inherit">
                <path
                    d="M22.026 7h-7V0h-10a3 3 0 0 0-3 3v21H6v-2c0-1.654 1.346-3 3-3h6.026c1.654 0 3 1.346 3 3v2h4zm-10 10c-2.205 0-4-1.795-4-4s1.795-4 4-4 4 1.795 4 4-1.795 4-4 4M21.44 5h-4.414V.586zm-7.414 8c0 1.103-.897 2-2 2s-2-.897-2-2 .897-2 2-2 2 .897 2 2m2 9v2H8v-2c0-.551.449-1 1-1h6.026c.552 0 1 .449 1 1" />
            </svg>
            <span
                class="absolute left-16 hidden w-full rounded-lg bg-gray-200 px-2 py-1 transition-all ease-in dark:bg-gray-700 lg:static lg:block lg:bg-transparent lg:p-0 lg:dark:bg-transparent">
                <div class="title flex items-center justify-between gap-4">
                    Pendataan
                    <div class="w-6 fill-inherit lg:w-5" x-show="!sideDropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M18.71 8.21a1 1 0 0 0-1.42 0l-4.58 4.58a1 1 0 0 1-1.42 0L6.71 8.21a1 1 0 0 0-1.42 0 1 1 0 0 0 0 1.41l4.59 4.59a3 3 0 0 0 4.24 0l4.59-4.59a1 1 0 0 0 0-1.41" />
                        </svg>
                    </div>
                    <div class="w-6 fill-inherit lg:w-5" x-show="sideDropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M18 15.5a1 1 0 0 1-.71-.29l-4.58-4.59a1 1 0 0 0-1.42 0l-4.58 4.59a1 1 0 0 1-1.42-1.42l4.59-4.58a3.06 3.06 0 0 1 4.24 0l4.59 4.58a1 1 0 0 1 0 1.42 1 1 0 0 1-.71.29" />
                        </svg>
                    </div>
                </div>
            </span>
        </button>
        <ul x-show="sideDropdown" class="ms-3 mt-2 flex flex-col gap-2">
            <x-sidebar.sidebar-item href="{{ route('rw.manage.pendataan.kartuKeluarga.kartuKeluarga') }}"
                title="Kartu Keluarga" :active="request()->routeIs(['rw.manage.pendataan.kartuKeluarga.kartuKeluarga'])">

                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon w-5 fill-inherit" viewBox="0 0 512 512">
                    <path
                        d="M336 256c-20.56 0-40.44-9.18-56-25.84-15.13-16.25-24.37-37.92-26-61-1.74-24.62 5.77-47.26 21.14-63.76S312 80 336 80c23.83 0 45.38 9.06 60.7 25.52 15.47 16.62 23 39.22 21.26 63.63-1.67 23.11-10.9 44.77-26 61C376.44 246.82 356.57 256 336 256zm66-88zM467.83 432H204.18a27.71 27.71 0 01-22-10.67 30.22 30.22 0 01-5.26-25.79c8.42-33.81 29.28-61.85 60.32-81.08C264.79 297.4 299.86 288 336 288c36.85 0 71 9 98.71 26.05 31.11 19.13 52 47.33 60.38 81.55a30.27 30.27 0 01-5.32 25.78A27.68 27.68 0 01467.83 432zM147 260c-35.19 0-66.13-32.72-69-72.93-1.42-20.6 5-39.65 18-53.62 12.86-13.83 31-21.45 51-21.45s38 7.66 50.93 21.57c13.1 14.08 19.5 33.09 18 53.52-2.87 40.2-33.8 72.91-68.93 72.91zM212.66 291.45c-17.59-8.6-40.42-12.9-65.65-12.9-29.46 0-58.07 7.68-80.57 21.62-25.51 15.83-42.67 38.88-49.6 66.71a27.39 27.39 0 004.79 23.36A25.32 25.32 0 0041.72 400h111a8 8 0 007.87-6.57c.11-.63.25-1.26.41-1.88 8.48-34.06 28.35-62.84 57.71-83.82a8 8 0 00-.63-13.39c-1.57-.92-3.37-1.89-5.42-2.89z" />
                </svg>
            </x-sidebar.sidebar-item>
            <x-sidebar.sidebar-item href="{{ route('rw.manage.pendataan.warga.warga') }}" title="Warga" :active="request()->routeIs(['rw.manage.pendataan.warga.warga'])">
                <svg xmlns="http://www.w3.org/2000/svg" class="ionicon w-5 fill-inherit" viewBox="0 0 512 512">
                    <path
                        d="M332.64 64.58C313.18 43.57 286 32 256 32c-30.16 0-57.43 11.5-76.8 32.38-19.58 21.11-29.12 49.8-26.88 80.78C156.76 206.28 203.27 256 256 256s99.16-49.71 103.67-110.82c2.27-30.7-7.33-59.33-27.03-80.6zM432 480H80a31 31 0 01-24.2-11.13c-6.5-7.77-9.12-18.38-7.18-29.11C57.06 392.94 83.4 353.61 124.8 326c36.78-24.51 83.37-38 131.2-38s94.42 13.5 131.2 38c41.4 27.6 67.74 66.93 76.18 113.75 1.94 10.73-.68 21.34-7.18 29.11A31 31 0 01432 480z" />
                </svg>
            </x-sidebar.sidebar-item>
        </ul>
    </li>
    <li class="relative" x-data="{ sideDropdown: false }">
        <button class="{{ $activeDropIuran ? $activeStyle['active'] : $activeStyle['default'] }}"
            @click="sideDropdown = !sideDropdown" x-ref="dropdown"
            @mouseover="$($refs.dropdown).find('svg').addClass('!w-6')"
            @mouseleave="$($refs.dropdown).find('svg').removeClass('!w-6')"
            x-effect="
                document.location.pathname.split('/').includes('iuran')
                    ? (sideDropdown = true)
                    : (sideDropdown = false)
            ">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 fill-inherit">
                <path
                    d="M24 6.5a1.5 1.5 0 1 1-3.001-.001A1.5 1.5 0 0 1 24 6.5M15.5 3a1.5 1.5 0 1 0-.001-3.001A1.5 1.5 0 0 0 15.5 3m.945 4.832a1 1 0 0 0 1.387-.277l4-6a1.001 1.001 0 0 0-1.664-1.11l-4 6a1 1 0 0 0 .277 1.387M5.75 8c3.176 0 5.75-1.343 5.75-3S8.926 2 5.75 2 0 3.343 0 5s2.574 3 5.75 3m0 8c3.278 0 5.75-1.505 5.75-3.5v-2c0 1.971-2.396 3.5-5.75 3.5S0 12.471 0 10.5v2C0 14.495 2.472 16 5.75 16m0-4c3.278 0 5.75-1.505 5.75-3.5v-2c0 1.971-2.396 3.5-5.75 3.5S0 8.471 0 6.5v2C0 10.495 2.472 12 5.75 12m11.5-2c-3.176 0-5.75 1.343-5.75 3s2.574 3 5.75 3S23 14.657 23 13s-2.574-3-5.75-3m0 12c-3.354 0-5.75-1.529-5.75-3.5 0 1.971-2.396 3.5-5.75 3.5S0 20.471 0 18.5v2C0 22.495 2.472 24 5.75 24s5.75-1.505 5.75-3.5c0 1.995 2.472 3.5 5.75 3.5S23 22.495 23 20.5v-2c0 1.971-2.396 3.5-5.75 3.5m0-4c-3.354 0-5.75-1.529-5.75-3.5 0 1.971-2.396 3.5-5.75 3.5S0 16.471 0 14.5v2C0 18.495 2.472 20 5.75 20s5.75-1.505 5.75-3.5c0 1.995 2.472 3.5 5.75 3.5S23 18.495 23 16.5v-2c0 1.971-2.396 3.5-5.75 3.5" />
            </svg>
            <span
                class="absolute left-16 hidden w-full rounded-lg bg-gray-200 px-2 py-1 transition-all ease-in dark:bg-gray-700 lg:static lg:block lg:bg-transparent lg:p-0 lg:dark:bg-transparent">
                <div class="title flex items-center justify-between gap-4">
                    Iuran Warga
                    <div class="w-6 fill-inherit lg:w-5" x-show="!sideDropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M18.71 8.21a1 1 0 0 0-1.42 0l-4.58 4.58a1 1 0 0 1-1.42 0L6.71 8.21a1 1 0 0 0-1.42 0 1 1 0 0 0 0 1.41l4.59 4.59a3 3 0 0 0 4.24 0l4.59-4.59a1 1 0 0 0 0-1.41" />
                        </svg>
                    </div>
                    <div class="w-6 fill-inherit lg:w-5" x-show="sideDropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M18 15.5a1 1 0 0 1-.71-.29l-4.58-4.59a1 1 0 0 0-1.42 0l-4.58 4.59a1 1 0 0 1-1.42-1.42l4.59-4.58a3.06 3.06 0 0 1 4.24 0l4.59 4.58a1 1 0 0 1 0 1.42 1 1 0 0 1-.71.29" />
                        </svg>
                    </div>
                </div>
            </span>
        </button>
        <ul x-show="sideDropdown" class="ms-3 mt-2 flex flex-col gap-2">
            <x-sidebar.sidebar-item href="{{ route('rw.manage.iuran.index') }}" title="Iuran" :active="request()->routeIs(['rw.manage.iuran.index'])">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 512 512" style="enable-background: new 0 0 512 512" xml:space="preserve"
                    class="w-6 fill-inherit lg:w-5">
                    <g>
                        <path d="M411 8.783V100h91.211z" opacity="1" data-original="#000000" class=""></path>
                        <path
                            d="M396 130c-8.284 0-15-6.716-15-15V0H166c-24.813 0-45 20.187-45 45v167.689c4.942-.448 9.943-.689 15-.689 51.128 0 96.897 23.376 127.186 60H426c8.284 0 15 6.716 15 15s-6.716 15-15 15H282.948a163.749 163.749 0 0 1 17.363 60H426c8.284 0 15 6.716 15 15s-6.716 15-15 15H300.311c-4.486 49.539-30.954 92.826-69.553 120H466c24.813 0 45-20.187 45-45V130zm30 82H206c-8.284 0-15-6.716-15-15s6.716-15 15-15h220c8.284 0 15 6.716 15 15s-6.716 15-15 15z"
                            opacity="1" data-original="#000000" class=""></path>
                        <path
                            d="M136 242C61.561 242 1 302.561 1 377s60.561 135 135 135 135-60.561 135-135-60.561-135-135-135zm-8.333 120h16.667c17.46 0 31.666 14.206 31.666 31.667v16.666c0 15.174-10.73 27.884-25 30.955V447c0 8.284-6.716 15-15 15s-15-6.716-15-15v-5.712c-14.27-3.071-25-15.781-25-30.955 0-8.284 6.716-15 15-15s15 6.716 15 15a1.67 1.67 0 0 0 1.667 1.667h16.667a1.67 1.67 0 0 0 1.667-1.667v-16.666a1.67 1.67 0 0 0-1.667-1.667h-16.667C110.206 392 96 377.794 96 360.333v-16.666c0-15.174 10.73-27.884 25-30.955V307c0-8.284 6.716-15 15-15s15 6.716 15 15v5.712c14.27 3.071 25 15.781 25 30.955 0 8.284-6.716 15-15 15s-15-6.716-15-15a1.67 1.67 0 0 0-1.667-1.667h-16.667a1.67 1.67 0 0 0-1.667 1.667v16.666a1.67 1.67 0 0 0 1.668 1.667z"
                            opacity="1" data-original="#000000" class=""></path>
                    </g>
                </svg>
            </x-sidebar.sidebar-item>
            <x-sidebar.sidebar-item href="{{ route('rw.manage.iuran.verify') }}" title="Kelola" :active="request()->routeIs(['rw.manage.iuran.verify'])">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" x="0"
                    y="0" viewBox="0 0 32 32" style="enable-background: new 0 0 512 512" xml:space="preserve"
                    class="w-5 fill-inherit">
                    <g>
                        <path
                            d="M2 8.7h28v4.08H2zM30 7.2c0-1.94-1.57-3.5-3.5-3.5h-21C3.57 3.7 2 5.26 2 7.2zM2 14.28v6.38c0 1.94 1.57 3.5 3.5 3.5h13.35a6.309 6.309 0 0 1 1.816-5.193c1.198-1.198 2.792-1.858 4.487-1.858s3.289.66 4.487 1.859c.127.127.244.261.358.397V14.28zm4.308 1.287h2.757a.9.9 0 0 1 0 1.8H6.308a.9.9 0 0 1 0-1.8zm5.514 5.188H6.308a.9.9 0 0 1 0-1.8h5.514a.9.9 0 0 1 0 1.8z"
                            opacity="1" data-original="#000000" class=""></path>
                        <path
                            d="M28.58 20.03a4.847 4.847 0 0 0-6.85 0 4.829 4.829 0 0 0 0 6.85c1.89 1.89 4.96 1.89 6.85 0s1.89-4.96 0-6.85zm-1.315 3.38-2.22 1.789a.9.9 0 0 1-1.272-.145l-.873-1.113a.901.901 0 0 1 1.416-1.112l.311.396 1.51-1.217a.902.902 0 0 1 1.266.136.903.903 0 0 1-.138 1.266z"
                            opacity="1" data-original="#000000" class=""></path>
                    </g>
                </svg>
            </x-sidebar.sidebar-item>
            <x-sidebar.sidebar-item href="{{ route('informasi.iuranLeaderboard') }}" title="Leaderboard" :active="request()->routeIs(['informasi.iuranLeaderboard'])">
                <svg viewBox="0 0 24 24" class="w-5 fill-inherit" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" class="fill-inherit"
                        d="M13.436 5.783a3 3 0 0 0-2.872 0L5.769 8.397a3 3 0 0 0-1.563 2.634v4.938a3 3 0 0 0 1.563 2.634l4.795 2.614a3 3 0 0 0 2.872 0l4.794-2.614a3 3 0 0 0 1.564-2.634V11.03a3 3 0 0 0-1.564-2.634zM12 10.5c-.284 0-.474.34-.854 1.023l-.098.176c-.108.194-.162.29-.246.354-.085.064-.19.088-.4.135l-.19.044c-.738.167-1.107.25-1.195.532s.164.577.667 1.165l.13.152c.143.167.215.25.247.354s.021.215 0 .438l-.02.203c-.076.785-.114 1.178.115 1.352.23.174.576.015 1.267-.303l.178-.082c.197-.09.295-.135.399-.135s.202.045.399.135l.178.082c.691.319 1.037.477 1.267.303s.191-.567.115-1.352l-.02-.203c-.021-.223-.032-.334 0-.438s.104-.187.247-.354l.13-.152c.503-.588.755-.882.667-1.165-.088-.282-.457-.365-1.195-.532l-.19-.044c-.21-.047-.315-.07-.4-.135-.084-.064-.138-.16-.246-.354l-.098-.176c-.38-.682-.57-1.023-.854-1.023"
                        clip-rule="evenodd" />
                    <path class="fill-inherit"
                        d="M11 2h2c1.886 0 2.828 0 3.414.586S17 4.114 17 6v.018l-2.846-1.552a4.5 4.5 0 0 0-4.308 0L7 6.018V6c0-1.886 0-2.828.586-3.414S9.114 2 11 2" />
                </svg>
            </x-sidebar.sidebar-item>
        </ul>
    </li>

    <x-sidebar.sidebar-item href="{{ route('rw.manage.pengaduan.pengaduan') }}" title="Pengaduan" :active="request()->routeIs(['rw.manage.pengaduan.pengaduan'])">
        <svg xmlns=" http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24" class="w-6 lg:w-5">
            <path
                d="M18 12c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6m1 9c0 .55-.45 1-1 1s-1-.45-1-1v-2c0-.55.45-1 1-1s1 .45 1 1zm-1-4c-.83 0-1.5-.67-1.5-1.5S17.17 14 18 14s1.5.67 1.5 1.5S18.83 17 18 17m-6.92 5H5c-2.76 0-5-2.24-5-5V5c0-2.76 2.24-5 5-5h5v5c0 1.65 1.35 3 3 3h5v2c-4.41 0-8 3.59-8 8 0 1.46.4 2.82 1.08 4M12 5V.15c.46.15.88.39 1.23.73l3.9 3.94c.33.33.56.73.7 1.17H13c-.55 0-1-.45-1-1Z" />
        </svg>
    </x-sidebar.sidebar-item>
    <x-sidebar.sidebar-item href="{{ route('rw.manage.pengumuman.pengumuman') }}" title="Pengumuman" :active="request()->routeIs(['rw.manage.pengumuman.pengumuman'])">
        <svg xmlns=" http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24" class="w-6 lg:w-5">
            <path
                d="M22 11.95V18a1 1 0 0 1-1.985.165C19.626 15.832 16.395 15 13.501 15h-4.5V4h4.5c2.894 0 6.125-.831 6.514-3.165A1 1 0 0 1 22.001 1v6.05a2.5 2.5 0 0 1 0 4.9ZM7 15V4H5.5C2.467 4 0 6.467 0 9.5S2.467 15 5.5 15zm1.523 2H5.5a7.5 7.5 0 0 1-2.505-.431l2.171 5.792a2.48 2.48 0 0 0 1.289 1.405 2.48 2.48 0 0 0 1.905.082 2.48 2.48 0 0 0 1.405-1.289c.281-.604.31-1.28.082-1.904l-1.325-3.656Z" />
        </svg>
    </x-sidebar.sidebar-item>
    <x-sidebar.sidebar-item href="{{ route('rw.manage.umkm.umkm') }}" title="UMKM" :active="request()->routeIs(['rw.manage.umkm.umkm'])">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 lg:w-5">
            <path
                d="M16 13a5 5 0 0 1-8 0 4.956 4.956 0 0 1-7 .977V19a5.006 5.006 0 0 0 5 5h12a5.006 5.006 0 0 0 5-5v-5.026A4.956 4.956 0 0 1 16 13" />
            <path
                d="M21.7 3.131A3.975 3.975 0 0 0 17.792 0H17v3a1 1 0 0 1-2 0V0H9v3a1 1 0 0 1-2 0V0h-.792A3.975 3.975 0 0 0 2.3 3.132L1.022 8.9 1 10.02A3 3 0 0 0 7 10a1 1 0 0 1 2 0 3 3 0 1 0 6 0 1 1 0 0 1 2 0 3 3 0 1 0 6 0v-.893Z" />
        </svg>
    </x-sidebar.sidebar-item>
    <x-sidebar.sidebar-item href="{{ route('rw.manage.reservasiJadwalTemu.index') }}" title="Jadwal Temu"
        :active="request()->routeIs(['rw.manage.reservasiJadwalTemu.index'])">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 lg:w-5">
            <path
                d="M24,5v3H0v-3c0-1.654,1.346-3,3-3h3V0h2V2h8V0h2V2h3c1.654,0,3,1.346,3,3Zm0,12c0,3.86-3.141,7-7,7s-7-3.14-7-7,3.141-7,7-7,7,3.14,7,7Zm-4.293,1.293l-1.707-1.707v-2.586h-2v3.414l2.293,2.293,1.414-1.414Zm-11.707-1.293c0-2.829,1.308-5.35,3.349-7H0v14H11.349c-2.041-1.65-3.349-4.171-3.349-7Z" />
        </svg>
    </x-sidebar.sidebar-item>
    <li class="relative" x-data="{ sideDropdown: false }">
        <button class="{{ $activeDropProperti ? $activeStyle['active'] : $activeStyle['default'] }}"
            @click="sideDropdown = !sideDropdown" x-ref="dropdown"
            @mouseover="$($refs.dropdown).find('svg').addClass('!w-7')"
            @mouseleave="$($refs.dropdown).find('svg').removeClass('!w-7')"
            x-effect="
                let path = document.location.pathname.split('/')
                path.includes('properti') || path.includes('tipeProperti')
                    ? (sideDropdown = true)
                    : (sideDropdown = false)
            ">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 32 32" xml:space="preserve" class="w-6 fill-inherit">
                <g>
                    <path
                        d="M2.001 6.609c0-1.013.43-1.985 1.179-2.667a3.575 3.575 0 0 1 2.779-.919c1.82.174 3.245 1.836 3.245 3.782v14.397a5.572 5.572 0 0 0-3.623-1.333c-.42 0-.844.047-1.268.144A5.403 5.403 0 0 0 2 21.179V6.609z"
                        opacity="1" data-original="#000000"></path>
                    <path
                        d="M28.704 7.344H11.129v15.883c0 .568-.387 1.056-.942 1.188a1.204 1.204 0 0 1-1.36-.631c-.759-1.518-2.396-2.278-4.085-1.894a3.567 3.567 0 0 0-2.741 3.43v.071L2 25.43c.006.804.273 1.564.785 2.206a3.587 3.587 0 0 0 2.818 1.358l23.102.001c.715 0 1.296-.58 1.296-1.295V8.64a1.298 1.298 0 0 0-1.297-1.296zM14.595 10.09h4.759a.962.962 0 0 1 0 1.924h-4.759a.962.962 0 0 1 0-1.924zm-.963 4.289c0-.531.431-.962.962-.962h1.941a.962.962 0 0 1 0 1.924h-1.941a.962.962 0 0 1-.962-.962zm12.025 9.4c0 .832-.675 1.507-1.507 1.507h-7.177a1.507 1.507 0 0 1-1.507-1.507v-4.383c0-.498.246-.964.658-1.245l3.588-2.446a1.506 1.506 0 0 1 1.697 0l3.588 2.446c.412.281.658.747.658 1.245v4.383z"
                        opacity="1" data-original="#000000" class=""></path>
                </g>
            </svg>
            <span
                class="absolute left-16 hidden w-full rounded-lg bg-gray-200 px-2 py-1 transition-all ease-in dark:bg-gray-700 lg:static lg:block lg:bg-transparent lg:p-0 lg:dark:bg-transparent">
                <div class="title flex items-center justify-between gap-4">
                    Properti
                    <div class="w-6 fill-inherit lg:w-5" x-show="!sideDropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M18.71 8.21a1 1 0 0 0-1.42 0l-4.58 4.58a1 1 0 0 1-1.42 0L6.71 8.21a1 1 0 0 0-1.42 0 1 1 0 0 0 0 1.41l4.59 4.59a3 3 0 0 0 4.24 0l4.59-4.59a1 1 0 0 0 0-1.41" />
                        </svg>
                    </div>
                    <div class="w-6 fill-inherit lg:w-5" x-show="sideDropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M18 15.5a1 1 0 0 1-.71-.29l-4.58-4.59a1 1 0 0 0-1.42 0l-4.58 4.59a1 1 0 0 1-1.42-1.42l4.59-4.58a3.06 3.06 0 0 1 4.24 0l4.59 4.58a1 1 0 0 1 0 1.42 1 1 0 0 1-.71.29" />
                        </svg>
                    </div>
                </div>
            </span>
        </button>
        <ul x-show="sideDropdown" class="ms-3 mt-2 flex flex-col gap-2">
            <x-sidebar.sidebar-item href="{{ route('rw.manage.tipeProperti.index') }}" title="Tipe Properti"
                :active="request()->routeIs(['rw.manage.tipeProperti.index'])">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 fill-inherit lg:w-5"
                    xml:space="preserve">
                    <path
                        d="M470.735 158.055 305.743 6.62C300.323 2.285 293.849 0 287.023 0s-13.314 2.285-18.733 6.62L103.315 157.603c-12.93 10.326-15.074 29.186-4.688 42.154 10.293 12.89 29.176 15.085 42.154 4.688L287.023 69.461l146.274 135.451c12.073 9.722 32.31 7.625 42.125-4.717 10.371-12.914 8.256-31.803-4.687-42.14M437.01.044h-59.995c-8.29 0-14.999 6.708-14.999 14.999v2.366l89.992 83.002V15.043C452.009 6.752 445.301.044 437.01.044M47.044 241.023H15.047c-8.29 0-14.999 6.708-14.999 14.999v240.979c0 8.29 6.708 14.999 14.999 14.999h31.997c24.812 0 44.996-20.184 44.996-44.996V286.019c0-24.812-20.183-44.996-44.996-44.996m452.662 35.697c-12.3-8.999-29.398-7.199-39.597 3.9l-80.993 100.791c-5.7 5.999-16.499 9.599-22.198 9.599h-129.89c-8.4 0-14.999-6.598-14.999-14.999s6.598-14.999 14.999-14.999h119.99c16.499 0 29.997-13.499 29.997-29.997 0-16.499-13.499-29.997-29.997-29.997h-78.593c-7.475 0-11.203-4.741-17.099-9.9-8.999-8.098-19.198-14.098-29.697-18.298-32.506-13.274-70.067-9.257-99.591 11.275v197.907h224.981c28.198 0 55.196-13.499 71.995-35.997l86.992-126.989c9.898-13.199 7.198-32.397-6.3-42.296"
                        data-original="#000000" />
                    <path
                        d="M286.994 110.312 152.035 234.89v4.07c9.901-2.281 19.993-3.825 30.319-3.825 17.475 0 34.494 3.34 50.606 9.916 3.177 1.271 6.026 3.069 9.066 4.565v-23.591c0-8.29 6.708-14.999 14.999-14.999h59.995c8.29 0 14.999 6.708 14.999 14.999v44.996h15c24.065 0 44.864 14.237 54.414 34.728l20.579-25.609v-44.893z"
                        data-original="#000000" />
                    <path d="M272.024 241.023v28.368l1.802 1.63h28.196v-29.998z" data-original="#000000" />
                </svg>
            </x-sidebar.sidebar-item>
            <x-sidebar.sidebar-item href="{{ route('rw.manage.properti.index') }}" title="Properti Warga"
                :active="request()->routeIs(['rw.manage.properti.index'])">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 fill-inherit lg:w-5"
                    xml:space="preserve">
                    <path
                        d="M157.216 90h150c8.284 0 15-6.716 15-15V15c0-8.284-6.716-15-15-15h-150c-8.284 0-15 6.716-15 15v60c0 8.284 6.716 15 15 15m30 119.27V280h30v-15c0-8.284 6.716-15 15-15s15 6.716 15 15v15h30v-70.73l-45-22.5z"
                        data-original="#000000" />
                    <path
                        d="M379.933 437h-49.499c-8.283 0-15-6.716-15-15v-49.498c0-3.978 1.58-7.794 4.395-10.607l107.388-107.387V60c0-8.284-6.716-15-15-15h-60v30c0 24.813-20.187 45-45 45h-150c-24.813 0-45-20.187-45-45V45h-60c-8.284 0-15 6.716-15 15v437c0 8.284 6.716 15 15 15h360c8.284 0 15-6.716 15-15V395.929l-36.677 36.677A15 15 0 0 1 379.933 437m-107.717 0h-80c-8.284 0-15-6.716-15-15s6.716-15 15-15h80c8.284 0 15 6.716 15 15s-6.716 15-15 15m0-60h-80c-8.284 0-15-6.716-15-15s6.716-15 15-15h80c8.284 0 15 6.716 15 15s-6.716 15-15 15m35-152.861V295c0 8.284-6.716 15-15 15h-120c-8.284 0-15-6.716-15-15v-70.87c-7.037 2.499-14.992-.573-18.416-7.422-3.705-7.41-.702-16.42 6.708-20.125l80-40a15 15 0 0 1 13.416 0l80 40c7.41 3.705 10.413 12.715 6.708 20.125-3.396 6.794-11.312 9.953-18.416 7.431"
                        data-original="#000000" />
                    <path d="M345.434 407h28.285l101.065-101.066-28.283-28.284-101.067 101.066z" data-original="#000000" />
                </svg>
            </x-sidebar.sidebar-item>
        </ul>
    </li>
    <li class="relative" x-data="{ sideDropdown: false }">
        <button class="{{ $activeDropBansos ? $activeStyle['active'] : $activeStyle['default'] }}"
            @click="sideDropdown = !sideDropdown" x-ref="dropdown"
            @mouseover="$($refs.dropdown).find('svg').addClass('!w-7')"
            @mouseleave="$($refs.dropdown).find('svg').removeClass('!w-7')"
            x-effect="
                document.location.pathname.split('/').includes('bansos')
                    ? (sideDropdown = true)
                    : (sideDropdown = false)
            ">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 512 512" class="w-6 fill-inherit">
                <g>
                    <path
                        d="M56.671 303.656c-2.833-7.785-11.441-11.798-19.226-8.965l-26.575 9.673A15 15 0 0 0 1 318.459V497c0 8.284 6.716 15 15 15h64.984c1.75 0 3.486-.306 5.13-.905l26.576-9.673c7.785-2.833 11.798-11.441 8.965-19.226zM508.702 352.228c-7.625-20.948-31.561-30.864-51.766-21.444l-70.768 32.993a67.643 67.643 0 0 1-1.007 10.074c-6.463 36.653-41.54 61.215-78.193 54.752l-101.005-17.81c-8.158-1.438-13.606-9.219-12.167-17.377s9.218-13.606 17.377-12.167l101.005 17.81c20.395 3.596 39.844-10.022 43.44-30.417 3.596-20.395-10.022-39.844-30.417-43.439l-48.213-8.501c-14.428-2.544-27.881-8.016-39.987-16.264-35.187-23.972-80.082-29.591-120.093-15.028l-30.864 11.234 65.565 180.136 127.073 17.463c15.553 2.138 31.123-.585 45.027-7.872l166.926-87.485c16.854-8.835 24.576-28.775 18.067-46.658zM245.178 80h101.645l22.4-59.733C372.9 10.46 365.65 0 355.177 0H236.823C226.35 0 219.1 10.46 222.778 20.267z">
                    </path>
                    <path
                        d="M248.794 272.309c-5.146-6.144-4.574-15.301 1.417-20.73 6.139-5.563 15.625-5.097 21.188 1.042 6.457 7.125 16.632 11.378 27.218 11.378 9.975 0 16.978-5.835 17.985-11.477 1.33-7.45-10.092-12.28-13.625-13.583-17.099-6.307-32.284-13.066-32.921-13.351a14.959 14.959 0 0 1-2.081-1.133c-12.011-7.83-18.199-21.561-16.15-35.834 2.179-15.18 13.259-27.54 28.915-32.256 30.002-9.04 54.783 10.638 56.871 12.359l.022.019.099.082-.004.005c3.27 2.751 5.352 6.87 5.352 11.478 0 8.284-6.716 15-15 15a14.934 14.934 0 0 1-9.648-3.522l-.004.005.094.078c-.139-.113-14.148-11.289-29.13-6.778-6.371 1.919-7.628 6.09-7.873 7.794-.166 1.156-.252 3.898 2.12 5.907 4.028 1.761 16.422 7.098 29.718 12.002 28.478 10.504 35.603 31.167 32.775 47.002-3.026 16.95-16.656 30.14-34.326 34.582l18.601 3.28c17.755 3.13 33.229 12.988 43.57 27.757a68.432 68.432 0 0 1 5.904 10.192l63.617-29.659v-39.645c0-35.014-9.73-69.264-28.138-99.048A188.255 188.255 0 0 0 363.165 110H228.833a188.255 188.255 0 0 0-52.195 55.255 188.252 188.252 0 0 0-27.429 82.707c4.308-.343 8.639-.523 12.989-.523 30.86 0 60.669 8.58 86.596 24.87z">
                    </path>
                </g>
            </svg>
            <span
                class="absolute left-16 hidden w-full rounded-lg bg-gray-200 px-2 py-1 transition-all ease-in dark:bg-gray-700 lg:static lg:block lg:bg-transparent lg:p-0 lg:dark:bg-transparent">
                <div class="title flex items-center justify-between gap-4">
                    Bansos
                    <div class="w-6 fill-inherit lg:w-5" x-show="!sideDropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M18.71 8.21a1 1 0 0 0-1.42 0l-4.58 4.58a1 1 0 0 1-1.42 0L6.71 8.21a1 1 0 0 0-1.42 0 1 1 0 0 0 0 1.41l4.59 4.59a3 3 0 0 0 4.24 0l4.59-4.59a1 1 0 0 0 0-1.41" />
                        </svg>
                    </div>
                    <div class="w-6 fill-inherit lg:w-5" x-show="sideDropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M18 15.5a1 1 0 0 1-.71-.29l-4.58-4.59a1 1 0 0 0-1.42 0l-4.58 4.59a1 1 0 0 1-1.42-1.42l4.59-4.58a3.06 3.06 0 0 1 4.24 0l4.59 4.58a1 1 0 0 1 0 1.42 1 1 0 0 1-.71.29" />
                        </svg>
                    </div>
                </div>
            </span>
        </button>
        <ul x-show="sideDropdown" class="ms-3 mt-2 flex flex-col gap-2">
            <x-sidebar.sidebar-item href="{{ route('rw.manage.bansos.mfep') }}" title="MFEP" :active="request()->routeIs(['rw.manage.bansos.mfep'])">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 512 512" style="enable-background: new 0 0 512 512" xml:space="preserve"
                    class="w-6 fill-inherit lg:w-5">
                    <g>
                        <path d="M411 8.783V100h91.211z" opacity="1" data-original="#000000" class=""></path>
                        <path
                            d="M396 130c-8.284 0-15-6.716-15-15V0H166c-24.813 0-45 20.187-45 45v167.689c4.942-.448 9.943-.689 15-.689 51.128 0 96.897 23.376 127.186 60H426c8.284 0 15 6.716 15 15s-6.716 15-15 15H282.948a163.749 163.749 0 0 1 17.363 60H426c8.284 0 15 6.716 15 15s-6.716 15-15 15H300.311c-4.486 49.539-30.954 92.826-69.553 120H466c24.813 0 45-20.187 45-45V130zm30 82H206c-8.284 0-15-6.716-15-15s6.716-15 15-15h220c8.284 0 15 6.716 15 15s-6.716 15-15 15z"
                            opacity="1" data-original="#000000" class=""></path>
                        <path
                            d="M136 242C61.561 242 1 302.561 1 377s60.561 135 135 135 135-60.561 135-135-60.561-135-135-135zm-8.333 120h16.667c17.46 0 31.666 14.206 31.666 31.667v16.666c0 15.174-10.73 27.884-25 30.955V447c0 8.284-6.716 15-15 15s-15-6.716-15-15v-5.712c-14.27-3.071-25-15.781-25-30.955 0-8.284 6.716-15 15-15s15 6.716 15 15a1.67 1.67 0 0 0 1.667 1.667h16.667a1.67 1.67 0 0 0 1.667-1.667v-16.666a1.67 1.67 0 0 0-1.667-1.667h-16.667C110.206 392 96 377.794 96 360.333v-16.666c0-15.174 10.73-27.884 25-30.955V307c0-8.284 6.716-15 15-15s15 6.716 15 15v5.712c14.27 3.071 25 15.781 25 30.955 0 8.284-6.716 15-15 15s-15-6.716-15-15a1.67 1.67 0 0 0-1.667-1.667h-16.667a1.67 1.67 0 0 0-1.667 1.667v16.666a1.67 1.67 0 0 0 1.668 1.667z"
                            opacity="1" data-original="#000000" class=""></path>
                    </g>
                </svg>
            </x-sidebar.sidebar-item>
            <x-sidebar.sidebar-item href="{{ route('rw.manage.bansos.saw') }}" title="SAW" :active="request()->routeIs(['rw.manage.bansos.saw'])">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 512 512" style="enable-background: new 0 0 512 512" xml:space="preserve"
                    class="w-6 fill-inherit lg:w-5">
                    <g>
                        <path d="M411 8.783V100h91.211z" opacity="1" data-original="#000000" class=""></path>
                        <path
                            d="M396 130c-8.284 0-15-6.716-15-15V0H166c-24.813 0-45 20.187-45 45v167.689c4.942-.448 9.943-.689 15-.689 51.128 0 96.897 23.376 127.186 60H426c8.284 0 15 6.716 15 15s-6.716 15-15 15H282.948a163.749 163.749 0 0 1 17.363 60H426c8.284 0 15 6.716 15 15s-6.716 15-15 15H300.311c-4.486 49.539-30.954 92.826-69.553 120H466c24.813 0 45-20.187 45-45V130zm30 82H206c-8.284 0-15-6.716-15-15s6.716-15 15-15h220c8.284 0 15 6.716 15 15s-6.716 15-15 15z"
                            opacity="1" data-original="#000000" class=""></path>
                        <path
                            d="M136 242C61.561 242 1 302.561 1 377s60.561 135 135 135 135-60.561 135-135-60.561-135-135-135zm-8.333 120h16.667c17.46 0 31.666 14.206 31.666 31.667v16.666c0 15.174-10.73 27.884-25 30.955V447c0 8.284-6.716 15-15 15s-15-6.716-15-15v-5.712c-14.27-3.071-25-15.781-25-30.955 0-8.284 6.716-15 15-15s15 6.716 15 15a1.67 1.67 0 0 0 1.667 1.667h16.667a1.67 1.67 0 0 0 1.667-1.667v-16.666a1.67 1.67 0 0 0-1.667-1.667h-16.667C110.206 392 96 377.794 96 360.333v-16.666c0-15.174 10.73-27.884 25-30.955V307c0-8.284 6.716-15 15-15s15 6.716 15 15v5.712c14.27 3.071 25 15.781 25 30.955 0 8.284-6.716 15-15 15s-15-6.716-15-15a1.67 1.67 0 0 0-1.667-1.667h-16.667a1.67 1.67 0 0 0-1.667 1.667v16.666a1.67 1.67 0 0 0 1.668 1.667z"
                            opacity="1" data-original="#000000" class=""></path>
                    </g>
                </svg>
            </x-sidebar.sidebar-item>
        </ul>
    </li>
@endsection
