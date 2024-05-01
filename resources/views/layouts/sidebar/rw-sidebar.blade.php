@extends('layouts.sidebar.sidebar')
@section('menu')
    <x-sidebar.sidebaritem href="{{ route('rw.dashboard') }}" title="Dashboard" :active="request()->routeIs(['rw.dashboard'])">
        <svg xmlns=" http://www.w3.org/2000/svg" viewBox="0 0 512 512" xml:space="preserve" class="lg:w-5 w-6 fill-inherit">
            <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
            <path
                d="M362.667 383.841v128H448c35.346 0 64-28.654 64-64V253.26a42.67 42.67 0 0 0-12.011-29.696l-181.29-195.99c-31.988-34.61-85.976-36.735-120.586-4.747a85 85 0 0 0-4.747 4.747L12.395 223.5A42.67 42.67 0 0 0 0 253.58v194.261c0 35.346 28.654 64 64 64h85.333v-128c.399-58.172 47.366-105.676 104.073-107.044 58.604-1.414 108.814 46.899 109.261 107.044" />
            <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
        </svg>
    </x-sidebar.sidebaritem>
    <x-sidebar.sidebaritem href="{{ route('rw.manage.warga.warga') }}" title="Pendataan" :active="request()->routeIs(['rw.manage.warga.warga'])">
        <svg xmlns=" http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24" class="lg:w-5 w-6 fill-inherit">
            <path
                d="M22.026 7h-7V0h-10a3 3 0 0 0-3 3v21H6v-2c0-1.654 1.346-3 3-3h6.026c1.654 0 3 1.346 3 3v2h4zm-10 10c-2.205 0-4-1.795-4-4s1.795-4 4-4 4 1.795 4 4-1.795 4-4 4M21.44 5h-4.414V.586zm-7.414 8c0 1.103-.897 2-2 2s-2-.897-2-2 .897-2 2-2 2 .897 2 2m2 9v2H8v-2c0-.551.449-1 1-1h6.026c.552 0 1 .449 1 1" />
        </svg>
    </x-sidebar.sidebaritem>
    <x-sidebar.sidebaritem href="{{ route('rw.dashboard') }}" title="Iuran Warga">
        <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24" class="lg:w-5 w-6">
            <path
                d="M24 6.5a1.5 1.5 0 1 1-3.001-.001A1.5 1.5 0 0 1 24 6.5M15.5 3a1.5 1.5 0 1 0-.001-3.001A1.5 1.5 0 0 0 15.5 3m.945 4.832a1 1 0 0 0 1.387-.277l4-6a1.001 1.001 0 0 0-1.664-1.11l-4 6a1 1 0 0 0 .277 1.387M5.75 8c3.176 0 5.75-1.343 5.75-3S8.926 2 5.75 2 0 3.343 0 5s2.574 3 5.75 3m0 8c3.278 0 5.75-1.505 5.75-3.5v-2c0 1.971-2.396 3.5-5.75 3.5S0 12.471 0 10.5v2C0 14.495 2.472 16 5.75 16m0-4c3.278 0 5.75-1.505 5.75-3.5v-2c0 1.971-2.396 3.5-5.75 3.5S0 8.471 0 6.5v2C0 10.495 2.472 12 5.75 12m11.5-2c-3.176 0-5.75 1.343-5.75 3s2.574 3 5.75 3S23 14.657 23 13s-2.574-3-5.75-3m0 12c-3.354 0-5.75-1.529-5.75-3.5 0 1.971-2.396 3.5-5.75 3.5S0 20.471 0 18.5v2C0 22.495 2.472 24 5.75 24s5.75-1.505 5.75-3.5c0 1.995 2.472 3.5 5.75 3.5S23 22.495 23 20.5v-2c0 1.971-2.396 3.5-5.75 3.5m0-4c-3.354 0-5.75-1.529-5.75-3.5 0 1.971-2.396 3.5-5.75 3.5S0 16.471 0 14.5v2C0 18.495 2.472 20 5.75 20s5.75-1.505 5.75-3.5c0 1.995 2.472 3.5 5.75 3.5S23 18.495 23 16.5v-2c0 1.971-2.396 3.5-5.75 3.5" />
        </svg>
    </x-sidebar.sidebaritem>
    <x-sidebar.sidebaritem href="{{ route('rw.manage.pengaduan.pengaduan') }}" title="Pengaduan" :active="request()->routeIs(['rw.manage.pengaduan.pengaduan'])">
        <svg xmlns=" http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24" class="lg:w-5 w-6">
            <path
                d="M18 12c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6m1 9c0 .55-.45 1-1 1s-1-.45-1-1v-2c0-.55.45-1 1-1s1 .45 1 1zm-1-4c-.83 0-1.5-.67-1.5-1.5S17.17 14 18 14s1.5.67 1.5 1.5S18.83 17 18 17m-6.92 5H5c-2.76 0-5-2.24-5-5V5c0-2.76 2.24-5 5-5h5v5c0 1.65 1.35 3 3 3h5v2c-4.41 0-8 3.59-8 8 0 1.46.4 2.82 1.08 4M12 5V.15c.46.15.88.39 1.23.73l3.9 3.94c.33.33.56.73.7 1.17H13c-.55 0-1-.45-1-1Z" />
        </svg>
    </x-sidebar.sidebaritem>
    <x-sidebar.sidebaritem href="{{ route('rw.manage.pengumuman.pengumuman') }}" title="Pengumuman" :active="request()->routeIs(['rw.manage.pengumuman.pengumuman'])">
        <svg xmlns=" http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24" class="lg:w-5 w-6">
            <path
                d="M22 11.95V18a1 1 0 0 1-1.985.165C19.626 15.832 16.395 15 13.501 15h-4.5V4h4.5c2.894 0 6.125-.831 6.514-3.165A1 1 0 0 1 22.001 1v6.05a2.5 2.5 0 0 1 0 4.9ZM7 15V4H5.5C2.467 4 0 6.467 0 9.5S2.467 15 5.5 15zm1.523 2H5.5a7.5 7.5 0 0 1-2.505-.431l2.171 5.792a2.48 2.48 0 0 0 1.289 1.405 2.48 2.48 0 0 0 1.905.082 2.48 2.48 0 0 0 1.405-1.289c.281-.604.31-1.28.082-1.904l-1.325-3.656Z" />
        </svg>
    </x-sidebar.sidebaritem>
    <x-sidebar.sidebaritem href="{{ route('rw.dashboard') }}" title="Dokumen">
        <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24" class="lg:w-5 w-6">
            <path
                d="M18 12a6 6 0 1 0 0 12 6 6 0 0 0 0-12m3.192 6.202-2.213 2.124c-.452.446-1.052.671-1.653.671s-1.203-.225-1.663-.674l-1.132-1.109a1 1 0 1 1 1.4-1.428l1.131 1.108a.374.374 0 0 0 .522-.002l2.223-2.134a1 1 0 1 1 1.385 1.443ZM10 18a7.98 7.98 0 0 1 2.709-6H5a1 1 0 1 1 0-2h8a1 1 0 0 1 .997 1.072A7.96 7.96 0 0 1 18 10V5c0-2.757-2.243-5-5-5H5C2.243 0 0 2.243 0 5v14c0 2.757 2.243 5 5 5h7.709A7.98 7.98 0 0 1 10 18M5 5h8a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2m2 12H5a1 1 0 1 1 0-2h2a1 1 0 1 1 0 2" />
        </svg>
    </x-sidebar.sidebaritem>
    <x-sidebar.sidebaritem href="{{ route('rw.manage.templateDokumen.templateDokumen') }}" title="Template Dokumen"
        :active="request()->routeIs(['rw.manage.templateDokumen.templateDokumen'])">
        <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24" class="lg:w-5 w-6">
            <path
                d="M18 12a6 6 0 1 0 0 12 6 6 0 0 0 0-12m3.192 6.202-2.213 2.124c-.452.446-1.052.671-1.653.671s-1.203-.225-1.663-.674l-1.132-1.109a1 1 0 1 1 1.4-1.428l1.131 1.108a.374.374 0 0 0 .522-.002l2.223-2.134a1 1 0 1 1 1.385 1.443ZM10 18a7.98 7.98 0 0 1 2.709-6H5a1 1 0 1 1 0-2h8a1 1 0 0 1 .997 1.072A7.96 7.96 0 0 1 18 10V5c0-2.757-2.243-5-5-5H5C2.243 0 0 2.243 0 5v14c0 2.757 2.243 5 5 5h7.709A7.98 7.98 0 0 1 10 18M5 5h8a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2m2 12H5a1 1 0 1 1 0-2h2a1 1 0 1 1 0 2" />
        </svg>
    </x-sidebar.sidebaritem>
    <x-sidebar.sidebaritem href="{{ route('rw.manage.umkm.umkm') }}" title="UMKM" :active="request()->routeIs(['rw.manage.umkm.umkm'])">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="lg:w-5 w-6">
            <path
                d="M16 13a5 5 0 0 1-8 0 4.956 4.956 0 0 1-7 .977V19a5.006 5.006 0 0 0 5 5h12a5.006 5.006 0 0 0 5-5v-5.026A4.956 4.956 0 0 1 16 13" />
            <path
                d="M21.7 3.131A3.975 3.975 0 0 0 17.792 0H17v3a1 1 0 0 1-2 0V0H9v3a1 1 0 0 1-2 0V0h-.792A3.975 3.975 0 0 0 2.3 3.132L1.022 8.9 1 10.02A3 3 0 0 0 7 10a1 1 0 0 1 2 0 3 3 0 1 0 6 0 1 1 0 0 1 2 0 3 3 0 1 0 6 0v-.893Z" />
        </svg>
    </x-sidebar.sidebaritem>
@endsection
