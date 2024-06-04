{{-- extend to layouts/app --}}
@extends('layouts.sidebar.rw-sidebar')

@push('style')
@endpush

{{-- content --}}
@section('content')
    <section class="container relative mx-auto mb-8 mt-7 px-4" x-data="{ modalOpen: false }">
        <div class="relative sm:flex sm:items-center sm:justify-between">
            <div class="">
                <div class="flex items-center gap-x-3">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white">Pengumuman</h2>
                    <span
                        class="rounded-full bg-blue-100 px-3 py-1 text-xs text-blue-600 dark:bg-gray-800 dark:text-blue-400">
                        {{ $count }} Pengumuman
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-full bg-green-100 px-3 py-1 dark:bg-gray-800">
                        <p class="text-xs text-green-600 dark:text-green-400">{{ $published }} published</p>
                        <span class="relative flex h-3 w-3 items-center justify-center">
                            <span
                                class="absolute inline-flex h-full w-full animate-ping rounded-full bg-green-400 opacity-75 duration-700"></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full bg-green-500"></span>
                        </span>
                    </span>
                </div>
                @if ($pengumumanInstances->sortByDesc('diperbarui_pada')->first())
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                        Data ini terakhir diupdate
                        {{ $pengumumanInstances->sortByDesc('diperbarui_pada')->first()?->getDiperbaruiPada()->diffForHumans(null, true) }}
                        yang lalu
                    </p>
                @else
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                        Masih belum ada pengumuman yang dibagikan
                    </p>
                @endif
            </div>
            <div class="mt-4 flex w-fit items-center gap-x-3" x-data="{ modalOpen: false }">
                <button id="addButton" @click="modalOpen = !modalOpen"
                    class="flex shrink-0 items-center justify-center gap-x-2 text-nowrap rounded-lg bg-blue-500 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-500 sm:w-auto"
                    onclick="window.utils.Request.actionRequest('{{ route('rw.manage.pengumuman.new') }}', '#addModal', '#addModalForm',true)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <span>Tambah Pengumuman</span>
                </button>
                <div id="addModal" x-show="modalOpen" class="fixed inset-0 z-40 overflow-y-auto"
                    aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none">
                    <div
                        class="flex min-h-screen items-end justify-center px-4 text-center sm:block sm:p-0 md:items-center">
                        <div @click="modalOpen = false" x-show="modalOpen"
                            x-transition:enter="transform transition duration-300 ease-out"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="transform transition duration-200 ease-in"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                            class="fixed inset-0 bg-gray-500/40 transition-opacity dark:bg-gray-800/40" aria-hidden="true">
                        </div>

                        <div x-show="modalOpen" x-transition:enter="transform transition duration-300 ease-out"
                            x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                            x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
                            x-transition:leave="transform transition duration-200 ease-in"
                            x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
                            x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                            class="my-20 inline-block w-full max-w-xl transform overflow-hidden rounded-lg bg-white p-8 text-left shadow-xl transition-all dark:bg-gray-800 2xl:max-w-2xl">
                            <div class="flex items-center justify-between space-x-4">
                                <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100">Tambah Pengumuman</h1>

                                <button @click="modalOpen = false"
                                    class="text-gray-600 hover:text-gray-700 focus:outline-none dark:text-gray-400 dark:hover:text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                            </div>

                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Tambah pengumuman ke dalam sistem
                            </p>

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                            <form class="mt-5" id="addModalForm">
                                @csrf
                                <x-form.input-form title="Judul Pengumuman" key="judul" type="text"
                                    placeholder="Judul Pengumuman" class="col-span-2" />
                                <x-form.textarea-input-form title="Deskripsi" key="konten"
                                    placeholder="Deskripsi dari Pengumuman" />
                                <x-form.input-image id="imageadd" title="Gambar" key="image" placeholder="Gambar" />
                                <div class="mt-6 flex justify-between">
                                    <p class="text-xs text-gray-200 dark:text-gray-400">
                                        Note: Pastikan semua sudah terisi dengan benar
                                    </p>
                                    <button type="submit"
                                        class="transform rounded-md bg-blue-500 px-3 py-2 text-sm capitalize tracking-wide text-white transition-colors duration-200 hover:bg-blue-600 focus:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700">
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
                class="inline-flex divide-x overflow-hidden rounded-lg border bg-white dark:divide-gray-700 dark:border-gray-700 dark:bg-gray-900 rtl:flex-row-reverse">
                <button id="filter-all" onclick="window.utils.Request.filterRequest({'status': ''})"
                    x-effect="
                        let params = new URLSearchParams(window.location.search)
                        ;(params.has('filters[status]') && params.get('filters[status]') == '') ||
                        ! params.has('filters[status]')
                            ? $('#filter-all').addClass('!text-blue-400')
                            : $('#filter-all').removeClass('!text-blue-400')
                    "
                    class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 sm:text-sm">
                    semua
                </button>

                @foreach (\App\Enums\Pengumuman\PengumumanStatusEnum::getValues() as $key => $value)
                    <button id="filter-{{ $key }}"
                        onclick="window.utils.Request.filterRequest({'status': '{{ $value }}'})"
                        x-effect="let params = new URLSearchParams(window.location.search); params.has('filters[status]') && params.get('filters[status]') == '{{ $value }}' ? $('#filter-{{ $key }}').addClass('!text-blue-400') : $('#filter-{{ $key }}').removeClass('!text-blue-400')"
                        class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 sm:text-sm">
                        {{ $value }}
                    </button>
                @endforeach
            </div>

            <div id="search" class="relative mt-4 flex items-center md:mt-0" x-data="{ search: '' }">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="mx-3 h-5 w-5 text-gray-400 dark:text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </span>

                <input x-model="search" @keyup.enter="window.utils.Request.searchRequest(search)" type="text"
                    placeholder="Press Enter to Search"
                    class="block rounded-lg border border-gray-200 bg-white py-1.5 pl-11 pr-5 text-gray-700 placeholder-gray-400/70 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300 md:w-80 lg:w-full rtl:pl-5 rtl:pr-11" />
            </div>
        </div>

        <div class="mt-6 flex flex-col">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border-t-2 border-gray-200 dark:border-gray-700">
                        <div class="heading mb-4"></div>
                        <div class="Wraper flex flex-col gap-4">
                            @foreach ($pengumumanInstances as $pengumuman)
                                <div
                                    class="card overflow-hidden rounded-lg border border-gray-200 pt-4 shadow-sm ring-4 ring-gray-200/10 dark:border-gray-800 dark:ring-gray-700/10">
                                    <div class="card-heading mb-1 flex items-start justify-between px-8">
                                        <div class="status">
                                            @if ($pengumuman->getStatus() == App\Enums\Pengumuman\PengumumanStatusEnum::DRAFT->value)
                                                <span
                                                    class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-2 py-1 dark:bg-gray-800">
                                                    <span
                                                        class="relative inline-flex h-2 w-2 rounded-full bg-blue-500"></span>
                                                    <p class="text-[9px] text-blue-600 dark:text-blue-400">draft</p>
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2 py-1 dark:bg-gray-800">
                                                    <span class="relative flex h-2 w-2 items-center justify-center">
                                                        <span
                                                            class="absolute inline-flex h-full w-full animate-ping rounded-full bg-green-400 opacity-75 duration-700"></span>
                                                        <span
                                                            class="relative inline-flex h-2 w-2 rounded-full bg-green-500"></span>
                                                    </span>
                                                    <p class="text-[9px] text-green-600 dark:text-green-400">publish</p>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="action-dropdown relative" x-data="{ actionModalOpen: false }">
                                            <button class="mt-1 h-5 w-5 dark:fill-gray-100"
                                                x-on:click="actionModalOpen = !actionModalOpen"
                                                @keydown.escape="actionModalOpen = false">
                                                <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1"
                                                    viewBox="0 0 24 24" class="">
                                                    <path
                                                        d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0m0 22C6.486 22 2 17.514 2 12S6.486 2 12 2s10 4.486 10 10-4.486 10-10 10m1.5-15.5a1.5 1.5 0 1 1-3.001-.001A1.5 1.5 0 0 1 13.5 6.5m0 11a1.5 1.5 0 1 1-3.001-.001 1.5 1.5 0 0 1 3.001.001m0-5.5a1.5 1.5 0 1 1-3.001-.001A1.5 1.5 0 0 1 13.5 12" />
                                                </svg>
                                            </button>
                                            <div class="absolute right-8 top-0 divide-y overflow-hidden rounded-lg border bg-white dark:divide-gray-700 dark:border-gray-700"
                                                style="display: none" x-show="actionModalOpen"
                                                @click.away="actionModalOpen = false" x-data="{
                                                    modalEditOpen: false,
                                                    modalDeleteOpen: false,
                                                    modalShareOpen: false,
                                                }">
                                                <div class="relative">
                                                    <a id="detailButton"
                                                        class="inline-flex w-full items-center gap-2 px-4 pb-2 pt-3 hover:bg-gray-100 dark:hover:bg-gray-800"
                                                        target="_blank"
                                                        href="{{ route('informasi.pengumuman.detail', [$pengumuman->getIdPengumuman()]) }}">
                                                        <div class="icon w-3 fill-gray-500">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                                <path
                                                                    d="M23.271 9.419C21.72 6.893 18.192 2.655 12 2.655S2.28 6.893.729 9.419a4.91 4.91 0 0 0 0 5.162C2.28 17.107 5.808 21.345 12 21.345s9.72-4.238 11.271-6.764a4.91 4.91 0 0 0 0-5.162m-1.705 4.115C20.234 15.7 17.219 19.345 12 19.345S3.766 15.7 2.434 13.534a2.92 2.92 0 0 1 0-3.068C3.766 8.3 6.781 4.655 12 4.655s8.234 3.641 9.566 5.811a2.92 2.92 0 0 1 0 3.068" />
                                                                <path
                                                                    d="M12 7a5 5 0 1 0 5 5 5.006 5.006 0 0 0-5-5m0 8a3 3 0 1 1 3-3 3 3 0 0 1-3 3" />
                                                            </svg>
                                                        </div>
                                                        <p
                                                            class="me-4 text-xs font-medium text-gray-600 dark:text-gray-400">
                                                            Detail
                                                        </p>
                                                    </a>
                                                </div>
                                                <button id="shareButton"
                                                    class="inline-flex w-full items-center gap-2 px-4 pb-2 pt-2 hover:bg-gray-100 dark:hover:bg-gray-800"
                                                    @click="modalShareOpen = !modalShareOpen" type="button"
                                                    onclick="(function () {appendShareModal('{{ $pengumuman->getIdPengumuman() }}','{{ $pengumuman->getJudul() }}','{{ $pengumuman->getStatus() }}',event);window.utils.Request.actionRequest(`{{ route('rw.manage.pengumuman.changeStatus') }}`, '#shareModal', '#shareModalForm')})()"
                                                    x-transition:enter="duration-300 ease-out"
                                                    x-transition:enter-start="opacity-0"
                                                    x-transition:enter-end="opacity-100"
                                                    x-transition:leave="transform transition duration-200 ease-in"
                                                    x-transition:leave-start="opacity-100"
                                                    x-transition:leave-end="opacity-0">
                                                    <div class="icon w-3 fill-green-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                            @if ($pengumuman->getStatus() == 'publish')
                                                                <path
                                                                    d="M16 12v2c0 1.103-.897 2-2 2h-4c-1.103 0-2-.897-2-2v-2H0v9c0 1.654 1.346 3 3 3h18c1.654 0 3-1.346 3-3v-9zm6 9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-7h4c0 2.206 1.794 4 4 4h4c2.206 0 4-1.794 4-4h4zM10.586 10.414 7.293 7.121l1.414-1.414L11 8V0h2v8l2.293-2.293 1.414 1.414-3.293 3.293c-.39.39-.902.585-1.414.585s-1.024-.195-1.414-.585" />
                                                            @else
                                                                <path
                                                                    d="M16 12v2c0 1.103-.897 2-2 2h-4c-1.103 0-2-.897-2-2v-2H0v9c0 1.654 1.346 3 3 3h18c1.654 0 3-1.346 3-3v-9zm6 9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-7h4c0 2.206 1.794 4 4 4h4c2.206 0 4-1.794 4-4h4zM8.707 5.293 7.293 3.879 10.586.586a2.003 2.003 0 0 1 2.828 0l3.293 3.293-1.414 1.414L13 3v8h-2V3z" />
                                                            @endif
                                                        </svg>
                                                    </div>
                                                    <p class="me-4 text-xs font-medium text-green-600 dark:text-green-400">
                                                        @if ($pengumuman->getStatus() == 'publish')
                                                            Draf
                                                        @else
                                                            Publish
                                                        @endif
                                                    </p>
                                                </button>
                                                <button id="editButton"
                                                    class="inline-flex w-full items-center gap-2 px-4 pb-2 pt-2 hover:bg-gray-100 dark:hover:bg-gray-800"
                                                    @click="modalEditOpen = !modalEditOpen" type="button"
                                                    onclick="(function () {appendUpdateModal({{ $pengumuman }},event);window.utils.Request.actionRequest(`{{ route('rw.manage.pengumuman.update') }}`, '#editModal', '#editModalForm',true)})()"
                                                    x-transition:enter="duration-300 ease-out"
                                                    x-transition:enter-start="opacity-0"
                                                    x-transition:enter-end="opacity-100"
                                                    x-transition:leave="transform transition duration-200 ease-in"
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
                                                    <p class="me-4 text-xs font-medium text-blue-600 dark:text-blue-400">
                                                        Edit
                                                    </p>
                                                </button>
                                                <button id="deleteButton" @click="modalDeleteOpen = !modalDeleteOpen"
                                                    onclick="(function (){appendDeleteModal('{{ $pengumuman->getIdPengumuman() }}','{{ $pengumuman->getJudul() }}',event);window.utils.Request.actionRequest(`{{ route('rw.manage.pengumuman.delete') }}`, '#deleteModal', '#deleteModalForm')})()"
                                                    class="inline-flex w-full items-center gap-2 border-b-2 px-4 pb-3 pt-2 hover:bg-gray-100 dark:hover:bg-gray-800">
                                                    <div class="icon w-3 fill-rose-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                            <path
                                                                d="M21 4h-3.1A5.01 5.01 0 0 0 13 0h-2a5.01 5.01 0 0 0-4.9 4H3a1 1 0 0 0 0 2h1v13a5.006 5.006 0 0 0 5 5h6a5.006 5.006 0 0 0 5-5V6h1a1 1 0 0 0 0-2M11 2h2a3.01 3.01 0 0 1 2.829 2H8.171A3.01 3.01 0 0 1 11 2m7 17a3 3 0 0 1-3 3H9a3 3 0 0 1-3-3V6h12Z" />
                                                            <path
                                                                d="M10 18a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1m4 0a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1" />
                                                        </svg>
                                                    </div>
                                                    <p class="dark:text-rosse-400 me-4 text-xs font-medium text-rose-500">
                                                        Delete
                                                    </p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body mb-8 w-3/4 px-8">
                                        <h1 class="text-xl dark:text-gray-100">{{ $pengumuman->getJudul() }}</h1>
                                        <p class="text-sm dark:text-gray-400">{{ $pengumuman->getKonten() }}</p>
                                    </div>
                                    <div
                                        class="card-footer flex justify-between border-t bg-gray-50 px-8 py-2 dark:border-gray-800 dark:bg-gray-800">
                                        <p class="text-xs text-gray-300 dark:text-gray-600">
                                            Created at
                                            {{ date('d/m/y', strtotime($pengumuman->getDibuatPada())) }}
                                        </p>
                                        <p class="text-xs text-gray-400 dark:text-gray-500">
                                            Last Updated at
                                            {{ date('d/m/y H:i', strtotime($pengumuman->getDiperbaruiPada())) }}
                                        </p>
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

