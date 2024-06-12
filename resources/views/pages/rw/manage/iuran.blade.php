{{-- extend to layouts/app --}}
@extends(request()->user()->getSidebarView())

@php
    $bulanOptions = \App\Enums\Iuran\IuranBulanEnum::getValues();
@endphp
{{-- content --}}
@section('content')
    <section class="container relative mx-auto mb-8 mt-7 px-4" x-data="{ modalOpen: false }">
        <div class="mb-6">
            <div class="sm:flex sm:items-center sm:justify-between mb-3">
                <div class="header">
                    <div class="flex items-center gap-x-3">
                        <h2 class="text-lg font-medium text-gray-800 dark:text-white">Iuran Terverifikasi</h2>
                        <span
                            class="rounded-full bg-gray-200/50  px-3 py-1 text-xs text-gray-400 dark:bg-gray-600/30 dark:text-gray-100">
                            {{ $count }} Iuran Terverifikasi
                        </span>
                    </div>

                    @if ($iuranInstances->sortByDesc('diperbarui_pada')->first())
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-300">
                            Data ini terakhir diupdate
                            {{ $iuranInstances->sortByDesc('diperbarui_pada')->first()?->getDiperbaruiPada()->diffForHumans(null, true) }}
                            yang lalu
                        </p>
                    @else
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                            Masih belum ada iuran yang terverifikasi
                        </p>
                    @endif
                </div>
                <div class="mt-4 flex items-center gap-x-3" x-data="{ modalOpen: false }">
                    <div class="md:items-right md:flex gap-2">
                        <form id="exportCSVForm" method="get" action="{{ route('rw.manage.iuran.exportCSV') }}"
                            class="flex items-center justify-center">
                            @csrf
                            <label for="exportCSV"
                                class="flex items-center justify-center gap-x-2 rounded-lg border bg-white px-5 py-2 text-sm text-gray-700 transition-colors duration-200 hover:bg-gray-100 dark:border-gray-700 dark:bg-darkBg dark:text-gray-200 dark:hover:bg-gray-800 sm:w-auto">
                                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"
                                        d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242M12 12v9m-4-4l4 4l4-4" />
                                </svg>Export
                            </label>
                            <input id="exportCSV" name="exportCSV" type="submit" class="hidden"
                                onclick="document.querySelector('#exportCSVForm').submit()">
                        </form>
                    </div>

                    <div class="md:items-right md:flex md:justify-between">
                        <x-button.add-button routeButton="{{ route('rw.manage.iuran.new') }}" modalParent="#addModal"
                            modalForm="#addModalForm" multipartReq=true title="Tambah Iuran">

                        </x-button.add-button>
                        {{-- <button id="addButton" @click="modalOpen = !modalOpen"
                                class="mb-2 flex shrink-0 items-center justify-center gap-x-2 text-nowrap rounded-lg bg-ColorButton px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200  hover:bg-ColorHover dark:bg-ColorButton  dark:hover:bg-ColorHover sm:w-auto"
                                onclick="window.utils.Request.actionRequest('{{ route('rw.manage.iuran.new') }}', '#addModal', '#addModalForm',true)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>

                                <span>Tambah Iuran</span>
                            </button> --}}
                        <div id="addModal" x-show="modalOpen" class="fixed inset-0 z-40 overflow-y-auto"
                            aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none">
                            <div
                                class="flex min-h-screen items-end justify-center px-4 text-center sm:block sm:p-0 md:items-center">
                                <div @click="modalOpen = false" x-show="modalOpen"
                                    x-transition:enter="transform transition duration-300 ease-out"
                                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                    x-transition:leave="transform transition duration-200 ease-in"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    class="fixed inset-0 bg-gray-500/40 transition-opacity dark:bg-SecondaryBg/70"
                                    aria-hidden="true"></div>

                                <div x-show="modalOpen" x-transition:enter="transform transition duration-300 ease-out"
                                    x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                                    x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
                                    x-transition:leave="transform transition duration-200 ease-in"
                                    x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
                                    x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                                    class="my-20 inline-block w-full max-w-xl transform overflow-hidden rounded-lg bg-white p-8 text-left shadow-xl transition-all dark:bg-SecondaryBg 2xl:max-w-2xl">
                                    <div class="flex items-center justify-between space-x-4">
                                        <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100">
                                            Tambah Iuran
                                        </h1>

                                        <button @click="modalOpen = false"
                                            class="mt- text-gray-600 hover:text-gray-700 focus:outline-none dark:text-gray-400 dark:hover:text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>
                                    </div>

                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                        Tambah iuran ke dalam sistem
                                    </p>

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

                                    <form enctype="multipart/form-data" class="mt-5" id="addModalForm"
                                        action="{{ route('rw.manage.iuran.new') }}" method="post">
                                        @csrf
                                        <input type="text" name="id_pembayar" hidden />
                                        <x-form.search-dropdown title="Nama Pembayar" key="nik_pembayar"
                                            parent="#addModalForm" placeholder="Masukkan Nama Pembayar" :items="$nikPemilikInstances">
                                        </x-form.search-dropdown>
                                        <x-form.select-input-form title="Bulan Bayar" key="bulan"
                                            placeholder="Pilih Bulan Pembayaran Warga" :options="$bulanOptions" />
                                        <x-form.input-form title="Tahun Bayar" key="tahun" type="number"
                                            placeholder="Masukkan Tahun Pembayaran" />

                                        <x-form.input-form title="Jumlah Bayar" key="jumlah_bayar" type="number"
                                            placeholder="Masukkan Jumlah Pembayaran" />

                                        <div class="mt-6 flex justify-between">
                                            <p class="text-xs text-gray-200 dark:text-gray-400">
                                                Note: Pastikan semua sudah terisi dengan benar
                                            </p>
                                            <x-button.submit-button title="Tambah Iuran">
                                            </x-button.submit-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 w-1/3 ml-auto">
                <x-form.search-input placeholder="Tekan Enter Untuk Mencari Iuran Terverifikasi ...">

                </x-form.search-input>
            </div>
            {{-- <div id="search" class="relative mt-4 flex w-fit items-center self-end md:mt-0" x-data="{ search: '' }">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="mx-3 h-5 w-5 text-gray-400 dark:text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </span>

                <input x-model="search" @keyup.enter="window.utils.Request.searchRequest(search)" type="text"
                    placeholder="Press Enter to Search"
                    class="block rounded-lg border border-gray-200 bg-white py-1.5 pl-11 pr-5 text-gray-700 placeholder-gray-400/70 focus:border-green-400 focus:outline-none focus:ring focus:ring-green-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-darkBg dark:text-gray-300 dark:focus:border-green-300 md:w-80 lg:w-full rtl:pl-5 rtl:pr-11" />
            </div> --}}
        </div>

        <div class=" flex flex-col">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                        <table class="w-full min-w-full table-auto divide-y divide-gray-200 px-2 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-darkBg">
                                <tr class="dark:bg-gray-900">
                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Pembayar</span>
                                        </button>
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">NIK</span>
                                        </button>
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Pembayaran Bulan</span>
                                        </button>
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Pembayaran Tahun</span>
                                        </button>
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Jumlah Bayar</span>
                                        </button>
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 ps-5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 text-center dark:fill-gray-400">
                                            <span class="text-nowrap">Tanggal Bayar</span>
                                        </button>
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap"></span>
                                        </button>
                                    </th>
                                    <th scope="col" class="relative px-4 py-3.5">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-darkBg">
                                @foreach ($iuranInstances as $iuran)
                                    <tr>
                                        <td class="px-4 py-4 text-sm font-medium">
                                            <div>
                                                <h2
                                                    class=" inline gap-x-2 text-nowrap rounded-full bg-emerald-100/60 px-3 py-1 text-sm font-normal text-emerald-500 dark:bg-gray-800">
                                                    {{ $iuran->getNamaPembayar() }}
                                                </h2>
                                            </div>
                                        </td>

                                        <td class="px-4 py-4 align-middle text-sm">
                                            <h4 class="mx-1 text-gray-700 dark:text-gray-200">
                                                {{ $iuran->getNikPembayar() }}
                                            </h4>
                                        </td>

                                        <td class="px-4 py-4 text-sm">
                                            <p class="mx-1 text-nowrap text-sm text-gray-700 dark:text-gray-200">
                                                {{ $iuran->getBulan() }}
                                            </p>
                                        </td>

                                        <td class="px-4 py-4 text-sm">
                                            <p class="mx-1 text-nowrap text-sm text-gray-700 dark:text-gray-200">
                                                {{ $iuran->getTahun() }}
                                            </p>
                                        </td>

                                        <td class="px-4 py-4 text-sm">
                                            <p class="mx-1 text-nowrap text-sm text-green-600">
                                                Rp. {{ $iuran->getJumlahBayar() }}
                                            </p>
                                        </td>

                                        <td class="px-4 py-4 text-sm">
                                            <p
                                                class="inline gap-x-2 text-nowrap rounded-full dark:bg-gray-600/30 px-3 py-1 text-sm font-normal dark:text-gray-100 bg-gray-200/50 text-gray-500/70">
                                                {{ date('F, j-Y ', strtotime($iuran->getTanggalBayar())) }}
                                            </p>
                                        </td>

                                        <td class="flex px-4 py-4 pe-0 pe-4 ps-6 text-sm" id="action"
                                            x-data="{ modalEditOpen: false, modalDeleteOpen: false }">
                                            <button id="editButton" @click="modalEditOpen = !modalEditOpen"
                                                class="text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30 relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase transition-all disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                type="button"
                                                onclick="(function () {appendUpdateModal({{ $iuran }},event);window.utils.Request.actionRequest(`{{ route('rw.manage.iuran.update') }}`, '#editModal', '#editModalForm')})()">
                                                <span
                                                    class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transform">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        class="h-4 w-4 dark:fill-gray-200" fill="currentColor"
                                                        aria-hidden="true">
                                                        <path
                                                            d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </button>
                                            <button id="deleteButton" @click="modalDeleteOpen = !modalDeleteOpen"
                                                onclick="(function (){appendDeleteModal('{{ $iuran->getIdIuran() }}','{{ $iuran->getNamaPembayar() }}', '{{ $iuran->getBulan() }}', '{{ $iuran->getTahun() }}', event); window.utils.Request.actionRequest('{{ route('rw.manage.iuran.delete') }}', '#deleteModal', '#deleteModalForm');})()"
                                                class="text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30 relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase transition-all disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">

                                                <span
                                                    class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transform">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve"
                                                        class="h-4 w-4 fill-red-500" viewBox="0 0 24 24"
                                                        fill="currentColor" version="1.1">
                                                        <path
                                                            d="M21 4h-3.1C17.422 1.674 15.375 0.003 13 0h-2c-2.375 0.003 -4.422 1.674 -4.9 4H3c-0.552 0 -1 0.448 -1 1S2.448 6 3 6h1v13C4.003 21.76 6.24 23.997 9 24h6c2.76 -0.003 4.997 -2.24 5 -5V6H21c0.552 0 1 -0.448 1 -1S21.552 4 21 4M11 17c0 0.552 -0.448 1 -1 1 -0.552 0 -1 -0.448 -1 -1v-6c0 -0.552 0.448 -1 1 -1s1 0.448 1 1v6zm4 0c0 0.552 -0.448 1 -1 1s-1 -0.448 -1 -1v-6c0 -0.552 0.448 -1 1 -1S15 10.448 15 11zM8.171 4c0.425 -1.198 1.558 -1.998 2.829 -2h2c1.271 0.002 2.404 0.802 2.829 2z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </button>
                                            <!-- </form> -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{ $iuranInstances->links('elements.pagination') }}
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
        function appendDeleteModal(id, nama, bulan, tahun, event) {
            const modalDeleteElemen = /*html*/ `
        <div id="deleteModal" x-show="modalDeleteOpen" class="fixed inset-0 z-40 overflow-y-auto" aria-labelledby="modal-title"
             role="dialog" aria-modal="true">
             <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                 <div x-cloak @click="()=>{modalDeleteOpen = false;deleteModal('#deleteModal')}" x-show="modalDeleteOpen"
                     x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
                     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                     class="fixed inset-0 transition-opacity bg-gray-500/40 dark:bg-SecondaryBg/70" aria-hidden="true"></div>

                 <div x-cloak x-show="modalDeleteOpen" x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200 transform"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-SecondaryBg rounded-lg shadow-xl 2xl:max-w-2xl">
                     <div class="flex items-center justify-between space-x-4">
                         <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100">Hapus Iuran Warga</h1>

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
                         Menghapus iuran warga dari sistem
                     </p>

                     <form class="mt-5" id="deleteModalForm">
                         @csrf
                         <input type="text" name="id_iuran" value="${id}" hidden>
                         <h1 class="text-xl text-wrap dark:text-gray-100 tracking-wide">Apakah Anda Yakin Menghapus Iuran 
                            <span class="font-semibold text-rose-600 underline underline-offset-8">${nama}</span> Pada Bulan 
                            <span class="font-semibold text-rose-600 underline underline-offset-8">${bulan}, ${tahun}</span> </h1>
                         <div class="flex justify-end mt-6">
                            <x-button.delete-button title="Hapus Iuran">
                                        </x-button.delete-button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
        `
            $(modalDeleteElemen).insertAfter($(event.target).closest('#deleteButton'))

        }

        function appendUpdateModal(iuran, event) {
            const modalEditElemen = /*html*/ `
        <div id="editModal" x-show="modalEditOpen" class="fixed inset-0 z-40 overflow-y-auto" aria-labelledby="modal-title"
             role="dialog" aria-modal="true">
             <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                 <div x-cloak @click="()=>{modalEditOpen = false;deleteModal('#editModal')}" x-show="modalEditOpen"
                     x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
                     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                     class="fixed inset-0 transition-opacity  bg-gray-500/40 dark:bg-SecondaryBg/70" aria-hidden="true"></div>

                 <div x-cloak x-show="modalEditOpen" x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200 transform"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-SecondaryBg rounded-lg shadow-xl 2xl:max-w-2xl">
                     <div class="flex items-center justify-between space-x-4">
                         <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100  ">Edit Iuran Warga</h1>

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
                         Edit iuran warga di dalam sistem
                     </p>

                     @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach

                     <form class="mt-5" id="editModalForm">
                         @csrf
                         <input type="text" name="id_iuran" value="${iuran.id_iuran}" hidden >
                         <x-form.input-form title="NIK Pembayar" key="nik_pembayar" type="number" placeholder="1234567892322" value="${iuran.nik_pembayar}" readonly/>
                         <x-form.select-input-form title="Bulan Bayar" key="bulan" placeholder="Pilih Bulan Pembayaran Warga" :options="$bulanOptions" selected="${iuran.bulan}" />
                         <x-form.input-form title="Tahun Bayar" key="tahun" type="number" placeholder="Masukkan Tahun Pembayaran" value="${iuran.tahun}" />
                         <x-form.input-form title="Jumlah Bayar" key="jumlah_bayar" type="number" placeholder="100000" value='${iuran.jumlah_bayar}' readonly="true"/>

                         <div class="flex justify-between mt-6">
                             <p class="text-xs text-gray-200 dark:text-gray-400">Note: Pastikan semua sudah terisi dengan benar
                             </p>
                             <x-button.submit-button title="Simpan Iuran">
                                        </x-button.submit-button>
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
