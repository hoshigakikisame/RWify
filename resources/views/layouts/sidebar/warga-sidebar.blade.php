@extends('layouts.sidebar.sidebar')
@section('menu')
<x-sidebar.sidebaritem href="{{ route('warga.dashboard') }}" title="Dashboard" :active="request()->routeIs(['warga.dashboard'])">
    <svg xmlns=" http://www.w3.org/2000/svg" viewBox="0 0 512 512" xml:space="preserve" class="lg:w-5 w-6 fill-inherit">
        <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
        <path d="M362.667 383.841v128H448c35.346 0 64-28.654 64-64V253.26a42.67 42.67 0 0 0-12.011-29.696l-181.29-195.99c-31.988-34.61-85.976-36.735-120.586-4.747a85 85 0 0 0-4.747 4.747L12.395 223.5A42.67 42.67 0 0 0 0 253.58v194.261c0 35.346 28.654 64 64 64h85.333v-128c.399-58.172 47.366-105.676 104.073-107.044 58.604-1.414 108.814 46.899 109.261 107.044" />
        <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
    </svg>
</x-sidebar.sidebaritem>
@php
$activeStyle = ['default' =>'w-full text-gray-800 dark:text-gray-200 flex items-center justify-center lg:justify-normal gap-3 py-2 px-3 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg sidebar-item text-nowrap','active'=> 'w-full text-blue-600 fill-blue-600 rounded-lg flex bg-gray-100 items-center justify-center dark:bg-gray-800 dark:text-blue-300 dark:fill-blue-400 lg:justify-normal gap-3 py-2 px-3 dark:hover:bg-gray-800 rounded-lg sidebar-item text-nowrap'];

$activeDropPengaduan = request()->routeIs(['warga.layanan.pengaduan.index', 'warga.layanan.pengaduan.newPengaduanPage']);
$activeDropReservasi = request()->routeIs(['warga.layanan.reservasiJadwalTemu.index', 'warga.layanan.reservasiJadwalTemu.newReservasiJadwalTemuPage']);

@endphp
<div class="relative" x-data="{sideDropdown: false}">
    <button class="{{$activeDropPengaduan ? $activeStyle['active']:$activeStyle['default'];}}" @click="sideDropdown = !sideDropdown" x-effect="document.location.pathname.split('/').includes('pengaduan') ? sideDropdown = true : sideDropdown = false">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 fill-inherit">
            <path d="M21.976 10.015H15c-1.654 0-3-1.346-3-3V.038c-.161-.011-.322-.024-.485-.024H7a5.007 5.007 0 0 0-5 5.001v14c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V10.5c0-.163-.013-.324-.024-.485M11 12a1 1 0 0 1 2 0v3.5a1 1 0 0 1-2 0zm1 9a1.5 1.5 0 1 1 .001-3.001A1.5 1.5 0 0 1 12 21m2-13.985V.474a7 7 0 0 1 2.465 1.59l3.484 3.486a6.95 6.95 0 0 1 1.591 2.464H15c-.552 0-1-.449-1-1Z" />
        </svg>
        <span class="hidden lg:block absolute left-16 lg:static rounded-lg bg-gray-200 lg:bg-transparent lg:dark:bg-transparent dark:bg-gray-700 px-2 py-1 lg:p-0 transition-all ease-in w-full">
            <div class="title flex gap-4 justify-between items-center">
                Pengaduan
                <div class="lg:w-5 w-6 fill-inherit" x-show="!sideDropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M18.71 8.21a1 1 0 0 0-1.42 0l-4.58 4.58a1 1 0 0 1-1.42 0L6.71 8.21a1 1 0 0 0-1.42 0 1 1 0 0 0 0 1.41l4.59 4.59a3 3 0 0 0 4.24 0l4.59-4.59a1 1 0 0 0 0-1.41" />
                    </svg>
                </div>
                <div class="lg:w-5 w-6 fill-inherit" x-show="sideDropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M18 15.5a1 1 0 0 1-.71-.29l-4.58-4.59a1 1 0 0 0-1.42 0l-4.58 4.59a1 1 0 0 1-1.42-1.42l4.59-4.58a3.06 3.06 0 0 1 4.24 0l4.59 4.58a1 1 0 0 1 0 1.42 1 1 0 0 1-.71.29" />
                    </svg>
                </div>
            </div>
        </span>
    </button>
    <ul x-show="sideDropdown" class="ms-3 mt-2 flex flex-col gap-2">
        <x-sidebar.sidebaritem href="{{ route('warga.layanan.pengaduan.index') }}" title="Pengaduan" :active="request()->routeIs(['warga.layanan.pengaduan.index'])">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="lg:w-5 w-6 fill-inherit">
                <path d="m23.34 9.48-3.5-6A5.02 5.02 0 0 0 15.521 1H8.449c-1.771 0-3.426.95-4.319 2.48l-3.499 6a5 5 0 0 0 0 5.039l3.5 6a5.02 5.02 0 0 0 4.319 2.48h7.072c1.771 0 3.426-.95 4.319-2.48l3.5-6a5 5 0 0 0 0-5.039ZM11 7a1 1 0 1 1 2 0v5.5a1 1 0 1 1-2 0zm1 11a1.5 1.5 0 1 1 .001-3.001A1.5 1.5 0 0 1 12 18" />
            </svg>
        </x-sidebar.sidebaritem>
        <x-sidebar.sidebaritem href="{{ route('warga.layanan.pengaduan.newPengaduanPage') }}" title="Buat Pengaduan" :active="request()->routeIs(['warga.layanan.pengaduan.newPengaduanPage'])">
            <svg viewBox="0 0 24 24" class="lg:w-5 w-6 fill-inherit" xmlns="http://www.w3.org/2000/svg">
                <path d="M14 7V.46a7 7 0 0 1 2.465 1.59l3.484 3.486A6.95 6.95 0 0 1 21.54 8H15a1 1 0 0 1-1-1m8 3.485V19a5.006 5.006 0 0 1-5 5H7a5.006 5.006 0 0 1-5-5V5a5.006 5.006 0 0 1 5-5h4.515c.163 0 .324.013.485.024V7a3 3 0 0 0 3 3h6.976c.011.161.024.322.024.485M16 17a1 1 0 0 0-1-1h-2v-2a1 1 0 0 0-2 0v2H9a1 1 0 0 0 0 2h2v2a1 1 0 0 0 2 0v-2h2a1 1 0 0 0 1-1" />
            </svg>
        </x-sidebar.sidebaritem>
    </ul>
