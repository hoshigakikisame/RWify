@extends('layouts.sidebar.sidebar')
@section('menu')
    @php
        $activeStyle = [
            'default' =>
                'sidebar-item flex w-full items-center justify-center gap-3 text-nowrap rounded-lg px-3 py-2 text-gray-800 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-800 lg:justify-normal',
            'active' =>
                'sidebar-item flex w-full items-center justify-center gap-3 text-nowrap rounded-lg rounded-lg bg-gray-100 fill-blue-600 px-3 py-2 text-blue-600 dark:bg-gray-800 dark:fill-blue-400 dark:text-blue-300 dark:hover:bg-gray-800 lg:justify-normal',
        ];

        $activeDropIuran = request()->routeIs(['rt.dashboard']);
        $activeDropProperti = request()->routeIs(['rt.manage.properti.index', 'rt.manage.tipeProperti.index']);
    @endphp

    <x-sidebar.sidebar-item href="{{ route('rt.dashboard') }}" title="Dashboard" :active="request()->routeIs(['rt.dashboard'])">
        <svg xmlns=" http://www.w3.org/2000/svg" viewBox="0 0 512 512" xml:space="preserve" class="w-6 fill-inherit lg:w-5">
            <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
            <path
                d="M362.667 383.841v128H448c35.346 0 64-28.654 64-64V253.26a42.67 42.67 0 0 0-12.011-29.696l-181.29-195.99c-31.988-34.61-85.976-36.735-120.586-4.747a85 85 0 0 0-4.747 4.747L12.395 223.5A42.67 42.67 0 0 0 0 253.58v194.261c0 35.346 28.654 64 64 64h85.333v-128c.399-58.172 47.366-105.676 104.073-107.044 58.604-1.414 108.814 46.899 109.261 107.044" />
            <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
        </svg>
    </x-sidebar.sidebar-item>
    <x-sidebar.sidebar-item
        href="{{ route('rt.manage.warga') }}"
        title="Pendataan"
        :active="request()->routeIs(['rt.manage.warga'])"
    >
        <svg
            xmlns=" http://www.w3.org/2000/svg"
            data-name="Layer 1"
            viewBox="0 0 24 24"
            class="w-6 fill-inherit lg:w-5"
        >
            <path
                d="M22.026 7h-7V0h-10a3 3 0 0 0-3 3v21H6v-2c0-1.654 1.346-3 3-3h6.026c1.654 0 3 1.346 3 3v2h4zm-10 10c-2.205 0-4-1.795-4-4s1.795-4 4-4 4 1.795 4 4-1.795 4-4 4M21.44 5h-4.414V.586zm-7.414 8c0 1.103-.897 2-2 2s-2-.897-2-2 .897-2 2-2 2 .897 2 2m2 9v2H8v-2c0-.551.449-1 1-1h6.026c.552 0 1 .449 1 1"
            />
        </svg>
    </x-sidebar.sidebar-item>
    <x-sidebar.sidebar-item
    href="{{ route('rt.manage.pengaduan') }}"
    title="Pengaduan"
    :active="request()->routeIs(['rt.manage.pengaduan'])"
>
    <svg xmlns=" http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24" class="w-6 lg:w-5">
        <path
            d="M18 12c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6m1 9c0 .55-.45 1-1 1s-1-.45-1-1v-2c0-.55.45-1 1-1s1 .45 1 1zm-1-4c-.83 0-1.5-.67-1.5-1.5S17.17 14 18 14s1.5.67 1.5 1.5S18.83 17 18 17m-6.92 5H5c-2.76 0-5-2.24-5-5V5c0-2.76 2.24-5 5-5h5v5c0 1.65 1.35 3 3 3h5v2c-4.41 0-8 3.59-8 8 0 1.46.4 2.82 1.08 4M12 5V.15c.46.15.88.39 1.23.73l3.9 3.94c.33.33.56.73.7 1.17H13c-.55 0-1-.45-1-1Z"
        />
    </svg>
</x-sidebar.sidebar-item>
<x-sidebar.sidebar-item
        href="{{ route('rt.manage.reservasiJadwalTemu.index') }}"
        title="Jadwal Temu"
        :active="request()->routeIs(['rt.manage.reservasiJadwalTemu.index'])"
    >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 lg:w-5">
            <path
                d="M24,5v3H0v-3c0-1.654,1.346-3,3-3h3V0h2V2h8V0h2V2h3c1.654,0,3,1.346,3,3Zm0,12c0,3.86-3.141,7-7,7s-7-3.14-7-7,3.141-7,7-7,7,3.14,7,7Zm-4.293,1.293l-1.707-1.707v-2.586h-2v3.414l2.293,2.293,1.414-1.414Zm-11.707-1.293c0-2.829,1.308-5.35,3.349-7H0v14H11.349c-2.041-1.65-3.349-4.171-3.349-7Z"
            />
        </svg>
    </x-sidebar.sidebar-item>
@endsection
