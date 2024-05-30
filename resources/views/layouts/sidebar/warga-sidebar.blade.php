@extends('layouts.sidebar.sidebar')
@section('menu')
    <x-sidebar.sidebar-item
        href="{{ route('warga.dashboard') }}"
        title="Dashboard"
        :active="request()->routeIs(['warga.dashboard'])"
    >
        <svg
            xmlns=" http://www.w3.org/2000/svg"
            viewBox="0 0 512 512"
            xml:space="preserve"
            class="w-6 fill-inherit lg:w-5"
        >
            <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
            <path
                d="M362.667 383.841v128H448c35.346 0 64-28.654 64-64V253.26a42.67 42.67 0 0 0-12.011-29.696l-181.29-195.99c-31.988-34.61-85.976-36.735-120.586-4.747a85 85 0 0 0-4.747 4.747L12.395 223.5A42.67 42.67 0 0 0 0 253.58v194.261c0 35.346 28.654 64 64 64h85.333v-128c.399-58.172 47.366-105.676 104.073-107.044 58.604-1.414 108.814 46.899 109.261 107.044"
            />
            <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
        </svg>
    </x-sidebar.sidebar-item>
    @php
        $activeStyle = ['default' => 'sidebar-item flex w-full items-center justify-center gap-3 text-nowrap rounded-lg px-3 py-2 text-gray-800 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-800 lg:justify-normal', 'active' => 'sidebar-item flex w-full items-center justify-center gap-3 text-nowrap rounded-lg rounded-lg bg-gray-100 fill-blue-600 px-3 py-2 text-blue-600 dark:bg-gray-800 dark:fill-blue-400 dark:text-blue-300 dark:hover:bg-gray-800 lg:justify-normal'];

        $activeDropIuran = request()->routeIs(['warga.layanan.pembayaranIuran.riwayatPembayaranIuran', 'warga.layanan.pembayaranIuran.newIuranPage', 'warga.layanan.pembayaranIuran.leaderboard']);
        $activeDropPengaduan = request()->routeIs(['warga.layanan.pengaduan.index', 'warga.layanan.pengaduan.newPengaduanPage']);
        $activeDropReservasi = request()->routeIs(['warga.layanan.reservasiJadwalTemu.index', 'warga.layanan.reservasiJadwalTemu.newReservasiJadwalTemuPage']);
    @endphp

    <div class="relative" x-data="{ sideDropdown: false }">
        <button
            class="{{ $activeDropIuran ? $activeStyle['active'] : $activeStyle['default'] }}"
            @click="sideDropdown = !sideDropdown"
            x-effect="
                document.location.pathname.split('/').includes('pembayaranIuran')
                    ? (sideDropdown = true)
                    : (sideDropdown = false)
            "
        >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 fill-inherit">
                <path
                    d="M24 6.5a1.5 1.5 0 1 1-3.001-.001A1.5 1.5 0 0 1 24 6.5M15.5 3a1.5 1.5 0 1 0-.001-3.001A1.5 1.5 0 0 0 15.5 3m.945 4.832a1 1 0 0 0 1.387-.277l4-6a1.001 1.001 0 0 0-1.664-1.11l-4 6a1 1 0 0 0 .277 1.387M5.75 8c3.176 0 5.75-1.343 5.75-3S8.926 2 5.75 2 0 3.343 0 5s2.574 3 5.75 3m0 8c3.278 0 5.75-1.505 5.75-3.5v-2c0 1.971-2.396 3.5-5.75 3.5S0 12.471 0 10.5v2C0 14.495 2.472 16 5.75 16m0-4c3.278 0 5.75-1.505 5.75-3.5v-2c0 1.971-2.396 3.5-5.75 3.5S0 8.471 0 6.5v2C0 10.495 2.472 12 5.75 12m11.5-2c-3.176 0-5.75 1.343-5.75 3s2.574 3 5.75 3S23 14.657 23 13s-2.574-3-5.75-3m0 12c-3.354 0-5.75-1.529-5.75-3.5 0 1.971-2.396 3.5-5.75 3.5S0 20.471 0 18.5v2C0 22.495 2.472 24 5.75 24s5.75-1.505 5.75-3.5c0 1.995 2.472 3.5 5.75 3.5S23 22.495 23 20.5v-2c0 1.971-2.396 3.5-5.75 3.5m0-4c-3.354 0-5.75-1.529-5.75-3.5 0 1.971-2.396 3.5-5.75 3.5S0 16.471 0 14.5v2C0 18.495 2.472 20 5.75 20s5.75-1.505 5.75-3.5c0 1.995 2.472 3.5 5.75 3.5S23 18.495 23 16.5v-2c0 1.971-2.396 3.5-5.75 3.5"
                />
            </svg>
            <span
                class="absolute left-16 hidden w-full rounded-lg bg-gray-200 px-2 py-1 transition-all ease-in dark:bg-gray-700 lg:static lg:block lg:bg-transparent lg:p-0 lg:dark:bg-transparent"
            >
                <div class="title flex items-center justify-between gap-4">
                    Iuran
                    <div class="w-6 fill-inherit lg:w-5" x-show="!sideDropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M18.71 8.21a1 1 0 0 0-1.42 0l-4.58 4.58a1 1 0 0 1-1.42 0L6.71 8.21a1 1 0 0 0-1.42 0 1 1 0 0 0 0 1.41l4.59 4.59a3 3 0 0 0 4.24 0l4.59-4.59a1 1 0 0 0 0-1.41"
                            />
                        </svg>
                    </div>
                    <div class="w-6 fill-inherit lg:w-5" x-show="sideDropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M18 15.5a1 1 0 0 1-.71-.29l-4.58-4.59a1 1 0 0 0-1.42 0l-4.58 4.59a1 1 0 0 1-1.42-1.42l4.59-4.58a3.06 3.06 0 0 1 4.24 0l4.59 4.58a1 1 0 0 1 0 1.42 1 1 0 0 1-.71.29"
                            />
                        </svg>
                    </div>
                </div>
            </span>
        </button>
        <ul x-show="sideDropdown" class="ms-3 mt-2 flex flex-col gap-2">
            <x-sidebar.sidebar-item
                href="{{ route('warga.layanan.pembayaranIuran.riwayatPembayaranIuran') }}"
                title="Riwayat"
                :active="request()->routeIs(['warga.layanan.pembayaranIuran.riwayatPembayaranIuran'])"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    version="1.1"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 24 24"
                    style="enable-background: new 0 0 512 512"
                    xml:space="preserve"
                    class="w-6 fill-inherit lg:w-5"
                >
                    <path
                        fill-rule="evenodd"
                        d="M20.41 9.86a3 3 0 0 0-.175-.003H17.8c-1.992 0-3.698 1.581-3.698 3.643s1.706 3.643 3.699 3.643h2.433q.092.001.175-.004a1.7 1.7 0 0 0 1.586-1.581c.004-.059.004-.122.004-.18v-3.756c0-.058 0-.121-.004-.18a1.7 1.7 0 0 0-1.585-1.581m-2.823 4.611c.513 0 .93-.434.93-.971s-.417-.971-.93-.971-.929.434-.929.971.416.971.93.971"
                        clip-rule="evenodd"
                    />
                    <path
                        fill-rule="evenodd"
                        d="M20.234 18.6a.214.214 0 0 1 .214.27c-.194.692-.501 1.282-.994 1.778-.721.727-1.636 1.05-2.766 1.203-1.098.149-2.5.149-4.272.149h-2.037c-1.771 0-3.174 0-4.272-.149-1.13-.153-2.045-.476-2.766-1.203C2.62 19.923 2.3 19 2.148 17.862 2 16.754 2 15.34 2 13.555v-.11c0-1.785 0-3.2.148-4.306C2.3 8 2.62 7.08 3.34 6.351c.721-.726 1.636-1.05 2.766-1.202C7.205 5 8.608 5 10.379 5h2.037c1.771 0 3.174 0 4.272.149 1.13.153 2.045.476 2.766 1.202.493.497.8 1.087.994 1.78a.214.214 0 0 1-.214.269h-2.433c-2.734 0-5.143 2.177-5.143 5.1s2.41 5.1 5.144 5.1zM5.614 8.886a.725.725 0 0 0-.722.728c0 .403.323.729.722.729H9.47c.4 0 .723-.326.723-.729a.726.726 0 0 0-.723-.728z"
                        clip-rule="evenodd"
                    />
                    <path
                        d="m7.777 4.024 1.958-1.443a2.97 2.97 0 0 1 3.53 0l1.969 1.451C14.41 4 13.49 4 12.483 4h-2.17c-.922 0-1.769 0-2.536.024"
                    />
                </svg>
            </x-sidebar.sidebar-item>
            <x-sidebar.sidebar-item
                href="{{ route('warga.layanan.pembayaranIuran.newIuranPage') }}"
                title="Bayar Iuran"
                :active="request()->routeIs(['warga.layanan.pembayaranIuran.newIuranPage'])"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    version="1.1"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    x="0"
                    y="0"
                    viewBox="0 0 24 24"
                    style="enable-background: new 0 0 512 512"
                    xml:space="preserve"
                    class="w-7 fill-inherit lg:w-6"
                >
                    <path
                        d="M6.25 2A2.25 2.25 0 0 0 4 4.25v15.5A2.25 2.25 0 0 0 6.25 22h7.5A2.25 2.25 0 0 0 16 19.771v-1.52a.75.75 0 0 0-.75-.75c-.453 0-.739-.123-.936-.282-.208-.167-.38-.425-.511-.789-.273-.755-.302-1.75-.302-2.68a.75.75 0 0 0-.202-.512l-.165-.177a3 3 0 0 0-.17-.173c-.074-.07-.3-.285-1.183-1.168-.469-.469-.728-.865-.813-1.168a.6.6 0 0 1-.016-.325.7.7 0 0 1 .205-.323.7.7 0 0 1 .322-.204.6.6 0 0 1 .324.016c.302.085.698.346 1.167.815.54.54 1.053 1.047 1.512 1.5.76.752 1.373 1.36 1.72 1.73a.75.75 0 0 0 1.097-1.023A55 55 0 0 0 16 11.424V8.06l2.842 2.842c.421.422.659.994.659 1.59v8.758a.75.75 0 0 0 1.5 0v-8.757a3.75 3.75 0 0 0-1.099-2.652L16 5.939v-1.69A2.25 2.25 0 0 0 13.75 2zm7.124 16.388a2.7 2.7 0 0 0 1.126.534V19h-.75a.75.75 0 0 0-.75.75v.75h-1.5v-.75a2.25 2.25 0 0 1 1.276-2.028c.16.244.356.472.598.666m-1.372-4.342c.002.253.007.526.022.81a3.5 3.5 0 1 1-1.55-6.324q-.2.133-.378.312c-.292.292-.5.63-.597 1.01s-.074.754.025 1.104c.189.673.665 1.291 1.197 1.823A67 67 0 0 0 11.957 14l.004.003.037.039zM7 3.5h1.5v.75A2.25 2.25 0 0 1 6.25 6.5H5.5V5h.75A.75.75 0 0 0 7 4.25zm4.5 0H13v.75c0 .414.336.75.75.75h.75v1.5h-.75a2.25 2.25 0 0 1-2.25-2.25zm-3 17H7v-.75a.75.75 0 0 0-.75-.75H5.5v-1.5h.75a2.25 2.25 0 0 1 2.25 2.25z"
                    />
                </svg>
            </x-sidebar.sidebar-item>
            <x-sidebar.sidebar-item
                href="{{ route('warga.layanan.pengaduan.newPengaduanPage') }}"
                title="Leaderboard"
                :active="request()->routeIs(['rw.dashboard'])"
            >
                <svg viewBox="0 0 24 24" class="w-7 fill-inherit lg:w-6" xmlns="http://www.w3.org/2000/svg">
                    <path
                        fill-rule="evenodd"
                        class="fill-inherit"
                        d="M13.436 5.783a3 3 0 0 0-2.872 0L5.769 8.397a3 3 0 0 0-1.563 2.634v4.938a3 3 0 0 0 1.563 2.634l4.795 2.614a3 3 0 0 0 2.872 0l4.794-2.614a3 3 0 0 0 1.564-2.634V11.03a3 3 0 0 0-1.564-2.634zM12 10.5c-.284 0-.474.34-.854 1.023l-.098.176c-.108.194-.162.29-.246.354-.085.064-.19.088-.4.135l-.19.044c-.738.167-1.107.25-1.195.532s.164.577.667 1.165l.13.152c.143.167.215.25.247.354s.021.215 0 .438l-.02.203c-.076.785-.114 1.178.115 1.352.23.174.576.015 1.267-.303l.178-.082c.197-.09.295-.135.399-.135s.202.045.399.135l.178.082c.691.319 1.037.477 1.267.303s.191-.567.115-1.352l-.02-.203c-.021-.223-.032-.334 0-.438s.104-.187.247-.354l.13-.152c.503-.588.755-.882.667-1.165-.088-.282-.457-.365-1.195-.532l-.19-.044c-.21-.047-.315-.07-.4-.135-.084-.064-.138-.16-.246-.354l-.098-.176c-.38-.682-.57-1.023-.854-1.023"
                        clip-rule="evenodd"
                    />
                    <path
                        class="fill-inherit"
                        d="M11 2h2c1.886 0 2.828 0 3.414.586S17 4.114 17 6v.018l-2.846-1.552a4.5 4.5 0 0 0-4.308 0L7 6.018V6c0-1.886 0-2.828.586-3.414S9.114 2 11 2"
                    />
                </svg>
            </x-sidebar.sidebar-item>
        </ul>
    </div>

    <div class="relative" x-data="{ sideDropdown: false }">
        <button
            class="{{ $activeDropPengaduan ? $activeStyle['active'] : $activeStyle['default'] }}"
            @click="sideDropdown = !sideDropdown"
            x-effect="
                document.location.pathname.split('/').includes('pengaduan')
                    ? (sideDropdown = true)
                    : (sideDropdown = false)
            "
        >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 fill-inherit">
                <path
                    d="M21.976 10.015H15c-1.654 0-3-1.346-3-3V.038c-.161-.011-.322-.024-.485-.024H7a5.007 5.007 0 0 0-5 5.001v14c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V10.5c0-.163-.013-.324-.024-.485M11 12a1 1 0 0 1 2 0v3.5a1 1 0 0 1-2 0zm1 9a1.5 1.5 0 1 1 .001-3.001A1.5 1.5 0 0 1 12 21m2-13.985V.474a7 7 0 0 1 2.465 1.59l3.484 3.486a6.95 6.95 0 0 1 1.591 2.464H15c-.552 0-1-.449-1-1Z"
                />
            </svg>
            <span
                class="absolute left-16 hidden w-full rounded-lg bg-gray-200 px-2 py-1 transition-all ease-in dark:bg-gray-700 lg:static lg:block lg:bg-transparent lg:p-0 lg:dark:bg-transparent"
            >
                <div class="title flex items-center justify-between gap-4">
                    Pengaduan
                    <div class="w-6 fill-inherit lg:w-5" x-show="!sideDropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M18.71 8.21a1 1 0 0 0-1.42 0l-4.58 4.58a1 1 0 0 1-1.42 0L6.71 8.21a1 1 0 0 0-1.42 0 1 1 0 0 0 0 1.41l4.59 4.59a3 3 0 0 0 4.24 0l4.59-4.59a1 1 0 0 0 0-1.41"
                            />
                        </svg>
                    </div>
                    <div class="w-6 fill-inherit lg:w-5" x-show="sideDropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M18 15.5a1 1 0 0 1-.71-.29l-4.58-4.59a1 1 0 0 0-1.42 0l-4.58 4.59a1 1 0 0 1-1.42-1.42l4.59-4.58a3.06 3.06 0 0 1 4.24 0l4.59 4.58a1 1 0 0 1 0 1.42 1 1 0 0 1-.71.29"
                            />
                        </svg>
                    </div>
                </div>
            </span>
        </button>
        <ul x-show="sideDropdown" class="ms-3 mt-2 flex flex-col gap-2">
            <x-sidebar.sidebar-item
                href="{{ route('warga.layanan.pengaduan.index') }}"
                title="Pengaduan"
                :active="request()->routeIs(['warga.layanan.pengaduan.index'])"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 fill-inherit lg:w-5">
                    <path
                        d="m23.34 9.48-3.5-6A5.02 5.02 0 0 0 15.521 1H8.449c-1.771 0-3.426.95-4.319 2.48l-3.499 6a5 5 0 0 0 0 5.039l3.5 6a5.02 5.02 0 0 0 4.319 2.48h7.072c1.771 0 3.426-.95 4.319-2.48l3.5-6a5 5 0 0 0 0-5.039ZM11 7a1 1 0 1 1 2 0v5.5a1 1 0 1 1-2 0zm1 11a1.5 1.5 0 1 1 .001-3.001A1.5 1.5 0 0 1 12 18"
                    />
                </svg>
            </x-sidebar.sidebar-item>
            <x-sidebar.sidebar-item
                href="{{ route('warga.layanan.pengaduan.newPengaduanPage') }}"
                title="Buat Pengaduan"
                :active="request()->routeIs(['warga.layanan.pengaduan.newPengaduanPage'])"
            >
                <svg viewBox="0 0 24 24" class="w-6 fill-inherit lg:w-5" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M14 7V.46a7 7 0 0 1 2.465 1.59l3.484 3.486A6.95 6.95 0 0 1 21.54 8H15a1 1 0 0 1-1-1m8 3.485V19a5.006 5.006 0 0 1-5 5H7a5.006 5.006 0 0 1-5-5V5a5.006 5.006 0 0 1 5-5h4.515c.163 0 .324.013.485.024V7a3 3 0 0 0 3 3h6.976c.011.161.024.322.024.485M16 17a1 1 0 0 0-1-1h-2v-2a1 1 0 0 0-2 0v2H9a1 1 0 0 0 0 2h2v2a1 1 0 0 0 2 0v-2h2a1 1 0 0 0 1-1"
                    />
                </svg>
            </x-sidebar.sidebar-item>
        </ul>
    </div>

    <div class="relative" x-data="{ sideDropdown: false }">
        <button
            class="{{ $activeDropReservasi ? $activeStyle['active'] : $activeStyle['default'] }}"
            @click="sideDropdown = !sideDropdown"
            x-effect="
                document.location.pathname.split('/').includes('reservasi-jadwal-temu')
                    ? (sideDropdown = true)
                    : (sideDropdown = false)
            "
        >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 fill-inherit">
                <path
                    d="M21 7H0c0-2.757 2.243-5 5-5V1a1 1 0 0 1 2 0v1h7V1a1 1 0 1 1 2 0v1c2.757 0 5 2.243 5 5m-.162 11.82-5.829-2.292v-5.462c0-.996-.681-1.92-1.664-2.08a2 2 0 0 0-2.336 1.973v9.924a232 232 0 0 1-2.145-1.784 2.29 2.29 0 0 0-3.235.109 2.29 2.29 0 0 0 .098 3.23l1.821 1.628H24.01v-.593a5 5 0 0 0-3.171-4.653Zm-11.83-1.982V10.96c0-.7.201-1.366.538-1.96H0v6c0 2.114 1.324 3.916 3.183 4.646a4.2 4.2 0 0 1 .985-1.803 4.29 4.29 0 0 1 4.841-1.005Zm11.699-.218c.177-.511.293-1.05.293-1.62V9h-4.54c.349.613.549 1.322.549 2.067v4.099z"
                />
            </svg>
            <span
                class="absolute left-16 hidden w-full rounded-lg bg-gray-200 px-2 py-1 transition-all ease-in dark:bg-gray-700 lg:static lg:block lg:bg-transparent lg:p-0 lg:dark:bg-transparent"
            >
                <div class="title flex items-center justify-between gap-4">
                    Reservasi
                    <div class="w-6 fill-inherit lg:w-5" x-show="!sideDropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M18.71 8.21a1 1 0 0 0-1.42 0l-4.58 4.58a1 1 0 0 1-1.42 0L6.71 8.21a1 1 0 0 0-1.42 0 1 1 0 0 0 0 1.41l4.59 4.59a3 3 0 0 0 4.24 0l4.59-4.59a1 1 0 0 0 0-1.41"
                            />
                        </svg>
                    </div>
                    <div class="w-6 fill-inherit lg:w-5" x-show="sideDropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M18 15.5a1 1 0 0 1-.71-.29l-4.58-4.59a1 1 0 0 0-1.42 0l-4.58 4.59a1 1 0 0 1-1.42-1.42l4.59-4.58a3.06 3.06 0 0 1 4.24 0l4.59 4.58a1 1 0 0 1 0 1.42 1 1 0 0 1-.71.29"
                            />
                        </svg>
                    </div>
                </div>
            </span>
        </button>
        <ul x-show="sideDropdown" class="ms-3 mt-2 flex flex-col gap-2">
            <x-sidebar.sidebar-item
                href="{{ route('warga.layanan.reservasiJadwalTemu.index') }}"
                title="Reservasi"
                :active="request()->routeIs(['warga.layanan.reservasiJadwalTemu.index'])"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 fill-inherit lg:w-5">
                    <path
                        d="M24 7v1H0V7a5 5 0 0 1 5-5h1V1a1 1 0 0 1 2 0v1h8V1a1 1 0 0 1 2 0v1h1a5 5 0 0 1 5 5m0 10c0 3.86-3.141 7-7 7s-7-3.14-7-7 3.141-7 7-7 7 3.14 7 7m-5 .586-1-1V15a1 1 0 0 0-2 0v2c0 .265.105.52.293.707L17.586 19A1 1 0 0 0 19 17.586M8 17a8.98 8.98 0 0 1 3.349-7H0v9a5 5 0 0 0 5 5h6.349A8.98 8.98 0 0 1 8 17"
                    />
                </svg>
            </x-sidebar.sidebar-item>
            <x-sidebar.sidebar-item
                href="{{ route('warga.layanan.reservasiJadwalTemu.newReservasiJadwalTemuPage') }}"
                title="Buat Reservasi"
                :active="request()->routeIs(['warga.layanan.reservasiJadwalTemu.newReservasiJadwalTemuPage'])"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 fill-inherit lg:w-5">
                    <path
                        d="M24 8H0V7c0-2.757 2.243-5 5-5h1V1a1 1 0 1 1 2 0v1h8V1a1 1 0 1 1 2 0v1h1c2.757 0 5 2.243 5 5zM10 22.545c0-.892.187-1.753.535-2.545H6a1 1 0 1 1 0-2l5.92.001L13.921 16H6a1 1 0 1 1 0-2h9.922l2.741-2.741A4.27 4.27 0 0 1 21.702 10H0v9c0 2.757 2.243 5 5 5h5zm10.077-9.872a2.299 2.299 0 0 1 3.25 3.25L16.52 22.73A4.33 4.33 0 0 1 13.455 24H12v-1.455c0-1.15.457-2.252 1.27-3.065z"
                    />
                </svg>
            </x-sidebar.sidebar-item>
        </ul>
    </div>
@endsection