@push('scripts')
    <script type="module">
        $(document).ready(() => {
            let reg = new RegExp('[?&]q=([^&#]*)', 'i');
            let queryString = reg.exec(document.location);
            if (queryString != null) {
                let search = decodeURIComponent(queryString[1].replace(/\+/g, ' '));
                $('#search input').val(search);
            }
        });
    </script>
    <script>
        function appendShareModal(id_pengumuman, judul, status, event) {
            let modalHeader, message, confirmation;
            if (status == 'publish') {
                modalHeader = 'Pindahkan ke Draft'
                message = 'Pindahkan pengumuman ke Draf'
                confirmation = 'Memindahkan Ke Draft Untuk'
            } else {
                modalHeader = 'Publish Pengumuman'
                message = 'Publish pengumuman'
                confirmation = 'Mempublish'
            }

            const modalShareElemen = /*html*/ `
               <div id="shareModal" x-show="modalShareOpen" class="fixed inset-0 z-40 overflow-y-auto"
                aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                    <div x-cloak @click="()=>{modalShareOpen = false;deleteModal('#shareModal')}" x-show="modalShareOpen"
                        x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        class="fixed inset-0 transition-opacity bg-gray-500/40 dark:bg-gray-800/40" aria-hidden="true"></div>

                    <div x-cloak x-show="modalShareOpen" x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="transition ease-in duration-200 transform"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-gray-800 rounded-lg shadow-xl 2xl:max-w-2xl">
                        <div class="flex items-center justify-between space-x-4">
                            <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100">${modalHeader}</h1>

                            <button @click="()=>{modalShareOpen = false;deleteModal('#shareModal')}"
                                class="text-gray-600 dark:text-gray-400 focus:outline-none hover:text-gray-700 dark:hover:text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </div>

                        <p class="mt-2 text-sm text-gray-500 ">
                         ${message} 
                        </p>

                        <form class="mt-5" id="shareModalForm">
                            @csrf
                            <input type="text" name="id_pengumuman" value="${id_pengumuman}" hidden>
                            <h1 class="text-xl text-wrap dark:text-gray-100 tracking-wide">Apakah Anda Yakin ${confirmation} Pengumuman <span
                                    class="font-semibold text-green-600 underline underline-offset-8">${judul}</span> </h1>
                            <div class="flex justify-end mt-6">
                                <button type="submit"
                                    class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-500 rounded-md dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700 hover:bg-blue-600 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                    Publish Pengumuman
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                                                                                   `
            $(modalShareElemen).insertAfter($(event.target).closest('#shareButton'))
        }


        function appendDeleteModal(id_pengumuman, judul, event) {
            const modalDeleteElemen = /*html*/ `
               <div id="deleteModal" x-show="modalDeleteOpen" class="fixed inset-0 z-40 overflow-y-auto"
                aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                    <div x-cloak @click="()=>{modalDeleteOpen = false;deleteModal('#deleteModal')}" x-show="modalDeleteOpen"
                        x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        class="fixed inset-0 transition-opacity bg-gray-500/40 dark:bg-gray-800/40" aria-hidden="true"></div>

                    <div x-cloak x-show="modalDeleteOpen" x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="transition ease-in duration-200 transform"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-gray-800 rounded-lg shadow-xl 2xl:max-w-2xl">
                        <div class="flex items-center justify-between space-x-4">
                            <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100">Delete Pengumuman</h1>

                            <button @click="()=>{modalDeleteOpen = false;deleteModal('#deleteModal')}"
                                class="text-gray-600 dark:text-gray-400 focus:outline-none hover:text-gray-700 dark:hover:text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </div>

                        <p class="mt-2 text-sm text-gray-500 ">
                            Menghapus pengumuman dari sistem
                        </p>

                        <form class="mt-5" id="deleteModalForm">
                            @csrf
                            <input type="text" name="id_pengumuman" value="${id_pengumuman}" hidden>
                            <h1 class="text-xl text-wrap dark:text-gray-100 tracking-wide">Apakah Anda Yakin Menghapus <span
                                    class="font-semibold text-rose-600 underline underline-offset-8">${judul}</span> </h1>
                            <div class="flex justify-end mt-6">
                                <button type="submit"
                                    class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-500 rounded-md dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700 hover:bg-blue-600 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                    Delete Pengumuman
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                                                                                   `
            $(modalDeleteElemen).insertAfter($(event.target).closest('#deleteButton'))

        }

        function appendUpdateModal(pengumuman, event) {
            const modalEditElemen = /*html*/ `
                       <div id="editModal" x-show="modalEditOpen" class="fixed inset-0 z-40 overflow-y-auto" aria-labelledby="modal-title"
            role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                <div x-cloak @click="()=>{modalEditOpen = false;deleteModal('#editModal')}" x-show="modalEditOpen"
                    x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 transition-opacity  bg-gray-500/40 dark:bg-gray-800/40" aria-hidden="true"></div>

                <div x-cloak x-show="modalEditOpen" x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-gray-800 rounded-lg shadow-xl 2xl:max-w-2xl">
                    <div class="flex items-center justify-between space-x-4">
                        <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100">Edit Pengaduan</h1>

                        <button @click="()=>{modalEditOpen = false;deleteModal('#editModal')}"
                            class="text-gray-600 dark:text-gray-400 focus:outline-none hover:text-gray-700 dark:hover:text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>

                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Edit Pengaduan di dalam sistem
                    </p>

                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach

                    <form enctype="multipart/form-data" class="mt-5" id="editModalForm"
                        action="{{ route('rw.manage.pengaduan.update') }}" method="post">
                        @csrf
                        <input type="text" name="id_pengumuman" value="${pengumuman.id_pengumuman}" hidden>
                        <x-form.input-form title="Judul Pengumuman" key="judul" type="text" placeholder="Judul Pengumuman"
                            class="col-span-2" value="${pengumuman.judul}" />
                        <x-form.textarea-input-form title="Konten" key="konten" placeholder="Deskripsi dari pengumuman"
                            value="${pengumuman.konten}" />
                        <x-form.input-image id="imageadd" title="Gambar" key="image" placeholder="Gambar"
                            value="${pengumuman.image_url}" />

                        <div class="flex justify-between mt-6">
                            <p class="text-xs text-gray-200 dark:text-gray-400">Note: Pastikan semua sudah terisi dengan benar
                            </p>
                            <button type="submit"
                                class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-500 rounded-md dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700 hover:bg-blue-600 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                Save Pengumuman
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
                   `
            $(modalEditElemen).insertAfter($(event.target).closest('#editButton'))
        }

        function deleteModal(selector) {
            $(selector).ready(() => {
                $(selector).remove()
            })
        }
    </script>
@endpush