</div>

<div class="relative" x-data="{sideDropdown: false}">
    <button class="{{$activeDropReservasi ? $activeStyle['active']:$activeStyle['default'];}}" @click="sideDropdown = !sideDropdown" x-effect="document.location.pathname.split('/').includes('reservasi-jadwal-temu') ? sideDropdown = true : sideDropdown = false">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 fill-inherit">
            <path d="M21 7H0c0-2.757 2.243-5 5-5V1a1 1 0 0 1 2 0v1h7V1a1 1 0 1 1 2 0v1c2.757 0 5 2.243 5 5m-.162 11.82-5.829-2.292v-5.462c0-.996-.681-1.92-1.664-2.08a2 2 0 0 0-2.336 1.973v9.924a232 232 0 0 1-2.145-1.784 2.29 2.29 0 0 0-3.235.109 2.29 2.29 0 0 0 .098 3.23l1.821 1.628H24.01v-.593a5 5 0 0 0-3.171-4.653Zm-11.83-1.982V10.96c0-.7.201-1.366.538-1.96H0v6c0 2.114 1.324 3.916 3.183 4.646a4.2 4.2 0 0 1 .985-1.803 4.29 4.29 0 0 1 4.841-1.005Zm11.699-.218c.177-.511.293-1.05.293-1.62V9h-4.54c.349.613.549 1.322.549 2.067v4.099z" />
        </svg>
        <span class="hidden lg:block absolute left-16 lg:static rounded-lg bg-gray-200 lg:bg-transparent lg:dark:bg-transparent dark:bg-gray-700 px-2 py-1 lg:p-0 transition-all ease-in w-full">
            <div class="title flex gap-4 justify-between items-center">
                Reservasi
                <div class="lg:w-5 w-6 fill-inherit" x-show="!sideDropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M18.71 8.21a1 1 0 0 0-1.42 0l-4.58 4.58a1 1 0 0 1-1.42 0L6.71 8.21a1 1 0 0 0-1.42 0 1 1 0 0 0 0 1.41l4.59 4.59a3 3 0 0 0 4.24 0l4.59-4.59a1 1 0 0 0 0-1.41" />
                    </svg>
                </div>
                <div class="lg:w-5 w-6 fill-inherit" x-show="sideDropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M18 15.5a1 1 0 0 1-.71-.29l-4.58-4.59a1 1 0 0 0-1.42 0l-4.58 4.59a1 1 0 0 1-1.42-1.42l4.59-4.58a3.06 3.06 0 0 1 4.24 0l4.59 4.58a1 1 0 0 1 0 1.42 1 1 0 0 1-.71.29" />
                    </svg>
                </div>
            </div>
        </span>
    </button>
    <ul x-show="sideDropdown" class="ms-3 mt-2 flex flex-col gap-2">
        <x-sidebar.sidebaritem href="{{ route('warga.layanan.reservasiJadwalTemu.index') }}" title="Reservasi" :active="request()->routeIs(['warga.layanan.reservasiJadwalTemu.index'])">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="lg:w-5 w-6 fill-inherit">
                <path d="M24 7v1H0V7a5 5 0 0 1 5-5h1V1a1 1 0 0 1 2 0v1h8V1a1 1 0 0 1 2 0v1h1a5 5 0 0 1 5 5m0 10c0 3.86-3.141 7-7 7s-7-3.14-7-7 3.141-7 7-7 7 3.14 7 7m-5 .586-1-1V15a1 1 0 0 0-2 0v2c0 .265.105.52.293.707L17.586 19A1 1 0 0 0 19 17.586M8 17a8.98 8.98 0 0 1 3.349-7H0v9a5 5 0 0 0 5 5h6.349A8.98 8.98 0 0 1 8 17" />
            </svg>
        </x-sidebar.sidebaritem>
        <x-sidebar.sidebaritem href="{{ route('warga.layanan.reservasiJadwalTemu.newReservasiJadwalTemuPage') }}" title="Buat Reservasi" :active="request()->routeIs(['warga.layanan.reservasiJadwalTemu.newReservasiJadwalTemuPage'])">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="lg:w-5 w-6 fill-inherit">
                <path d="M24 8H0V7c0-2.757 2.243-5 5-5h1V1a1 1 0 1 1 2 0v1h8V1a1 1 0 1 1 2 0v1h1c2.757 0 5 2.243 5 5zM10 22.545c0-.892.187-1.753.535-2.545H6a1 1 0 1 1 0-2l5.92.001L13.921 16H6a1 1 0 1 1 0-2h9.922l2.741-2.741A4.27 4.27 0 0 1 21.702 10H0v9c0 2.757 2.243 5 5 5h5zm10.077-9.872a2.299 2.299 0 0 1 3.25 3.25L16.52 22.73A4.33 4.33 0 0 1 13.455 24H12v-1.455c0-1.15.457-2.252 1.27-3.065z" />
            </svg>
        </x-sidebar.sidebaritem>
    </ul>

</div>
@endsection