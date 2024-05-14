{{-- extend to layouts/app --}}
@extends('layouts.sidebar.rw-sidebar')

@push('style')
@endpush

{{-- content --}}
@section('content')
    <section class="container px-4 mt-7 mb-8 mx-auto relative" x-data="{ modalOpen: false }">
        <div class="relative sm:flex sm:items-center sm:justify-between ">
            <div class="">
                <div class="flex items-center gap-x-3">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white">Pengumuman</h2>
                    <span
                        class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">{{ $count }}
                        Pengumuman</span>
                    <span class="px-3 py-1 inline-flex gap-2 items-center bg-green-100 rounded-full dark:bg-gray-800 ">
                        <p class="text-xs text-green-600 dark:text-green-400">9 published</p>
                        <span class="relative flex h-3 w-3 items-center justify-center">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75 duration-700"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                        </span>
                    </span>
                </div>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Data ini terakhir di update 12 menit yang lalu.</p>
            </div>

            <div class="flex items-center mt-4 gap-x-3 w-fit" x-data="{ modalOpen: false }">

                <button id="addButton" @click="modalOpen = !modalOpen"
                    class=" flex items-center justify-center text-nowrap px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg shrink-0 sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600"
                    onclick="request('{{ route('rw.manage.pengumuman.new') }}', '#addModal', '#addModalForm')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <span>Add Pengumuman</span>
                </button>
                <div id="addModal" x-show="modalOpen" class="fixed inset-0 z-50 overflow-y-auto"
                    aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
                    <div
                        class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                        <div @click="modalOpen = false" x-show="modalOpen"
                            x-transition:enter="transition ease-out duration-300 transform"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-200 transform"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                            class="fixed inset-0 transition-opacity bg-gray-500/40 dark:bg-gray-800/40" aria-hidden="true">
                        </div>

                        <div x-show="modalOpen" x-transition:enter="transition ease-out duration-300 transform"
                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave="transition ease-in duration-200 transform"
                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-gray-800 rounded-lg shadow-xl 2xl:max-w-2xl">
                            <div class="flex items-center justify-between space-x-4">
                                <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100 ">Add Pengumuman</h1>

                                <button @click="modalOpen = false"
                                    class="text-gray-600 dark:text-gray-400 focus:outline-none hover:text-gray-700 dark:hover:text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                            </div>

                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Add pengumuman ke dalam sistem
                            </p>

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                            <form class="mt-5" id="addModalForm">
                                @csrf
                                <x-form.input-form title="Judul Pengumuman" key="judul" type="text"
                                    placeholder="Gotong Royong Warga" class="col-span-2" />
                                <x-form.textarea-input-form title="Konten" key="konten"
                                    placeholder="dimas anjay mabar lagi main bersama bocah silkroach" />
                                <x-form.input-image id="imageadd" title="Gambar" key="image" placeholder="Gambar" />
                                <div class="flex justify-between mt-6">
                                    <p class="text-xs text-gray-200 dark:text-gray-400">Note: Pastikan semua sudah terisi
                                        dengan benar</p>
                                    <button type="click"
                                        class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-500 rounded-md dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700 hover:bg-blue-600 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                        Tambah Pengumuman
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 md:flex md:items-center md:justify-between">
            <div
                class="inline-flex overflow-hidden bg-white border divide-x rounded-lg dark:bg-gray-900 rtl:flex-row-reverse dark:border-gray-700 dark:divide-gray-700">

                <button id="filter-all" onclick="window.utils.Request.filterRequest({'status': ''})"
                    x-effect="let params = new URLSearchParams(window.location.search); (params.has('filters[status]') && params.get('filters[status]') == '') || !params.has('filters[status]') ? $('#filter-all').addClass('!text-blue-400') : $('#filter-all').removeClass('!text-blue-400')"
                    class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                    semua
                </button>

                @foreach (\App\Enums\Pengumuman\PengumumanStatusEnum::getValues() as $key => $value)
                    <button id="filter-{{ $key }}"
                        onclick="window.utils.Request.filterRequest({'status': '{{ $value }}'})"
                        x-effect="let params = new URLSearchParams(window.location.search); params.has('filters[status]') && params.get('filters[status]') == '{{ $value }}' ? $('#filter-{{ $key }}').addClass('!text-blue-400') : $('#filter-{{ $key }}').removeClass('!text-blue-400')"
                        class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                        {{ $value }}
                    </button>
                @endforeach

            </div>

            <div id="search" class="relative flex items-center mt-4 md:mt-0" x-data="{ search: '' }">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </span>

                <input x-model="search" @keyup.enter="window.utils.Request.searchRequest(search)" type="text"
                    placeholder="Search"
                    class="block lg:w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
            </div>
        </div>

        <div class="flex flex-col mt-6 ">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border-t-2 border-gray-200 dark:border-gray-700">
                        <div class="heading mb-4">

                        </div>
                        <div class="Wraper flex flex-col gap-4">
                            @foreach ($pengumumanInstances as $pengumuman)
                                <div
                                    class="card pt-4 border border-gray-200 ring-4 shadow-sm ring-gray-200/10 dark:border-gray-800 dark:ring-gray-700/10 rounded-lg overflow-hidden">
                                    <div class="card-heading mb-1 px-8 flex justify-between items-start">
                                        <div class="status">
                                            @if ($pengumuman->getStatus() == App\Enums\Pengumuman\PengumumanStatusEnum::DRAFT->value)
                                                <span
                                                    class="px-2 py-1 inline-flex gap-1 items-center bg-blue-100 rounded-full dark:bg-gray-800 ">
                                                    <span
                                                        class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                                                    <p class="text-[9px] text-blue-600 dark:text-blue-400">draft</p>
                                                </span>
                                            @else
                                                <span
                                                    class="px-2 py-1 inline-flex gap-1 items-center bg-green-100 rounded-full dark:bg-gray-800 ">
                                                    <span class="relative flex h-2 w-2 items-center justify-center">
                                                        <span
                                                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75 duration-700"></span>
                                                        <span
                                                            class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                                    </span>
                                                    <p class="text-[9px] text-green-600 dark:text-green-400">publish</p>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="action-dropdown relative" x-data="{ actionModalOpen: false }">

                                            <button class="dark:fill-gray-100 h-5 w-5 mt-1"
                                                x-on:click="actionModalOpen = !actionModalOpen"
                                                @keydown.escape="actionModalOpen = false">
                                                <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1"
                                                    viewBox="0 0 24 24" class="">
                                                    <path
                                                        d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0m0 22C6.486 22 2 17.514 2 12S6.486 2 12 2s10 4.486 10 10-4.486 10-10 10m1.5-15.5a1.5 1.5 0 1 1-3.001-.001A1.5 1.5 0 0 1 13.5 6.5m0 11a1.5 1.5 0 1 1-3.001-.001 1.5 1.5 0 0 1 3.001.001m0-5.5a1.5 1.5 0 1 1-3.001-.001A1.5 1.5 0 0 1 13.5 12" />
                                                </svg>
                                            </button>
                                            <div class="absolute right-8 top-0 rounded-lg border dark:border-gray-700 overflow-hidden divide-y dark:divide-gray-700"
                                                style="display: none;" x-show="actionModalOpen"
                                                @click.away="actionModalOpen = false">
                                                <div class="relative">
                                                    <a id="detailButton"
                                                        class="inline-flex gap-2 px-4 pt-3 pb-2  hover:bg-gray-100 dark:hover:bg-gray-800 w-full items-center"
                                                        target="_blank"
                                                        href="{{ route('informasi.pengumuman.index', ['#pengumuman-' . $pengumuman->getIdPengumuman()]) }}">
                                                        <div class="icon w-3 fill-gray-500">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                                <path
                                                                    d="M23.271 9.419C21.72 6.893 18.192 2.655 12 2.655S2.28 6.893.729 9.419a4.91 4.91 0 0 0 0 5.162C2.28 17.107 5.808 21.345 12 21.345s9.72-4.238 11.271-6.764a4.91 4.91 0 0 0 0-5.162m-1.705 4.115C20.234 15.7 17.219 19.345 12 19.345S3.766 15.7 2.434 13.534a2.92 2.92 0 0 1 0-3.068C3.766 8.3 6.781 4.655 12 4.655s8.234 3.641 9.566 5.811a2.92 2.92 0 0 1 0 3.068" />
                                                                <path
                                                                    d="M12 7a5 5 0 1 0 5 5 5.006 5.006 0 0 0-5-5m0 8a3 3 0 1 1 3-3 3 3 0 0 1-3 3" />
                                                            </svg>
                                                        </div>
                                                        <p
                                                            class="font-medium text-xs text-gray-600 dark:text-gray-400 me-4">
                                                            Detail</p>

                                                    </a>
                                                </div>
                                                <button
                                                    class="inline-flex gap-2 px-4 pt-2 pb-2  hover:bg-gray-100 dark:hover:bg-gray-800 w-full items-center"
                                                    x-transition:enter="ease-out duration-300"
                                                    x-transition:enter-start="opacity-0"
                                                    x-transition:enter-end="opacity-100"
                                                    x-transition:leave="transition ease-in duration-200 transform"
                                                    x-transition:leave-start="opacity-100"
                                                    x-transition:leave-end="opacity-0">
                                                    <div class="icon w-3 fill-blue-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                            <path
                                                                d="M18.656.93 6.464 13.122A4.97 4.97 0 0 0 5 16.657V18a1 1 0 0 0 1 1h1.343a4.97 4.97 0 0 0 3.535-1.464L23.07 5.344a3.125 3.125 0 0 0 0-4.414 3.194 3.194 0 0 0-4.414 0m3 3L9.464 16.122A3.02 3.02 0 0 1 7.343 17H7v-.343a3.02 3.02 0 0 1 .878-2.121L20.07 2.344a1.15 1.15 0 0 1 1.586 0 1.123 1.123 0 0 1 0 1.586" />
                                                            <path
                                                                d="M23 8.979a1 1 0 0 0-1 1V15h-4a3 3 0 0 0-3 3v4H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3h9.042a1 1 0 0 0 0-2H5a5.006 5.006 0 0 0-5 5v14a5.006 5.006 0 0 0 5 5h11.343a4.97 4.97 0 0 0 3.536-1.464l2.656-2.658A4.97 4.97 0 0 0 24 16.343V9.979a1 1 0 0 0-1-1m-4.535 12.143a3 3 0 0 1-1.465.8V18a1 1 0 0 1 1-1h3.925a3 3 0 0 1-.8 1.464Z" />
                                                        </svg>
                                                    </div>
                                                    <p class="font-medium text-xs text-blue-600 dark:text-blue-400 me-4">
                                                        Edit</p>
                                                </button>
                                                <button
                                                    class="inline-flex gap-2 px-4 pb-3 pt-2 hover:bg-gray-100 dark:hover:bg-gray-800 w-full border-b-2 items-center">
                                                    <div class="icon w-3 fill-rose-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                            <path
                                                                d="M21 4h-3.1A5.01 5.01 0 0 0 13 0h-2a5.01 5.01 0 0 0-4.9 4H3a1 1 0 0 0 0 2h1v13a5.006 5.006 0 0 0 5 5h6a5.006 5.006 0 0 0 5-5V6h1a1 1 0 0 0 0-2M11 2h2a3.01 3.01 0 0 1 2.829 2H8.171A3.01 3.01 0 0 1 11 2m7 17a3 3 0 0 1-3 3H9a3 3 0 0 1-3-3V6h12Z" />
                                                            <path
                                                                d="M10 18a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1m4 0a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1" />
                                                        </svg>
                                                    </div>
                                                    <p class="font-medium text-xs text-rose-500 dark:text-rosse-400 me-4">
                                                        Delete</p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body mb-8 w-3/4 px-8">
                                        <h1 class="text-xl dark:text-gray-100">{{ $pengumuman->getJudul() }}</h1>
                                        <p class="text-sm dark:text-gray-400">{{ $pengumuman->getKonten() }}</p>
                                    </div>
                                    <div
                                        class="card-footer bg-gray-50 dark:bg-gray-800 border-t dark:border-gray-800 px-8 py-2 flex justify-between">
                                        <p class="text-xs text-gray-300 dark:text-gray-600">Created at
                                            {{ date('d/m/y', strtotime($pengumuman->getDibuatPada())) }}</p>
                                        <p class="text-xs text-gray-400 dark:text-gray-500">Last Updated at
                                            {{ date('d/m/y H:i', strtotime($pengumuman->getDiperbaruiPada())) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{ $pengumumanInstances->links('elements.pagination') }}

    </section>
@endsection
