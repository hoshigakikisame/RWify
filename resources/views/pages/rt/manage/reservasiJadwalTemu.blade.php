{{-- extend to layouts/app --}}
@extends(request()->user()->getSidebarView())

@push("style")
    
@endpush

{{-- content --}}
@section("content")
    <section class="container relative mx-auto mb-8 mt-7 px-4" x-data="{ modalOpen: false }">
        <div class="relative sm:flex sm:items-center sm:justify-between">
            <div class="">
                <div class="flex items-center gap-x-3">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white">Jadwal Temu</h2>
                    <span
                        class="rounded-full bg-blue-100 px-3 py-1 text-xs text-blue-600 dark:bg-gray-800 dark:text-blue-400"
                    >
                        {{ $count }} Jadwal Temu
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-full bg-green-100 px-3 py-1 dark:bg-gray-800">
                        <span class="text-xs text-green-600 dark:text-green-400">{{ $diterimaCount }} Diterima</span>
                        <span class="relative flex h-3 w-3 items-center justify-center">
                            <span
                                class="absolute inline-flex h-full w-full animate-ping rounded-full bg-green-400/75 duration-700"
                            ></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full bg-green-500"></span>
                        </span>
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
                        Masih belum ada data reservasi untuk anda
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

        <div class="mt-6 flex flex-col">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border-t-2 border-gray-200 dark:border-gray-700">
                        <div class="heading mb-4"></div>
                        <div class="Wraper grid grid-cols-2 gap-5">
                            @foreach ($reservasiJadwalTemuInstances as $reservasiJadwalTemu)
                                @php
                                    $backgroundStyle = ["pending" => "bg-blue-50 dark:bg-blue-950", "ditolak" => "bg-red-50 dark:bg-red-950", "diterima" => "border bg-green-50 dark:bg-green-950"];
                                @endphp

                                <div
                                    class="card rounded-lg border border-gray-300 px-10 py-8 ring ring-gray-200/20 dark:border-gray-700 dark:ring-gray-800/20"
                                >
                                    <div class="card-header mb-4 flex items-center justify-between">
                                        <p class="font-Poppins text-sm font-light text-gray-900 dark:text-gray-300">
                                            Tanggal temu
                                            <span class="font-semibold">
                                                {{ date("l, M jS Y H:i", strtotime($reservasiJadwalTemu->getJadwalTemu())) }}
                                            </span>
                                            dengan
                                            <span class="font-semibold">
                                                {{ $reservasiJadwalTemu->getPemohon()->getNamaDepan() }}
                                            </span>
                                        </p>
                                        <div class="status">
                                            <span
                                                class="@php
                                                $statusStyle = ["pending" => "bg-blue-200 text-blue-700 ring-blue-700/10 dark:bg-blue-950 dark:text-blue-200", "ditolak" => "bg-red-200 text-red-700 ring-red-600/10 dark:bg-red-950 dark:text-red-300", "diterima" => "bg-green-200 text-green-700 ring-green-600/20 dark:bg-green-950 dark:text-green-300"];
                                                $dotStyle = ["pending" => "bg-blue-500 dark:bg-blue-300", "ditolak" => "bg-red-500 dark:bg-red-300", "diterima" => "bg-green-500 dark:bg-green-300"];

 @endphp @if ($reservasiJadwalTemu->getStatus())
                                                    {{ $statusStyle[$reservasiJadwalTemu->getStatus()] }}
                                                @else
                                                    bg-gray-50
                                                    text-gray-600
                                                    ring-gray-500/10
                                                @endif mx-1 inline-flex w-fit items-center justify-center rounded-full px-3 py-[2px] text-sm 2xl:w-full"
                                            >
                                                <span
                                                    class="@if ($reservasiJadwalTemu->getStatus())
                                                        {{ $dotStyle[$reservasiJadwalTemu->getStatus()] }}
                                                    @else
                                                        bg-gray-50
                                                    @endif me-1 inline-block rounded-full p-[4px]"
                                                ></span>
                                                <span class="text-[12px]">
                                                    {{ $reservasiJadwalTemu->getStatus() }}
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-body me-24 flex flex-col">
                                        <h1 class="mb-2 text-xl capitalize leading-6 text-gray-950 dark:text-gray-100">
                                            {{ $reservasiJadwalTemu->getSubjek() }}
                                        </h1>
                                        <p class="pb-4 text-sm capitalize leading-6 text-gray-700 dark:text-gray-400">
                                            {{ $reservasiJadwalTemu->getPesan() }}
                                        </p>
                                        <div id="actionStatus-{{ $reservasiJadwalTemu->getIdReservasiJadwalTemu() }}">
                                            <form
                                                id="actionStatusForm-{{ $reservasiJadwalTemu->getIdReservasiJadwalTemu() }}"
                                                action=""
                                                method="post"
                                                autocomplete="off"
                                            >
                                                @csrf
                                                <x-form.input-form
                                                    title=""
                                                    id="idReservasiJadwalTemu"
                                                    key="idReservasiJadwalTemu"
                                                    type="hidden"
                                                    value="{{ $reservasiJadwalTemu->getIdReservasiJadwalTemu() }}"
                                                    placeholder=""
                                                />

                                                <label
                                                    for="submitAction-{{ $reservasiJadwalTemu->getIdReservasiJadwalTemu() }}"
                                                    class="me-2 text-sm text-gray-800 dark:text-gray-300"
                                                >
                                                    Change Status
                                                </label>
                                                <select
                                                    aria-current="submitButton"
                                                    id="submitAction-{{ $reservasiJadwalTemu->getIdReservasiJadwalTemu() }}"
                                                    name="status"
                                                    x-effect="window.utils.Request.actionRequest('{{route('rt.manage.reservasiJadwalTemu.update')}}','#actionStatus-{{ $reservasiJadwalTemu->getIdReservasiJadwalTemu() }}','#actionStatusForm-{{ $reservasiJadwalTemu->getIdReservasiJadwalTemu() }}')"
                                                    class="rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-950 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100"
                                                >
                                                    @foreach (\App\Enums\ReservasiJadwalTemu\ReservasiJadwalTemuStatusEnum::getValues() as $status)
                                                        <option
                                                            value="{{ $status }}"
                                                            {{ $status == $reservasiJadwalTemu->getStatus() ? "selected=selected" : "" }}
                                                        >
                                                            {{ $status }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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