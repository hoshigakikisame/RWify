@extends(request()->user()->getSidebarView())
@php
    $status = \App\Enums\ReservasiJadwalTemu\ReservasiJadwalTemuStatusEnum::getValues();
@endphp

@section("content")
    <section class="container relative mx-auto mt-7 px-4" x-data="{ modalOpen: false }">
        <div class="flex flex-col">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <div class="flex items-center gap-x-3">
                        <h2 class="text-lg font-medium text-gray-800 dark:text-white">Reservasi</h2>
                        <span
                            class="rounded-full bg-blue-100 px-3 py-1 text-xs text-blue-600 dark:bg-gray-800 dark:text-blue-400"
                        >
                            {{ $data["count"] }} Reservasi
                        </span>
                    </div>

                    @if ($reservasiJadwalTemuInstances->sortByDesc("diperbarui_pada")->first())
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                            Data ini terakhir diupdate
                            {{ $reservasiJadwalTemuInstances->sortByDesc("diperbarui_pada")->first() ?->getDiperbaruiPada()->diffForHumans(null, true) }}
                            yang lalu
                        </p>
                    @else
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                            Masih belum ada reservasi yang diajukan
                        </p>
                    @endif
                </div>
            </div>
            <div class="mt-6 md:flex md:items-center md:justify-between">
                <div
                    class="inline-flex divide-x overflow-hidden rounded-lg border bg-white dark:divide-gray-700 dark:border-gray-700 dark:bg-gray-900 rtl:flex-row-reverse"
                >
                    <button
                        id="filter-all"
                        onclick="window.utils.Request.filterRequest({'status': ''})"
                        x-effect="
                            let params = new URLSearchParams(window.location.search)
                            ;(params.has('filters[status]') && params.get('filters[status]') == '') ||
                            ! params.has('filters[status]')
                                ? $('#filter-all').addClass('!text-blue-400')
                                : $('#filter-all').removeClass('!text-blue-400')
                        "
                        class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 sm:text-sm"
                    >
                        semua
                    </button>

                    @foreach (\App\Enums\ReservasiJadwalTemu\ReservasiJadwalTemuStatusEnum::getValues() as $key => $value)
                        <button
                            id="filter-{{ $key }}"
                            onclick="window.utils.Request.filterRequest({'status': '{{ $value }}'})"
                            x-effect="let params = new URLSearchParams(window.location.search); params.has('filters[status]') && params.get('filters[status]') == '{{ $value }}' ? $('#filter-{{ $key }}').addClass('!text-blue-400') : $('#filter-{{ $key }}').removeClass('!text-blue-400')"
                            class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 sm:text-sm"
                        >
                            {{ $value }}
                        </button>
                    @endforeach
                </div>
                <div id="search" class="relative mt-4 flex items-center md:mt-0" x-data="{ search: '' }">
                    <span class="absolute">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="mx-3 h-5 w-5 text-gray-400 dark:text-gray-600"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
                            />
                        </svg>
                    </span>

                    <input
                        x-model="search"
                        @keyup.enter="window.utils.Request.searchRequest(search)"
                        type="text"
                        placeholder="Press Enter to Search"
                        class="block rounded-lg border border-gray-200 bg-white py-1.5 pl-11 pr-5 text-gray-700 placeholder-gray-400/70 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300 md:w-80 lg:w-full rtl:pl-5 rtl:pr-11"
                    />
                </div>
            </div>
        </div>

        <div class="mt-6 flex flex-col">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                        <table class="w-full min-w-full table-auto divide-y divide-gray-200 px-2 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th
                                        scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right"
                                    >
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Nama</span>
                                        </button>
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right"
                                    >
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Subjek</span>
                                        </button>
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right"
                                    >
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Pesan Reservasi</span>
                                        </button>
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right"
                                    >
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Tanggal</span>
                                        </button>
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right"
                                    >
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Tujuan</span>
                                        </button>
                                    </th>

                                    <th
                                        scope="col"
                                        class="px-4 py-3.5 text-center text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right"
                                    >
                                        <button class="mx-2 flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Status</span>
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900">
                                @foreach ($reservasiJadwalTemuInstances as $reservasiJadwalTemu)
                                    <tr>
                                        <td class="px-4 py-4 text-sm font-medium">
                                            <div>
                                                <h2
                                                    class="inline gap-x-2 text-nowrap rounded-full bg-emerald-100/60 px-3 py-1 text-sm font-normal text-emerald-500 dark:bg-gray-800"
                                                >
                                                    {{ $reservasiJadwalTemu->getNamaPemohon() }}
                                                </h2>
                                            </div>
                                        </td>

                                        <td class="px-4 py-4 align-middle text-sm">
                                            <h4 class="w-[200px] text-gray-700 dark:text-gray-200">
                                                {{ $reservasiJadwalTemu->getSubjek() }}
                                            </h4>
                                        </td>

                                        <td class="px-4 py-4 align-middle text-sm">
                                            <h4 class="w-[200px] text-gray-700 dark:text-gray-200">
                                                {{ $reservasiJadwalTemu->getPesan() }}
                                            </h4>
                                        </td>

                                        <td class="px-4 py-4 text-sm">
                                            <p class="-mx-1 text-nowrap text-xs text-blue-600">
                                                {{ date("D, m-y", strtotime($reservasiJadwalTemu->getDibuatPada())) }}
                                            </p>
                                        </td>

                                        <td class="px-4 py-4 align-middle text-sm">
                                            <h4 class="text-gray-700 dark:text-gray-200">
                                                {{ $reservasiJadwalTemu->getNamaPenerima() }}
                                            </h4>
                                        </td>

                                        <td class="px-4 py-4 text-sm">
                                            <span
                                                class="@php
                                                $statusStyle = ["pending" => "bg-blue-50 text-blue-700 ring-blue-700/10 dark:bg-blue-950 dark:text-blue-200", "ditolak" => "bg-red-50 text-red-700 ring-red-600/10 dark:bg-red-950 dark:text-red-300", "diterima" => "bg-green-50 text-green-700 ring-green-600/20 dark:bg-green-950 dark:text-green-300"];
                                                $dotStyle = ["pending" => "bg-blue-500 dark:bg-blue-300", "ditolak" => "bg-red-500 dark:bg-red-300", "diterima" => "bg-green-500 dark:bg-green-300"];

 @endphp @if ($reservasiJadwalTemu->getStatus())
                                                    {{ $statusStyle[$reservasiJadwalTemu->getStatus()] }}
                                                @else
                                                    bg-gray-50
                                                    text-gray-600
                                                    ring-gray-500/10
                                                @endif mx-1 inline-flex w-56 w-fit items-center justify-center rounded-full px-3 py-1.5 text-sm 2xl:w-full"
                                            >
                                                <span
                                                    class="@if ($reservasiJadwalTemu->getStatus())
                                                        {{ $dotStyle[$reservasiJadwalTemu->getStatus()] }}
                                                    @else
                                                        bg-gray-50
                                                    @endif me-1 inline-block rounded-full p-[5px]"
                                                ></span>
                                                <span class="text-xs">
                                                    {{ $reservasiJadwalTemu->getStatus() }}
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{ $reservasiJadwalTemuInstances->onEachSide(-1)->links("elements.pagination") }}
    </section>
@endsection

@push("scripts")
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
@endpush
