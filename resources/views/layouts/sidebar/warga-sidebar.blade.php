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
        <svg xmlns=" http://www.w3.org/2000/svg" viewBox="0 0 512 512" xml:space="preserve" class="w-6 fill-inherit">
            <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
            <path d="M362.667 383.841v128H448c35.346 0 64-28.654 64-64V253.26a42.67 42.67 0 0 0-12.011-29.696l-181.29-195.99c-31.988-34.61-85.976-36.735-120.586-4.747a85 85 0 0 0-4.747 4.747L12.395 223.5A42.67 42.67 0 0 0 0 253.58v194.261c0 35.346 28.654 64 64 64h85.333v-128c.399-58.172 47.366-105.676 104.073-107.044 58.604-1.414 108.814 46.899 109.261 107.044" />
            <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
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
            <svg xmlns=" http://www.w3.org/2000/svg" viewBox="0 0 512 512" xml:space="preserve" class="lg:w-5 w-6 fill-inherit">
                <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
                <path d="M362.667 383.841v128H448c35.346 0 64-28.654 64-64V253.26a42.67 42.67 0 0 0-12.011-29.696l-181.29-195.99c-31.988-34.61-85.976-36.735-120.586-4.747a85 85 0 0 0-4.747 4.747L12.395 223.5A42.67 42.67 0 0 0 0 253.58v194.261c0 35.346 28.654 64 64 64h85.333v-128c.399-58.172 47.366-105.676 104.073-107.044 58.604-1.414 108.814 46.899 109.261 107.044" />
                <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
            </svg>
        </x-sidebar.sidebaritem>
        <x-sidebar.sidebaritem href="{{ route('warga.layanan.pengaduan.newPengaduanPage') }}" title="Buat Pengaduan" :active="request()->routeIs(['warga.layanan.pengaduan.newPengaduanPage'])">
            <svg xmlns=" http://www.w3.org/2000/svg" viewBox="0 0 512 512" xml:space="preserve" class="lg:w-5 w-6 fill-inherit">
                <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
                <path d="M362.667 383.841v128H448c35.346 0 64-28.654 64-64V253.26a42.67 42.67 0 0 0-12.011-29.696l-181.29-195.99c-31.988-34.61-85.976-36.735-120.586-4.747a85 85 0 0 0-4.747 4.747L12.395 223.5A42.67 42.67 0 0 0 0 253.58v194.261c0 35.346 28.654 64 64 64h85.333v-128c.399-58.172 47.366-105.676 104.073-107.044 58.604-1.414 108.814 46.899 109.261 107.044" />
                <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
            </svg>
        </x-sidebar.sidebaritem>
    </ul>
</div>

<div class="relative" x-data="{sideDropdown: false}">
    <button class="{{$activeDropReservasi ? $activeStyle['active']:$activeStyle['default'];}}" @click="sideDropdown = !sideDropdown" x-effect="document.location.pathname.split('/').includes('reservasi-jadwal-temu') ? sideDropdown = true : sideDropdown = false">
        <svg xmlns=" http://www.w3.org/2000/svg" viewBox="0 0 512 512" xml:space="preserve" class="w-6 fill-inherit">
            <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
            <path d="M362.667 383.841v128H448c35.346 0 64-28.654 64-64V253.26a42.67 42.67 0 0 0-12.011-29.696l-181.29-195.99c-31.988-34.61-85.976-36.735-120.586-4.747a85 85 0 0 0-4.747 4.747L12.395 223.5A42.67 42.67 0 0 0 0 253.58v194.261c0 35.346 28.654 64 64 64h85.333v-128c.399-58.172 47.366-105.676 104.073-107.044 58.604-1.414 108.814 46.899 109.261 107.044" />
            <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
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
            <svg xmlns=" http://www.w3.org/2000/svg" viewBox="0 0 512 512" xml:space="preserve" class="lg:w-5 w-6 fill-inherit">
                <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
                <path d="M362.667 383.841v128H448c35.346 0 64-28.654 64-64V253.26a42.67 42.67 0 0 0-12.011-29.696l-181.29-195.99c-31.988-34.61-85.976-36.735-120.586-4.747a85 85 0 0 0-4.747 4.747L12.395 223.5A42.67 42.67 0 0 0 0 253.58v194.261c0 35.346 28.654 64 64 64h85.333v-128c.399-58.172 47.366-105.676 104.073-107.044 58.604-1.414 108.814 46.899 109.261 107.044" />
                <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
            </svg>
        </x-sidebar.sidebaritem>
        <x-sidebar.sidebaritem href="{{ route('warga.layanan.reservasiJadwalTemu.newReservasiJadwalTemuPage') }}" title="Buat Reservasi" :active="request()->routeIs(['warga.layanan.reservasiJadwalTemu.newReservasiJadwalTemuPage'])">
            <svg xmlns=" http://www.w3.org/2000/svg" viewBox="0 0 512 512" xml:space="preserve" class="lg:w-5 w-6 fill-inherit">
                <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
                <path d="M362.667 383.841v128H448c35.346 0 64-28.654 64-64V253.26a42.67 42.67 0 0 0-12.011-29.696l-181.29-195.99c-31.988-34.61-85.976-36.735-120.586-4.747a85 85 0 0 0-4.747 4.747L12.395 223.5A42.67 42.67 0 0 0 0 253.58v194.261c0 35.346 28.654 64 64 64h85.333v-128c.399-58.172 47.366-105.676 104.073-107.044 58.604-1.414 108.814 46.899 109.261 107.044" />
                <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
            </svg>
        </x-sidebar.sidebaritem>
    </ul>

</div>
@endsection