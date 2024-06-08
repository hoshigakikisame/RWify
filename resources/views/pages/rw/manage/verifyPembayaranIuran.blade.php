{{-- extend to layouts/app --}}
@extends('layouts.sidebar.rw-sidebar')

@php
    $bulanOptions = \App\Enums\Iuran\IuranBulanEnum::getValues();
@endphp

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
                        class="rounded-full bg-gray-200/50 px-3 py-1 text-xs text-gray-400 dark:bg-gray-600/30 dark:text-gray-100">
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
                            class="border-t border-b border-e-0 border-s border-gray-300 dark:border-gray-500 dark:bg-darkBg rounded-s-md focus:outline-none focus:ring-0 col-span-3 dark:text-gray-300 dark:placeholder-gray-300"
                            placeholder="Search" />
                        <select name="status" id="status"
                            class="border focus:outline-none dark:bg-darkBg dark:text-gray-300 focus:ring-0 col-span-2"
                            aria-placeholder="Status">
                            <option value="">All</option>
                            <option value="verified">Terverifikasi</option>
                            <option value="unverified">Belum Terverifikasi</option>
                        </select>
                        <input id="tanggal_bayar" type="date"
                            class="border focus:outline-none dark:bg-darkBg dark:text-gray-300 focus:ring-0 col-span-2"
                            placeholder="Date" />
                        <button onclick="applyFilter()"
                            class="flex shrink-0 items-center justify-center gap-x-2 text-nowrap bg-ColorButton px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 hover:bg-ColorHover dark:bg-ColorButton  dark:hover:bg-ColorHover sm:w-auto fill-white">
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
                <div class="body-search mt-5 flex flex-col gap-2">
                    @foreach ($pembayaranIuranInstances as $pembayaranIuran)
                        <div
                            class="card border border-gray-200 shadow-sm ring-4 ring-gray-200/10 dark:border-gray-800 dark:ring-gray-700/10 pt-2 rounded-lg mb-4">
                            <div class="flex py-4 px-5 gap-3 justify-between items-start">
                                <div class="header pb-2 grow flex gap-2">
                                    <div class="rounded-lg w-36 h-36 overflow-hidden">
                                        <div class="bg-indigo-100 w-full h-full " x-data="{ isOnImg: false, showImage: false }"
                                            @mouseover="isOnImg = true" @mouseleave="isOnImg = false"
                                            style="background: url({{ $pembayaranIuran->getImageUrl() }});background-size:cover; background-position: center">
                                            <button x-show="isOnImg" id="imageButton" @click="showImage = true"
                                                onclick="(function(){appendImageModal('{{ $pembayaranIuran->getImageUrl() }}','{{ $pembayaranIuran->getUser()->getNamaLengkap() }}',event);zoomInit()})()"
                                                class="w-full h-full flex justify-center items-center "
                                                :class="{
                                                    'backdrop-brightness-75 dark:backdrop-brightness-50': isOnImg
                                                }">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    class="w-8 h-8 fill-gray-50">
                                                    <path
                                                        d="M10 20a9.96 9.96 0 0 0 6.327-2.258l5.966 5.965a1 1 0 0 0 1.414-1.414l-5.966-5.965A10 10 0 1 0 10 20M7 9h2V7a1 1 0 0 1 2 0v2h2a1 1 0 0 1 0 2h-2v2a1 1 0 0 1-2 0v-2H7a1 1 0 0 1 0-2" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="text w-full h-full">
                                        <h1 class="text-xl mb-0.5 font-Poppins dark:text-gray-100">
                                            {{ $pembayaranIuran->getUser()->getNamaLengkap() }}</h1>
                                        <h2 class="text-xs text-gray-600 dark:text-gray-400 mb-2">
                                            {{ $pembayaranIuran->getUser()->getNik() }}
                                            <h2 class="text-xs text-gray-600 mb-2">Verified Count:
                                                {{ $pembayaranIuran->getVerifiedCount() }}
                                            </h2>
                                            <p class="text-sm text-gray-700 dark:text-gray-400">
                                                {{ $pembayaranIuran->getKeterangan() }}</p>
                                    </div>
                                </div>
                                <div class="form-action-verified" x-data="{ isFromOpen: false }">
                                    <button id="verifiedButton" class="" @click="isFromOpen = !isFromOpen"
                                        onclick="(function(){appendFormVerifiedModal(event,{{ $pembayaranIuran }},{{ $pembayaranIuran->getUser()->getTagihanIuranPerBulan() }});zoomInit();window.utils.Request.actionRequest(`{{ route('rw.manage.iuran.new') }}`, '#verifiedModal', '#verifiedModalForm')})()">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                class="w-5 h-5 dark:fill-gray-100 fill-gray-950">
                                                <path
                                                    d="M18 12a6 6 0 1 0 0 12 6 6 0 0 0 0-12m3.192 6.202-2.213 2.124c-.452.446-1.052.671-1.653.671s-1.203-.225-1.663-.674l-1.132-1.109a1 1 0 1 1 1.4-1.428l1.131 1.108a.374.374 0 0 0 .522-.002l2.223-2.134a1 1 0 1 1 1.385 1.443ZM10 18a7.98 7.98 0 0 1 2.709-6H5a1 1 0 1 1 0-2h8a1 1 0 0 1 .997 1.072A7.96 7.96 0 0 1 18 10V5c0-2.757-2.243-5-5-5H5C2.243 0 0 2.243 0 5v14c0 2.757 2.243 5 5 5h7.709A7.98 7.98 0 0 1 10 18M5 5h8a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2m2 12H5a1 1 0 1 1 0-2h2a1 1 0 1 1 0 2" />
                                            </svg>
                                        </div>
                                    </button>

                                </div>
                            </div>
                            <div class="body px-5 py-2 bg-gray-50 dark:bg-darkBg/80  " x-data="{ isDetailOpen: false }">
                                <div x-show="isDetailOpen" class="detailBody pt-3 pb-2 border-b-2 dark:border-gray-700">
                                    <p class="text-sm mb-1 text-gray-800 dark:text-gray-400">Tanggal Bayar Pada
                                        {{ date('F, j-Y ', strtotime($pembayaranIuran->getTanggalBayar())) }}</p>
                                    <p class="text-xs text-gray-700 dark:text-gray-500">Last Updated
                                        {{ date('d/m/y H:i', strtotime($pembayaranIuran->getDiperbaruiPada())) }}</p>
                                </div>
                                <div class="trigger flex justify-between items-center py-2 ">
                                    <button @click="isDetailOpen = !isDetailOpen" class="">
                                        <h6
                                            class="text-xs hover:!text-blue-600 transition-all duration-300 dark:hover:!text-blue-500 text-gray-600 dark:text-gray-300  ">
                                            Detail
                                            Pembayaran</h6>
                                    </button>
                                    <div class="information">
                                        <h6 class="text-xs text-gray-400 dark:text-gray-500">
                                            {{ date('d/m/y H:i', strtotime($pembayaranIuran->getDibuatPada())) }}</h6>
                                    </div>
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

        function appendFormVerifiedModal(event, data, tagihan) {
            const formVerifiedElemen = /*html*/ `
            <div id="verifiedModal" x-show="isFromOpen" class="fixed inset-0 z-40 overflow-y-auto" aria-labelledby="modal-title"
    role="dialog" aria-modal="true">
    <div class="flex min-h-screen items-end justify-center px-4 text-center sm:block sm:p-0 md:items-center">
        <div x-cloak x-show="isFromOpen" @click="()=>{isFromOpen = false;deleteModal('#verifiedModal')}" 
            x-transition:enter="transform transition duration-300 ease-out" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transform transition duration-200 ease-in"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-500/40 transition-opacity dark:bg-darkBg/40" aria-hidden="true">
        </div>

        <div x-show="isFromOpen" x-cloak x-transition:enter="transform transition duration-300 ease-out"
            x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
            x-transition:leave="transform transition duration-200 ease-in"
            x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
            x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
            class="my-20 inline-block w-full max-w-5xl transform overflow-hidden rounded-lg bg-white p-8 text-left shadow-xl transition-all dark:bg-darkBg 2xl:max-w-2xl">
            <div class="flex items-center justify-between space-x-4">
                <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100">
                    Verifikasi Pembayaran</h1>

                <button @click="()=>{isFromOpen = false;deleteModal('#verifiedModal')}"
                    class="text-gray-600 hover:text-gray-700 focus:outline-none dark:text-gray-400 dark:hover:text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>
            </div>

            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                Verifikasi pembayaran dari warga dari form ini
            </p>

            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            <div class="mt-3 flex gap-3">
                <div class="image-desc shrink w-fit">
                    <div class="image-container rounded-md overflow-hidden">
                        <img id="imageZoom" src="${data.image_url}" alt="image">
                    </div>
                    <p class="my-2 text-gray-700">
                        ${data.keterangan}
                    </p>
                </div>
                <form class="mt-5 grow" id="verifiedModalForm" method="POST"
                    action="{{ route('rw.manage.iuran.new') }}">
                    @csrf

                    <x-form.input-form title="" key="id_pembayaran_iuran" type="hidden"
                        value="${data.id_pembayaran_iuran }" placeholder="" />

                    <x-form.input-form title="" key="nik_pembayar" type="hidden" value="${data.user.nik}"
                        placeholder="" />

                    <x-form.select-input-form title="Bulan Terbayar" key="bulan"
                        placeholder="Pilih Bulan Terbayar Warga" :options="$bulanOptions" />

                    <x-form.input-form title="Tahun Terbayar" key="tahun" type="number" placeholder="2024" />

                    <x-form.input-form title="Jumlah Bayar" key="jumlah_bayar" type="number" placeholder="100000"
                        value='${tagihan }' readonly="true" />

                    <div class="mt-6 flex justify-between">
                        <p class="text-xs text-gray-200 dark:text-gray-400">
                            Note: Pastikan semua sudah terisi dengan benar
                        </p>
                        <button type="click"
                            class="transform rounded-md bg-blue-500 px-3 py-2 text-sm capitalize tracking-wide text-white transition-colors duration-200 hover:bg-blue-600 focus:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700">
                            Verified Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
            `
            $(formVerifiedElemen).insertAfter($(event.target).closest('#verifiedButton'))
        }

        function appendImageModal(img_url, nama, event) {
            const modalImageElement = /*html*/ `
<div id="imageModal" x-show="showImage" class="fixed inset-0 z-40 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
<div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
    <div x-cloak @click="()=>{showImage = false;isOnImg=false;deleteModal('#imageModal')}" x-show="showImage"
        x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 transition-opacity  bg-gray-500/40 dark:bg-darkBg/40" aria-hidden="true"></div>

    <div x-cloak x-show="showImage" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="inline-block w-full max-w-3xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-darkBg rounded-lg shadow-xl 2xl:max-w-2xl">
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
