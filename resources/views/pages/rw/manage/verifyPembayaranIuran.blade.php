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
                        <label for="date" class="text-xs font-Poppins font-medium col-span-2">Date</label>
                    </div>
                    <div class="grid grid-cols-9 divide-x mt-2 divide-gray-300 dark:divide-gray-500">
                        <input id="search" type="text"
                            class="border-t border-b border-e-0 border-s border-gray-300 dark:border-gray-500 dark:bg-gray-800 rounded-s-md focus:outline-none focus:ring-0 col-span-3 dark:text-gray-300 dark:placeholder-gray-300"
                            placeholder="Search" />
                        <select name="" id="status"
                            class="border focus:outline-none dark:bg-gray-800 dark:text-gray-300 focus:ring-0 col-span-2"
                            aria-placeholder="Status">
                            <option value="">All</option>
                            <option value="">Terverifikasi</option>
                            <option value="">Belum Terverifikasi</option>
                        </select>
                        <input id="date" type="date"
                            class="border focus:outline-none dark:bg-gray-800 dark:text-gray-300 focus:ring-0 col-span-2"
                            placeholder="Date" />
                        <button
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
                        jumlah hasil pembayaran yang diterima 20 data
                    </p>
                </div>
                <div class="body-search">
                    <div class="card">
                        <div class="header">
                            <h1>Thoriq Fathurrozi</h1>
                            <h2>729302938209823029</h2>
                            <p>Pembayaran iuran untuk bulan januari sampai dengan februari</p>
                        </div>
                        <div class="body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
