{{-- extend to layouts/app --}}
@extends('layouts.sidebar.rw-sidebar')

{{-- content --}}
@section('content')
    <section class="container relative mx-auto mt-7 px-4" x-data="{ modalOpen: false }">

        <div class="flex flex-col">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <div class="flex items-center gap-x-3">
                        <h2 class="text-lg font-medium text-gray-800 dark:text-white">Properti</h2>
                        <span
                            class="rounded-full bg-gray-200/50  px-3 py-1 text-xs text-gray-400 dark:bg-gray-600/30 dark:text-gray-100">
                            {{ $propertiInstances->total() }} Properti
                        </span>
                    </div>

                    @if ($propertiInstances->sortByDesc('diperbarui_pada')->first())
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-300">
                            Data ini terakhir diupdate
                            {{ $propertiInstances->sortByDesc('diperbarui_pada')->first()?->getDiperbaruiPada()->diffForHumans(null, true) }}
                            yang lalu
                        </p>
                    @else
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                            Masih belum ada properti yang terdata
                        </p>
                    @endif
                </div>
                <div class="mt-4 flex gap-2">
                    <div class="md:items-right md:flex md:justify-between gap-x-3">
                        <form id="exportCSVForm" method="get" action="{{ route('rw.manage.properti.exportCSV') }}"
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

                    <div class="flex items-center gap-x-3" x-data="{ modalOpen: false }">
                        <x-button.add-button routeButton="{{ route('rw.manage.properti.new') }}" modalParent="#addModal"
                            modalForm="#addModalForm" multipartReq=false title="Tambah Properti">
                        </x-button.add-button>
                        {{-- <button id="addButton" @click="modalOpen = !modalOpen"
                            class="mb-2 flex shrink-0 items-center justify-center gap-x-2 text-nowrap rounded-lg bg-blue-500 px-5 py-2.5 text-sm tracking-wide text-white transition-colors duration-200 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-500 sm:w-auto"
                            onclick="window.utils.Request.actionRequest('{{ route('rw.manage.properti.new') }}', '#addModal', '#addModalForm')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                            <span>Tambah Properti</span>
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
                                    class="my-20 inline-block w-full max-w-xl transform overflow-hidden rounded-lg bg-white p-8 text-left shadow-xl transition-all dark:bg-darkBg 2xl:max-w-2xl">
                                    <div class="flex items-center justify-between space-x-4">
                                        <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100">
                                            Tambah Properti
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
                                        Tambah Properti ke dalam sistem
                                    </p>

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

                                    <form class="mt-5" id="addModalForm" action="{{ route('rw.manage.properti.new') }}"
                                        method="post">
                                        @csrf
                                        <x-form.input-form title="Nama Properti" key="nama_properti" type="text"
                                            placeholder="Nama Properti" />
                                        <x-form.search-dropdown title="Tipe Properti" key="id_tipe_properti"
                                            parent="#addModalForm" placeholder="Masukkan Tipe Properti"
                                            :items="$tipePropertiInstances"></x-form.search-dropdown>
                                        <x-form.search-dropdown title="Nama Pemilik" key="nik_pemilik"
                                            parent="#addModalForm" placeholder="Masukkan Nama Properti"
                                            :items="$nikPemilikInstances"></x-form.search-dropdown>
                                        <div class='mt-4'>
                                            <label for="display-nik_pemilik"
                                                class="block text-sm capitalize text-gray-700 dark:text-gray-300">NIK
                                                Pemilik</label>
                                            <input id="display-nik_pemilik" placeholder="nik_pemilik" type="text"
                                                value=""
                                                class="mt-2 block w-full rounded-md border border-gray-200 bg-white px-3 py-2 text-gray-600 placeholder-gray-400 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-300 dark:focus:ring-blue-200"
                                                readonly />
                                        </div>

                                        <x-form.textarea-input-form title="Alamat" key="alamat" placeholder="Alamat" />
                                        <x-form.input-form title="Luas Tanah (m2)" key="luas_tanah" type="text"
                                            placeholder="Luas Tanah" />
                                        <x-form.input-form title="Luas Bangunan (m2)" key="luas_bangunan" type="text"
                                            placeholder="Luas Bangunan" />
                                        <x-form.input-form title="Jumlah Kamar" key="jumlah_kamar" type="text"
                                            placeholder="Jumlah Kamar" />
                                        <x-form.input-form title="Mulai Dimiliki Pada" key="mulai_dimiliki_pada"
                                            type="date" placeholder="Mulai Dimiliki Pada" />
                                        <div class="mt-6 flex justify-between">
                                            <p class="text-xs text-gray-200 dark:text-gray-400">
                                                Note: Pastikan semua sudah terisi dengan benar
                                            </p>
                                            <x-button.submit-button title="Tambah Properti">
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
                <x-form.search-input placeholder="Tekan Enter Untuk Mencari Properti ...">

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
                    class="block rounded-lg border border-gray-200 bg-white py-1.5 pl-11 pr-5 text-gray-700 placeholder-gray-400/70 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-darkBg dark:text-gray-300 dark:focus:border-blue-300 md:w-80 lg:w-full rtl:pl-5 rtl:pr-11" />
            </div> --}}
        </div>

        <div class="mt-6 flex flex-col">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                        <table class="w-full min-w-full table-auto divide-y divide-gray-200 px-2 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-darkBg">
                                <tr class="dark:bg-gray-900">
                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Nama Properti</span>
                                        </button>
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Tipe</span>
                                        </button>
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Pemilik</span>
                                        </button>
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 ps-5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 text-center dark:fill-gray-400">
                                            <span class="text-nowrap">Jumlah Kamar</span>
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
                                @foreach ($propertiInstances as $properti)
                                    <tr>
                                        <td class="px-4 py-4 text-sm font-medium">
                                            <div>
                                                <h2 class="text-nowrap font-medium text-gray-800 dark:text-white">
                                                    {{ $properti->getNamaProperti() }}
                                                </h2>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-sm">
                                            <div>
                                                <h4 class="text-gray-700 dark:text-gray-200">
                                                    {{ $properti->getTipeProperti()->getNamaTipe() }}
                                                </h4>
                                            </div>
                                        </td>
                                        <td class="text-nowrap px-4 py-4 text-sm font-medium">
                                            <div
                                                class="inline gap-x-2 rounded-full bg-emerald-100/60 px-3 py-1 text-sm font-normal text-emerald-500 dark:bg-gray-800">
                                                {{ $properti->getPemilik()->getNamaLengkap() }}
                                            </div>
                                        </td>

                                        <td class="px-4 py-4 text-sm">
                                            <p class="text-center dark:text-gray-200">
                                                {{ $properti->getJumlahKamar() }}
                                            </p>
                                        </td>

                                        <td class="flex px-4 py-4 pe-0 pe-4 ps-6 text-sm" id="action"
                                            x-data="{ modalEditOpen: false, modalDeleteOpen: false }">
                                            <button id="editButton" @click="modalEditOpen = !modalEditOpen"
                                                class="text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30 relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase transition-all disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                type="button"
                                                onclick="(function () {appendUpdateModal({{ $properti }},event);window.utils.Request.actionRequest(`{{ route('rw.manage.properti.update') }}`, '#editModal', '#editModalForm')})()">
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
                                                onclick="(function (){appendDeleteModal({{ $properti }}, event);window.utils.Request.actionRequest(`{{ route('rw.manage.properti.delete') }}`, '#deleteModal', '#deleteModalForm')})()"
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

        {{ $propertiInstances->links('elements.pagination') }}
        <div class="">

        </div>

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
        function appendImageModal(img_url, nama, event) {
            const modalImageElement = /*html*/ `
                <div id="imageModal" x-show="showImage" class="fixed inset-0 z-40 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                                <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                                                    <div x-cloak @click="()=>{showImage = false;deleteModal('#imageModal')}" x-show="showImage" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity  bg-gray-500/40 dark:bg-SecondaryBg/70" aria-hidden="true"></div>

                                                    <div x-cloak x-show="showImage" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-darkBg rounded-lg shadow-xl 2xl:max-w-2xl">
                                                        <div class="flex items-center justify-between space-x-4">
                                                            <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100  ">Gambar Properti</h1>

                                                            <button @click="()=>{showImage = false;setTimeout(deleteModal('#imageModal'),3000)}" class="text-gray-600 dark:text-gray-400 focus:outline-none hover:text-gray-700 dark:hover:text-gray-500">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                            </button>
                                                        </div>

                                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                                            Gambar dari Properti ${nama}
                                                        </p>
                                                        <div class="mt-7">
                                                            <img src="${img_url}" alt="">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                `
            $(modalImageElement).insertAfter($(event.target).closest('#imageButton'))

        }

        function appendDeleteModal(properti, event) {
            const modalDeleteElemen = /*html*/ `
                <div id="deleteModal" x-show="modalDeleteOpen" class="fixed inset-0 z-40 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                            <div x-cloak @click="()=>{modalDeleteOpen = false;deleteModal('#deleteModal')}" x-show="modalDeleteOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500/40 dark:bg-SecondaryBg/70" aria-hidden="true"></div>

                            <div x-cloak x-show="modalDeleteOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-darkBg rounded-lg shadow-xl 2xl:max-w-2xl">
                                <div class="flex items-center justify-between space-x-4">
                                    <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100">Delete Properti</h1>

                                    <button @click="()=>{modalDeleteOpen = false;deleteModal('#deleteModal')}" class="text-gray-600 dark:text-gray-400 focus:outline-none hover:text-gray-700 dark:hover:text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>

                                <p class="mt-2 text-sm text-gray-500 ">
                                    Menghapus Properti dari sistem
                                </p>


                                <form class="mt-5" id="deleteModalForm">
                                    @csrf
                                    <input type="text" name="id_properti" value="${properti.id_properti}" hidden >
                                    <h1 class="text-xl text-wrap dark:text-gray-100 tracking-wide">Apakah Anda Yakin Menghapus Properti <span class="font-semibold text-rose-600 underline underline-offset-8">${properti.nama_properti}</span>
                                    Milik <span class="font-semibold text-rose-600 underline underline-offset-8">${properti.pemilik.nama_depan} ${properti.pemilik.nama_belakang}</span> </h1>              
                                    <div class="flex justify-end mt-6">
                                        <x-button.delete-button title="Hapus Properti">
                                        </x-button.delete-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                `
            $(modalDeleteElemen).insertAfter($(event.target).closest('#deleteButton'))

        }

        function appendUpdateModal(properti, event) {
            const modalEditElemen = /*html*/ `
                <div id="editModal" x-show="modalEditOpen" class="fixed inset-0 z-40 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                            <div x-cloak @click="()=>{modalEditOpen = false;deleteModal('#editModal')}" x-show="modalEditOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity  bg-gray-500/40 dark:bg-SecondaryBg/70" aria-hidden="true"></div>

                            <div x-cloak x-show="modalEditOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-darkBg rounded-lg shadow-xl 2xl:max-w-2xl">
                                <div class="flex items-center justify-between space-x-4">
                                    <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100  ">Edit Properti User</h1>

                                    <button @click="()=>{modalEditOpen = false;deleteModal('#editModal')}" class="text-gray-600 dark:text-gray-400 focus:outline-none hover:text-gray-700 dark:hover:text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>

                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    Edit Properti di dalam sistem
                                </p>


                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach

                                <form class="mt-5" id="editModalForm" action="{{ route('rw.manage.properti.update') }}" method="post">
                                    @csrf
                                    <input type="text" name="id_properti" value="${properti.id_properti}" hidden >
                                    <x-form.input-form title="Nama Properti" key="nama_properti" type="text" placeholder="Nama Properti" value="${properti.nama_properti}" />
                                    <x-form.search-dropdown title="Tipe Properti" key="id_tipe_properti" parent="#editModal"
                                            placeholder="Masukkan Tipe Properti" :items="$tipePropertiInstances" value="${properti.tipe_properti.nama_tipe}">
                                    </x-form.search-dropdown>
                                    <x-form.search-dropdown title="Nama Pemilik" key="nik_pemilik" parent="#editModal"
                                            placeholder="Masukkan Nama Properti" :items="$nikPemilikInstances" value="${properti.pemilik.nama_depan} ${properti.pemilik.nama_belakang}"></x-form.search-dropdown>
                                    <div class='mt-4'>
                                    <label for="nik_pemilik"
                                                class="block text-sm capitalize text-gray-700 dark:text-gray-300">NIK
                                                Pemilik</label>
                                    <input id="display-nik_pemilik" placeholder="nik_pemilik" type="text" value=""
                                                class="mt-2 block w-full rounded-md border border-gray-200 bg-white px-3 py-2 text-gray-600 placeholder-gray-400 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-300 dark:focus:ring-blue-200"
                                                readonly />
                                    </div>
                                    <x-form.textarea-input-form title="Alamat" key="alamat" placeholder="Alamat"  value="${properti.alamat}" />
                                    <x-form.input-form title="Luas Tanah (m2)" key="luas_tanah" type="text" placeholder="Luas Tanah"  value="${properti.luas_tanah}" />
                                    <x-form.input-form title="Luas Bangunan (m2)" key="luas_bangunan" type="text" placeholder="Luas Bangunan"  value="${properti.luas_bangunan}" />
                                    <x-form.input-form title="Jumlah Kamar" key="jumlah_kamar" type="text" placeholder="Jumlah Kamar" value="${properti.jumlah_kamar}" />
                                    <x-form.input-form title="Mulai Dimiliki Pada" key="mulai_dimiliki_pada" type="date" placeholder="Mulai Dimiliki Pada" value="${properti.mulai_dimiliki_pada}" />
                                    <div class="flex justify-between mt-6">
                                        <p class="text-xs text-gray-200 dark:text-gray-400">Note: Pastikan semua sudah terisi dengan benar</p>
                                        <x-button.submit-button title="Simpan Properti">
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
