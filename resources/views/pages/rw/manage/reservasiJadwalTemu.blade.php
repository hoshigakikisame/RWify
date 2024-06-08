{{-- extend to layouts/app --}}
@extends(request()->user()->getSidebarView())

@push('style')
@endpush

{{-- content --}}
@section('content')
    <section class="container relative mx-auto mb-8 mt-7 px-4" x-data="{ modalOpen: false }">
        <div class="mb-6">

            <div class="relative sm:flex sm:items-center sm:justify-between">
                <div class="header">
                    <div class="flex items-center gap-x-3">
                        <h2 class="text-lg font-medium text-gray-800 dark:text-white">Jadwal Temu</h2>
                        <span
                            class="rounded-full bg-gray-200/50 px-3 py-1 text-xs text-gray-400 dark:bg-gray-600/30 dark:text-gray-100">
                            {{ $count }} Jadwal Temu
                        </span>
                        <span class="inline-flex items-center gap-2 rounded-full bg-green-100 px-3 py-1 dark:bg-darkBg">
                            <span class="text-xs text-green-600 dark:text-green-400">{{ $diterimaCount }} Diterima</span>
                            <span class="relative flex h-3 w-3 items-center justify-center">
                                <span
                                    class="absolute inline-flex h-full w-full animate-ping rounded-full bg-green-400/75 duration-700"></span>
                                <span class="relative inline-flex h-2 w-2 rounded-full bg-green-500"></span>
                            </span>
                        </span>
                    </div>

                    @if ($reservasiJadwalTemuInstances->sortByDesc('diperbarui_pada')->first())
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                            Data ini terakhir diupdate
                            {{ $reservasiJadwalTemuInstances->sortByDesc('diperbarui_pada')->first()?->getDiperbaruiPada()->diffForHumans(null, true) }}
                            yang lalu
                        </p>
                    @else
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                            Masih belum ada data reservasi untuk anda
                        </p>
                    @endif
                </div>
            </div>

            <div class="mt-4 md:flex md:items-center md:justify-between">
                <div
                    class="inline-flex divide-x overflow-hidden rounded-lg border bg-white dark:divide-gray-700 dark:border-gray-700 dark:bg-darkBg rtl:flex-row-reverse">
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

                    @foreach (\App\Enums\ReservasiJadwalTemu\ReservasiJadwalTemuStatusEnum::getValues() as $key => $value)
                        <button id="filter-{{ $key }}"
                            onclick="window.utils.Request.filterRequest({'status': '{{ $value }}'})"
                            x-effect="let params = new URLSearchParams(window.location.search); params.has('filters[status]') && params.get('filters[status]') == '{{ $value }}' ? $('#filter-{{ $key }}').addClass('!text-blue-400') : $('#filter-{{ $key }}').removeClass('!text-blue-400')"
                            class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 sm:text-sm">
                            {{ $value }}
                        </button>
                    @endforeach
                </div>

                <div class="w-1/3 ml-auto">
                    <x-form.search-input placeholder="Tekan Enter Untuk Mencari Jadwal Temu ...">

                    </x-form.search-input>
                </div>
                {{-- <div id="search" class="relative mt-4 flex items-center md:mt-0" x-data="{ search: '' }">
                    <span class="absolute">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="mx-3 h-5 w-5 text-gray-400 dark:text-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </span>

                    <input x-model="search" @keyup.enter="window.utils.Request.searchRequest(search)" type="text"
                        placeholder="Press Enter to Search"
                        class="block rounded-lg border border-gray-200 bg-white py-1.5 pl-11 pr-5 text-gray-700 placeholder-gray-400/70 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-darkBg dark:text-gray-300 dark:focus:border-blue-300 md:w-80 lg:w-full rtl:pl-5 rtl:pr-11" />
                </div> --}}
            </div>
        </div>

        <div class="flex flex-col">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border-t-2 border-gray-200 dark:border-gray-700">
                        <div class="heading mb-4"></div>
                        <div class="Wraper grid grid-cols-2 gap-5">
                            @foreach ($reservasiJadwalTemuInstances as $reservasiJadwalTemu)
                                @php
                                    $backgroundStyle = [
                                        'pending' => 'bg-blue-50 dark:bg-blue-950',
                                        'ditolak' => 'bg-red-50 dark:bg-red-950',
                                        'diterima' => 'border bg-green-50 dark:bg-green-950',
                                    ];
                                @endphp

                                <div
                                    class="card rounded-lg border border-gray-300 px-10 py-8 ring ring-gray-200/20 dark:border-gray-700 dark:ring-gray-800/20">
                                    <div class="card-header mb-4 flex items-center justify-between">
                                        <p class="font-Poppins text-sm font-light text-gray-900 dark:text-gray-300">
                                            Tanggal temu
                                            <span class="font-semibold">
                                                {{ date('l, M jS Y H:i', strtotime($reservasiJadwalTemu->getJadwalTemu())) }}
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
                                                $dotStyle = ["pending" => "bg-blue-500 dark:bg-blue-300", "ditolak" => "bg-red-500 dark:bg-red-300", "diterima" => "bg-green-500 dark:bg-green-300"]; @endphp @if ($reservasiJadwalTemu->getStatus()) {{ $statusStyle[$reservasiJadwalTemu->getStatus()] }}
                                                @else
                                                    bg-gray-50
                                                    text-gray-600
                                                    ring-gray-500/10 @endif mx-1 inline-flex w-fit items-center justify-center rounded-full px-3 py-[2px] text-sm 2xl:w-full">
                                                <span
                                                    class="@if ($reservasiJadwalTemu->getStatus()) {{ $dotStyle[$reservasiJadwalTemu->getStatus()] }}
                                                    @else
                                                        bg-gray-50 @endif me-1 inline-block rounded-full p-[4px]"></span>
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
                                            <form x-data="{ modalUpdateOpen: false }"
                                                id="actionStatusForm-{{ $reservasiJadwalTemu->getIdReservasiJadwalTemu() }}"
                                                action="" method="post" autocomplete="off">
                                                @csrf
                                                <x-form.input-form title="" id="idReservasiJadwalTemu"
                                                    key="idReservasiJadwalTemu" type="hidden"
                                                    value="{{ $reservasiJadwalTemu->getIdReservasiJadwalTemu() }}"
                                                    placeholder="" />

                                                <label
                                                    for="submitAction-{{ $reservasiJadwalTemu->getIdReservasiJadwalTemu() }}"
                                                    class="me-2 text-sm text-gray-800 dark:text-gray-300">
                                                    Change Status
                                                </label>
                                                <select
                                                    id="submitAction-{{ $reservasiJadwalTemu->getIdReservasiJadwalTemu() }}"
                                                    name="status" x-ref="status"
                                                    @change="(function(){modalUpdateOpen = true;appendUpdateModal('{{ $reservasiJadwalTemu->getIdReservasiJadwalTemu() }}',$refs.status.value,'{{ $reservasiJadwalTemu->getStatus() }}','{{ $reservasiJadwalTemu->getSubjek() }}',event);window.utils.Request.actionRequest('{{ route('rw.manage.reservasiJadwalTemu.update') }}','#actionStatus-{{ $reservasiJadwalTemu->getIdReservasiJadwalTemu() }}','#actionStatusForm-{{ $reservasiJadwalTemu->getIdReservasiJadwalTemu() }}')})()"
                                                    class="rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-950 dark:border-gray-700 dark:bg-darkBg dark:text-gray-100">
                                                    @foreach (\App\Enums\ReservasiJadwalTemu\ReservasiJadwalTemuStatusEnum::getValues() as $status)
                                                        <option value="{{ $status }}"
                                                            {{ $status == $reservasiJadwalTemu->getStatus() ? 'selected=selected' : '' }}>
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

        {{ $reservasiJadwalTemuInstances->links('elements.pagination') }}
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
        function appendUpdateModal(id_reservasi, status, old_status, judul, event) {
            const modalUpdateElemen = /*html*/ `
                <div id="updateModal" x-show="modalUpdateOpen" class="fixed inset-0 z-40 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                            <div x-cloak @click="(()=>{modalUpdateOpen = false;$('select#submitAction-${id_reservasi}').val('${old_status}').change();deleteModal('#updateModal')})()" x-show="modalUpdateOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500/40 dark:bg-darkBg/40" aria-hidden="true"></div>

                            <div x-cloak x-show="modalUpdateOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-darkBg rounded-lg shadow-xl 2xl:max-w-2xl">
                                <div class="flex items-center justify-between space-x-4">
                                    <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100">Delete Pengaduan</h1>

                                    <button type="button" @click="(()=>{modalUpdateOpen = false;$('select#submitAction-${id_reservasi}').val('${old_status}').change();deleteModal('#updateModal')})()" class="text-gray-600 dark:text-gray-400 focus:outline-none hover:text-gray-700 dark:hover:text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>

                                <p class="mt-2 text-sm text-gray-500 ">
                                    Menghapus Pengaduan dari sistem
                                </p>


                                
                                    <h1 class="text-xl text-wrap dark:text-gray-100 tracking-wide">Apakah Anda Yakin Merubah Status Reservasi <span class="font-semibold text-rose-600 underline underline-offset-8">${judul}</span> Menjadi  ${status} </h1>              
                                    <div class="flex justify-end mt-6">
                                        <button type="submit" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-500 rounded-md dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700 hover:bg-blue-600 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                            Rubah Status Reservasi
                                        </button>
                                    </div>
                            </div>
                        </div>
                    </div>
                `
            $(modalUpdateElemen).insertAfter($(event.target).closest('#submitAction-' + id_reservasi))

        }

        function deleteModal(selector) {
            $(selector).ready(() => {
                $(selector).remove()
            })
        }
    </script>
@endpush
