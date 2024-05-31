{{-- extend to layouts/app --}}
@extends('layouts.sidebar.rw-sidebar')

@php
    $imageDummy = Vite::asset('resources/assets/images/avatar.jpg');
    $medalImage = [
        'second' => Vite::asset('resources/assets/elements/second-medal.svg'),
        'first' => Vite::asset('resources/assets/elements/first-medal.svg'),
        'third' => Vite::asset('resources/assets/elements/third-medal.svg'),
    ];
@endphp

{{-- content --}}
@section('content')
    <section class="container relative mx-auto mb-8 mt-7 px-4">
        <div class="sm:flex sm:items-center sm:justify-between pb-1">
            <div>
                <div class="flex items-center gap-x-3">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white">
                        Leaderboard Iuran
                    </h2>
                </div>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                    Informasi Mengenai Pembayaran Iuran Warga
                </p>
            </div>
        </div>
        <div class="mt-2 md:flex md:items-center md:justify-between">
            <div
                class="inline-flex divide-x overflow-hidden rounded-lg border bg-white dark:divide-gray-700 dark:border-gray-700 dark:bg-gray-900 rtl:flex-row-reverse">
                <button id="filter-default" onclick="window.utils.Request.filterRequest({'role': ''})"
                    x-effect="
                        let params = new URLSearchParams(window.location.search)
                        ;(params.has('filters[role]') && params.get('filters[role]') == '') ||
                        ! params.has('filters[role]')
                            ? $('#filter-default').addClass('!text-blue-400')
                            : $('#filter-default').removeClass('!text-blue-400')
                    "
                    class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 sm:text-sm">
                    Terajin
                </button>
                <button id="filter-default" onclick="window.utils.Request.filterRequest({'role': ''})"
                    x-effect="
                    let params = new URLSearchParams(window.location.search)
                    ;(params.has('filters[role]') && params.get('filters[role]') == '') ||
                    ! params.has('filters[role]')
                        ? $('#filter-default').addClass('!text-blue-400')
                        : $('#filter-default').removeClass('!text-blue-400')
                "
                    class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 sm:text-sm">
                    Termalas
                </button>

            </div>
        </div>
        <div class="rangking-body p-5 w-5/6 flex justify-evenly">
            @foreach ($medalImage as $item)
                <div class="card w-52 border border-gray-300 dark:border-gray-500 rounded-xl relative">
                    <div class="medal absolute -right-6 w-16 -top-5">
                        <img class="" src="{{ $item }}" alt="">
                    </div>
                    <div class="card-body py-5 text-center">
                        <div class="imgRangkin inline-flex justify-center">
                            <div class="image w-24 h-24 rounded-full"
                                style="background: url({{ $imageDummy }});background-size:cover;">

                            </div>
                        </div>
                        <div class="text dark:text-gray-200">
                            <h1 class="text-lg font-medium ">Hary Van Oswald</h1>
                            <h6 class="text-xs font-Inter font-light mb-16 text-gray-700 dark:text-gray-400">
                                1234567890112233</h6>
                            <div class="status-pembayaran text-gray-600 dark:text-gray-400">
                                <h1 class="font-normal text-xs">Pembayaran Terakhir</h1>
                                <h6 class="font-Inter text-xs font-light dark:text-gray-300 text-gray-700">September 2024
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="tables mt-5">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                        <table class="w-full min-w-full table-auto divide-y divide-gray-200 px-2 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">No</span>
                                        </button>
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Nama</span>
                                        </button>
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Pembayaran Terakhir</span>
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900">
                                {{-- @foreach ($elements as $item) --}}
                                <tr>
                                    <td class="px-4 py-4 text-sm font-medium">
                                        <div>
                                            <h2 class="text-nowrap font-medium text-gray-800 dark:text-white">
                                                4
                                            </h2>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm">
                                        <div>
                                            <h4 class="text-gray-700 dark:text-gray-200">
                                                Thoriq
                                            </h4>
                                        </div>
                                    </td>

                                    <td class="px-4 py-4 text-sm">
                                        <div>
                                            <h4 class="text-gray-700 dark:text-gray-200">
                                                july 2002
                                            </h4>
                                        </div>
                                    </td>
                                </tr>
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
