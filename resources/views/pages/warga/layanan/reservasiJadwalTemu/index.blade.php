@extends(request()->user()->getSidebarView())
@php
$status = \App\Enums\ReservasiJadwalTemu\ReservasiJadwalTemuStatusEnum::getValues();

@endphp
@section('content')
<section class="container px-4 mt-7 mx-auto relative " x-data="{ modalOpen: false }">
    <div class="flex flex-col">
        <div class="sm:flex sm:items-center sm:justify-between ">
            <div>
                <div class=" flex items-center gap-x-3">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white">Reservasi</h2>
                    <span class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">{{ $data['count'] }}
                        Reservasi</span>
                </div>
                @if ($reservasiJadwalTemuInstances->sortByDesc('diperbarui_pada')->first())
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Data ini terakhir diupdate {{ $reservasiJadwalTemuInstances->sortByDesc('diperbarui_pada')->first()?->getDiperbaruiPada()->diffForHumans(null, true)}} yang lalu</p>
                @else
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Masih belum ada reservasi yang diajukan</p>
                @endif
            </div>
        </div>
        <div class="mt-6 md:flex md:items-center md:justify-between">
            <div class="inline-flex overflow-hidden bg-white border divide-x rounded-lg dark:bg-gray-900 rtl:flex-row-reverse dark:border-gray-700 dark:divide-gray-700">

                <button id="filter-all" onclick="window.utils.Request.filterRequest({'status': ''})" x-effect="let params = new URLSearchParams(window.location.search); (params.has('filters[status]') && params.get('filters[status]') == '') || !params.has('filters[status]') ? $('#filter-all').addClass('!text-blue-400') : $('#filter-all').removeClass('!text-blue-400')" class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                    semua
                </button>

                @foreach (\App\Enums\ReservasiJadwalTemu\ReservasiJadwalTemuStatusEnum::getValues() as $key => $value)
                <button id="filter-{{ $key }}" onclick="window.utils.Request.filterRequest({'status': '{{ $value }}'})" x-effect="let params = new URLSearchParams(window.location.search); params.has('filters[status]') && params.get('filters[status]') == '{{ $value }}' ? $('#filter-{{ $key }}').addClass('!text-blue-400') : $('#filter-{{ $key }}').removeClass('!text-blue-400')" class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                    {{ $value }}
                </button>
                @endforeach

            </div>
            <div id="search" class="relative flex items-center mt-4 md:mt-0" x-data="{search:''}">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </span>

                <input x-model="search" @keyup.enter="window.utils.Request.searchRequest(search)" type="text" placeholder="Press Enter to Search" class="block lg:w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
            </div>
        </div>
    </div>

    <div class="flex flex-col mt-6 ">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                    <table class="min-w-full w-full table-auto divide-y divide-gray-200 dark:divide-gray-700 px-2">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                        <span class="text-nowrap">Nama</span>
                                    </button>
                                </th>
                                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                        <span class="text-nowrap">Subjek</span>

                                    </button>
                                </th>

                                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                        <span class="text-nowrap">Pesan Reservasi</span>

                                    </button>

                                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                        <span class="text-nowrap">Tanggal</span>
                                    </button>
                                </th>

                                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                        <span class="text-nowrap">Tujuan</span>

                                    </button>
                                </th>

                                <th scope="col" class="py-3.5 px-4 text-sm text-center font-normal rtl:text-right text-gray-500 dark:text-gray-400">
                                    <button class="flex items-center mx-auto gap-x-2 dark:fill-gray-400">
                                        <span class="text-nowrap">Status</span>
                                    </button>
                                </th>

                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            @foreach ($reservasiJadwalTemuInstances as $reservasiJadwalTemu)
                            <tr>
                                <td class=" px-4 py-4 text-sm font-medium">
                                    <div>
                                        <h2 class="text-nowrap inline px-3 py-1 text-sm font-normal rounded-full text-emerald-500 gap-x-2 bg-emerald-100/60 dark:bg-gray-800">
                                            {{ $reservasiJadwalTemu->getNamaPemohon() }}
                                        </h2>
                                    </div>
                                </td>

                                <td class="px-4 py-4 text-sm align-middle">
                                    <h4 class="text-gray-700 dark:text-gray-200 w-[200px]">
                                        {{ $reservasiJadwalTemu->getSubjek() }}
                                    </h4>
                                </td>

                                <td class="px-4 py-4 text-sm align-middle">
                                    <h4 class="text-gray-700 dark:text-gray-200 w-[200px]">
                                        {{ $reservasiJadwalTemu->getPesan() }}
                                    </h4>
                                </td>


                                <td class="px-4 py-4 text-sm">
                                    <p class=" -mx-1 text-xs text-nowrap text-blue-600 ">
                                        {{ date('D, m-y', strtotime($reservasiJadwalTemu->getDibuatPada())) }}
                                    </p>
                                </td>

                                <td class="px-4 py-4 text-sm align-middle">
                                    <h4 class="text-gray-700 dark:text-gray-200">
                                        {{ $reservasiJadwalTemu->getNamaPenerima() }}
                                    </h4>
                                </td>

                                <td class="px-4 py-4 text-sm">
                                    <span class="inline-flex items-center justify-center w-56 mx-1 2xl:w-full px-3 py-1.5 rounded-full text-sm w-fit @php 
                                    $statusStyle = ['pending' => 'bg-blue-50 dark:bg-blue-950 text-blue-700 dark:text-blue-200 ring-blue-700/10', 'ditolak' => 'bg-red-50 dark:bg-red-950 text-red-700 dark:text-red-300 ring-red-600/10', 'diterima' => 'bg-green-50 dark:bg-green-950 text-green-700 dark:text-green-300 ring-green-600/20']; $dotStyle=['pending' => 'bg-blue-500 dark:bg-blue-300',  'ditolak' => 'bg-red-500 dark:bg-red-300', 'diterima' => 'bg-green-500 dark:bg-green-300'];
                                    @endphp
                                        @if($reservasiJadwalTemu->getStatus())
                                        {{ $statusStyle[$reservasiJadwalTemu->getStatus()] }}
                                        @else
                                        bg-gray-50 text-gray-600 ring-gray-500/10 
                                        @endif
                                        ">
                                        <span class="me-1 p-[5px] rounded-full inline-block
                                        @if ($reservasiJadwalTemu->getStatus()) 
                                        {{ $dotStyle[$reservasiJadwalTemu->getStatus()] }}
                                        @else 
                                        bg-gray-50
                                        @endif
                                            "></span>
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

    {{ $reservasiJadwalTemuInstances->onEachSide(-1)->links('elements.pagination') }}

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
    })
</script>

@endpush