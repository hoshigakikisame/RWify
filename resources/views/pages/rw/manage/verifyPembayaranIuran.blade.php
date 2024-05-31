{{-- extend to layouts/app --}}
@extends('layouts.sidebar.rw-sidebar')

{{-- content --}}
@section('content')
    <section class="container relative mx-auto mb-8 mt-7 px-4" x-data="{ modalOpen: false }">
        <div class="sm:flex sm:items-center sm:justify-between border-b pb-2">
            <div>
                <div class="flex items-center gap-x-3">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white">
                        Mengelola Iuran
                    </h2>
                    <span
                        class="rounded-full bg-blue-100 px-3 py-1 text-xs text-blue-600 dark:bg-gray-800 dark:text-blue-400">
                        {{ $count }} Iuran Belum Terkelola
                    </span>
                </div>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                    Kelola iuran warga yang sudah membayar dengan form dibawah
                </p>
            </div>
        </div>
        <div class="py-4 px-2">
            <div class="header">
                <h3 class="text-lg font-medium text-gray-800 dark:text-white">
                    Pencarian Iuran Terbayar
                </h3>
                <p class="text-xs text-gray-500 dark:text-gray-30">
                    Cari iuran yang belum terverifikasi
                </p>
            </div>
            <div class="search mt-4 mb-4">
                <div class="">
                    <div class="grid grid-cols-9 gap-2 text-gray-400">
                        <label for="search" class="text-xs font-Poppins font-medium col-span-3">Search</label>
                        <label for="status" class="text-xs font-Poppins font-medium col-span-2">Status</label>
                        <label for="tanggal_bayar" class="text-xs font-Poppins font-medium col-span-2">Date</label>
                    </div>
                    <div class="grid grid-cols-9 divide-x mt-2 divide-gray-300 dark:divide-gray-500">
                        <input id="search" type="text"
                            class="border-t border-b border-e-0 border-s border-gray-300 dark:border-gray-500 dark:bg-gray-800 rounded-s-md focus:outline-none focus:ring-0 col-span-3 dark:text-gray-300 dark:placeholder-gray-300"
                            placeholder="Search" />
                        <select name="status" id="status"
                            class="border focus:outline-none dark:bg-gray-800 dark:text-gray-300 focus:ring-0 col-span-2"
                            aria-placeholder="Status">
                            <option value="">All</option>
                            <option value="verified">Terverifikasi</option>
                            <option value="unverified">Belum Terverifikasi</option>
                        </select>
                        <input id="tanggal_bayar" type="date"
                            class="border focus:outline-none dark:bg-gray-800 dark:text-gray-300 focus:ring-0 col-span-2"
                            placeholder="Date" />
                        <button onclick="applyFilter()"
                            class="flex shrink-0 items-center justify-center gap-x-2 text-nowrap bg-blue-500 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-500 sm:w-auto fill-white">
                            <div class="w-4 h-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 513.749 513.749" xml:space="preserve">
                                    <path
                                        d="m504.352 459.061-99.435-99.477c74.402-99.427 54.115-240.344-45.312-314.746S119.261-9.277 44.859 90.15-9.256 330.494 90.171 404.896c79.868 59.766 189.565 59.766 269.434 0l99.477 99.477c12.501 12.501 32.769 12.501 45.269 0s12.501-32.769 0-45.269zm-278.635-73.365c-88.366 0-160-71.634-160-160s71.634-160 160-160 160 71.634 160 160c-.094 88.326-71.673 159.906-160 160" />
                                </svg>
                            </div>
                            <h1>Search</h1>
                        </button>
                        <button
                            class="w-1/2 flex shrink-0 items-center gap-x-2 text-nowrap justify-center bg-rose-500 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 hover:bg-rose-600 dark:bg-rose-600 dark:hover:bg-rose-500 sm:w-auto fill-white rounded-e-md">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512.021 512.021" xml:space="preserve"
                                class="w-4 h-4">
                                <path
                                    d="M301.258 256.01 502.645 54.645c12.501-12.501 12.501-32.769 0-45.269s-32.769-12.501-45.269 0L256.01 210.762 54.645 9.376c-12.501-12.501-32.769-12.501-45.269 0s-12.501 32.769 0 45.269L210.762 256.01 9.376 457.376c-12.501 12.501-12.501 32.769 0 45.269s32.769 12.501 45.269 0L256.01 301.258l201.365 201.387c12.501 12.501 32.769 12.501 45.269 0s12.501-32.769 0-45.269z" />
                            </svg>
                            <h1>Clear all</h1>
                        </button>
                    </div>
                </div>
            </div>
            <div class="body-wrap py-5">
                <div class="body-header">
                    <h1 class="text-gray-800 dark:text-white">
                        List Verifikasi Pembayaran
                    </h1>
                    <p class="text-xs mt-1 text-gray-500 dark:text-gray-30">
                        jumlah hasil pembayaran yang diterima {{ count($pembayaranIuranInstances) }} data
                    </p>
                </div>
                <div class="body-search mt-5">
                    @foreach ($pembayaranIuranInstances as $pembayaranIuran)
                        <div class="card bg-gray-50 pt-4 rounded-lg overflow-hidden">
                            <div class="flex py-2 border-b px-5 gap-3">
                                <div class="header pb-5 pt-2 grow flex gap-2">
                                    <div class="bg-gray-200 rounded-lg w-36 h-36 overflow-hidden">
                                        <div class="bg-indigo-100 w-full h-full" x-data="{ isOnImg: false, showImage: false }"
                                            @mouseover="isOnImg = true" @mouseleave="isOnImg = false"
                                            style="background: url({{ $pembayaranIuran->getImageUrl() }});background-size:cover">
                                            <button x-show="isOnImg" id="imageButton" @click="showImage = true"
                                                onclick="(function(){appendImageModal('{{ $pembayaranIuran->getImageUrl() }}','{{ $pembayaranIuran->getUser()->getNamaLengkap() }}',event);zoomInit()})()"
                                                class="w-full h-full backdrop-brightness-75 flex justify-center items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    class="w-8 h-8 fill-gray-50">
                                                    <path
                                                        d="M10 20a9.96 9.96 0 0 0 6.327-2.258l5.966 5.965a1 1 0 0 0 1.414-1.414l-5.966-5.965A10 10 0 1 0 10 20M7 9h2V7a1 1 0 0 1 2 0v2h2a1 1 0 0 1 0 2h-2v2a1 1 0 0 1-2 0v-2H7a1 1 0 0 1 0-2" />
                                                </svg>
                                            </button>

                                        </div>
                                    </div>
                                    <div class="text w-full h-full">
                                        <h1 class="text-xl mb-0.5 font-Poppins">
                                            {{ $pembayaranIuran->getUser()->getNamaLengkap() }}</h1>
                                        <h2 class="text-xs text-gray-600 mb-2">{{ $pembayaranIuran->getUser()->getNik() }}
                                            <h2 class="text-xs text-gray-600 mb-2">Verified Count:
                                                {{ $pembayaranIuran->getVerifiedCount() }}
                                            </h2>
                                            <p class="text-sm text-gray-700">{{ $pembayaranIuran->getKeterangan() }}</p>
                                    </div>
                                </div>

                            </div>
                            <div class="body px-5 py-2 bg-gray-100/80" x-data="{ isDetailOpen: false }">
                                <div x-show="isDetailOpen" class="detailBody">
                                    <p>{{ $pembayaranIuran->getKeterangan() }}</p>
                                </div>
                                <div class="trigger">
                                    <button @click="isDetailOpen = !isDetailOpen">
                                        <h6 class="text-xs">Detail Pembayaran</h6>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script type="module" src="{{ Vite::asset('resources/js/image-zoom.js') }}"></script>
    <script type="module">
        $(document).ready(() => {
            var searchParams = new URLSearchParams(window.location.search);
            let search = searchParams.get('q');
            let status = searchParams.get('filters[status]');
            let tanggalBayar = searchParams.get('filters[tanggal_bayar]');

            $('#search').val(search);
            $('#status').val(status);
            $('#tanggal_bayar').val(tanggalBayar);
        });
    </script>
    <script>
        function applyFilter() {
            let search = document.getElementById('search').value;
            let status = document.getElementById('status').value;
            let tanggalBayar = document.getElementById('tanggal_bayar').value;

            var searchParams = new URLSearchParams(window.location.search);
            if (searchParams.has('page')) searchParams.set('page', 1);
            searchParams.set('q', search);
            searchParams.set('filters[status]', status);
            searchParams.set('filters[tanggal_bayar]', tanggalBayar);

            let url = `${document.location.origin}${document.location.pathname}?${searchParams.toString()}`;

            $.ajax({
                url: url,
                beforeSend: window.Loading.showLoading,
                success: function(res) {
                    let parser = new DOMParser();
                    let doc = parser.parseFromString(res, 'text/html');
                    $('body').html(doc.body.innerHTML);
                    window.history.pushState({}, '', url);
                },
            });
        }

        function appendImageModal(img_url, nama, event) {
            const modalImageElement = /*html*/ `
<div id="imageModal" x-show="showImage" class="fixed inset-0 z-40 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
<div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
    <div x-cloak @click="()=>{showImage = false;isOnImg=false;deleteModal('#imageModal')}" x-show="showImage"
        x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 transition-opacity  bg-gray-500/40 dark:bg-gray-800/40" aria-hidden="true"></div>

    <div x-cloak x-show="showImage" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="inline-block w-full max-w-3xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-gray-800 rounded-lg shadow-xl 2xl:max-w-2xl">
        <div class="flex items-center justify-between space-x-4">
            <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100  ">Gambar Pembayaran</h1>

            <button @click="()=>{showImage = false;isOnImg=false;setTimeout(deleteModal('#imageModal'),3000)}"
                class="text-gray-600 dark:text-gray-400 focus:outline-none hover:text-gray-700 dark:hover:text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
        </div>

        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            Bukti gambar dari Pembayaran ${nama}
        </p>

        <div class="image-container">
			<img id="imageZoom" src="${img_url}" alt="image">
		</div>

    </div>
</div>
</div>
                `
            $(modalImageElement).insertAfter($(event.target).closest('#imageButton'))
        }

        function deleteModal(selector) {
            $(selector).ready(() => {
                $(selector).remove()
            })
        }

        function zoomInit() {
            $(document).ready(function() {
                $('#imageZoom').imageZoom();
            });
        }
    </script>
@endpush
