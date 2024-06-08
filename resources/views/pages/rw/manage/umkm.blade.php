{{-- extend to layouts/app --}}
@extends('layouts.sidebar.rw-sidebar')

{{-- content --}}
@section('content')
    <section class="container relative mx-auto mt-7 px-4" x-data="{ modalOpen: false }">
        <div class="mb-6">
            <div class="flex flex-col">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <div class="header">
                        <div class="flex items-center gap-x-3">
                            <h2 class="text-lg font-medium text-gray-800 dark:text-white">UMKM</h2>
                            <span
                                class="rounded-full bg-gray-200/50 px-3 py-1 text-xs text-gray-400 dark:bg-gray-600/30 dark:text-gray-100">
                                {{ $umkmInstances->total() }} UMKM
                            </span>
                        </div>

                        @if ($umkmInstances->sortByDesc('diperbarui_pada')->first())
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                                Data ini terakhir diupdate
                                {{ $umkmInstances->sortByDesc('diperbarui_pada')->first()->getDiperbaruiPada()->diffForHumans(null, true) }}
                                yang lalu
                            </p>
                        @else
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                                Masih belum ada data UMKM yang terdaftar
                            </p>
                        @endif
                    </div>

                    <div class="md:items-right md:flex md:justify-between">
                        <div class="mt-4 flex items-center gap-x-3" x-data="{ modalOpen: false }">
                            <x-button.add-button routeButton="{{ route('rw.manage.umkm.new') }}" modalParent="#addModal"
                                modalForm="#addModalForm" multipartReq=true title="Tambah UMKM">
                            </x-button.add-button>
                            {{-- <button
                            id="addButton"
                            @click="modalOpen = !modalOpen"
                            class="mb-2 flex shrink-0 items-center justify-center gap-x-2 text-nowrap rounded-lg bg-blue-500 px-5 py-2.5 text-sm tracking-wide text-white transition-colors duration-200 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-500 sm:w-auto"
                            onclick="window.utils.Request.actionRequest('{{ route('rw.manage.umkm.new') }}', '#addModal', '#addModalForm',true)"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>

                            <span>Tambah UMKM</span>
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
                                        class="fixed inset-0 bg-gray-500/40 transition-opacity dark:bg-darkBg/40"
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
                                                Tambah UMKM
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
                                            Tambah UMKM ke dalam sistem
                                        </p>

                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach

                                        <form enctype="multipart/form-data" class="mt-5" id="addModalForm"
                                            action="{{ route('rw.manage.umkm.new') }}" method="post">
                                            @csrf
                                            <input type="text" name="id_umkm" hidden />
                                            <x-form.input-form title="Nama UMKM" key="nama" type="text"
                                                placeholder="UMKM" />
                                            <x-form.input-form title="Nama Pemilik" key="nama_pemilik" type="text"
                                                placeholder="Nama Pemilik UMKM" />
                                            <x-form.input-form title="No. Telepon" key="telepon" type="text"
                                                placeholder="08138237822" />
                                            <x-form.textarea-input-form title="Alamat" key="alamat"
                                                placeholder="Alamat UMKM" />
                                            <x-form.input-form title="Maps URL" key="map_url" type="text"
                                                placeholder="Maps URL UMKM" />
                                            <x-form.input-form title="Instagram URL" key="instagram_url" type="text"
                                                placeholder="Instagram URL UMKM" />
                                            <x-form.textarea-input-form title="Deskripsi" key="deskripsi"
                                                placeholder="Deskripsi tentang UMKM" />
                                            <x-form.input-image id="imageadd" title="Gambar UMKM" key="image"
                                                placeholder="Gambar UMKM" />

                                            <div class="mt-6 flex justify-between">
                                                <p class="text-xs text-gray-200 dark:text-gray-400">
                                                    Note: Pastikan semua sudah terisi dengan benar
                                                </p>
                                                <button type="submit"
                                                    class="transform rounded-md bg-blue-500 px-3 py-2 text-sm capitalize tracking-wide text-white transition-colors duration-200 hover:bg-blue-600 focus:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700">
                                                    Save UMKM
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="mt-4 w-1/3 ml-auto">
                    <x-form.search-input placeholder="Tekan Enter Untuk Mencari UMKM ...">

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
        </div>

        <div class="flex flex-col">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                        <table class="w-full min-w-full table-auto divide-y divide-gray-200 px-2 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-darkBg">
                                <tr>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Nama UMKM</span>
                                        </button>
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Pemilik</span>
                                        </button>
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">No Telp</span>
                                        </button>
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 ps-5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 text-center dark:fill-gray-400">
                                            <span class="text-nowrap">Gambar</span>
                                        </button>
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Alamat</span>
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
                                @foreach ($umkmInstances as $umkm)
                                    <tr>
                                        <td class="px-4 py-4 text-sm font-medium">
                                            <div>
                                                <h2
                                                    class="w-[200px] truncate text-nowrap font-medium text-gray-800 dark:text-white">
                                                    {{ $umkm->getNama() }}
                                                </h2>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-sm font-medium">
                                            <div
                                                class="inline gap-x-2 rounded-full bg-emerald-100/60 px-3 py-1 text-sm font-normal text-emerald-500 dark:bg-emerald-950">
                                                {{ $umkm->getNamaPemilik() }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-sm">
                                            <div>
                                                <h4 class="text-gray-700 dark:text-gray-200">
                                                    {{ $umkm->getTelepon() }}
                                                </h4>
                                            </div>
                                        </td>

                                        <td class="px-4 py-4 text-center" x-data="{ showImage: false }">
                                            <button id="imageButton"
                                                class="text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30 relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase transition-all disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                type="button" @click="showImage = !showImage"
                                                onclick="(function () {appendImageModal('{{ $umkm->getImageUrl() }}','{{ $umkm->getNama() }}',event);})()">
                                                <span
                                                    class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transform">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-6 w-6 fill-ColorButton dark:fill-ColorHover"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M16.25 2.75h-8.5A5.76 5.76 0 0 0 2 8.5v7a5.76 5.76 0 0 0 5.75 5.75h8.5A5.76 5.76 0 0 0 22 15.5v-7a5.76 5.76 0 0 0-5.75-5.75M8 6.1a2.41 2.41 0 1 1-.922 4.635A2.41 2.41 0 0 1 8.01 6.1zm12.5 6.68l-2.18-1.69a3.26 3.26 0 0 0-4.17.37l-2.33 2.33a3 3 0 0 1-3.72.36a1.48 1.48 0 0 0-.94-.24a1.46 1.46 0 0 0-.88.42l-2.43 2.84a4.25 4.25 0 0 1-.35-1.91l1.68-1.95a3 3 0 0 1 3.76-.41a1.43 1.43 0 0 0 1.82-.18l2.33-2.32a4.77 4.77 0 0 1 6.13-.51l1.28 1z" />
                                                        <path fill="currentColor"
                                                            d="M8.91 8.51a.91.91 0 1 1-1.82 0a.91.91 0 0 1 1.82 0" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </td>

                                        <td class="px-4 py-4 text-sm">
                                            <p class=".. w-52 truncate dark:text-gray-200 2xl:w-full">
                                                {{ $umkm->getAlamat() }}
                                            </p>
                                        </td>

                                        <td class="flex px-4 py-4 pe-0 ps-6 text-sm" id="action"
                                            x-data="{ modalEditOpen: false, modalDeleteOpen: false }">
                                            <a id="detailButton"
                                                class="text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30 relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase transition-all disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                target="_blank"
                                                href="{{ route('informasi.umkmPage', ['#umkm-' . $umkm->getIdUmkm()]) }}">
                                                <span
                                                    class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transform">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-6 w-6 fill-ColorButton" viewBox="0 0 28 28"
                                                        fill="currentColor">
                                                        <path
                                                            d="M25.257 16h.005h-.01zm-.705-.52c.1.318.387.518.704.52c.07 0 .148-.02.226-.04c.39-.12.61-.55.48-.94C25.932 14.93 22.932 6 14 6S2.067 14.93 2.037 15.02c-.13.39.09.81.48.94c.4.13.82-.09.95-.48l.003-.005c.133-.39 2.737-7.975 10.54-7.975c7.842 0 10.432 7.65 10.542 7.98M9 16a5 5 0 1 1 10 0a5 5 0 0 1-10 0" />
                                                    </svg>
                                                </span>
                                            </a>
                                            <button id="editButton" @click="modalEditOpen = !modalEditOpen"
                                                class="text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30 relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase transition-all disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                type="button"
                                                onclick="(function () {appendUpdateModal({{ $umkm }},event);window.utils.Request.actionRequest(`{{ route('rw.manage.umkm.update') }}`, '#editModal', '#editModalForm',true)})()">
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
                                                onclick="(function (){appendDeleteModal('{{ $umkm->getIdUmkm() }}','{{ $umkm->getNama() }}',event);window.utils.Request.actionRequest(`{{ route('rw.manage.umkm.delete') }}`, '#deleteModal', '#deleteModalForm')})()"
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

        {{ $umkmInstances->onEachSide(0)->links('elements.pagination') }}
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
                                                    <div x-cloak @click="()=>{showImage = false;deleteModal('#imageModal')}" x-show="showImage" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity  bg-gray-500/40 dark:bg-darkBg/40" aria-hidden="true"></div>

                                                    <div x-cloak x-show="showImage" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-darkBg rounded-lg shadow-xl 2xl:max-w-2xl">
                                                        <div class="flex items-center justify-between space-x-4">
                                                            <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100  ">Gambar UMKM</h1>

                                                            <button @click="()=>{showImage = false;setTimeout(deleteModal('#imageModal'),3000)}" class="text-gray-600 dark:text-gray-400 focus:outline-none hover:text-gray-700 dark:hover:text-gray-500">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                            </button>
                                                        </div>

                                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                                            Gambar dari UMKM ${nama}
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

        function appendDeleteModal(id_umkm, nama, event) {
            const modalDeleteElemen = /*html*/ `
                <div id="deleteModal" x-show="modalDeleteOpen" class="fixed inset-0 z-40 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                            <div x-cloak @click="()=>{modalDeleteOpen = false;deleteModal('#deleteModal')}" x-show="modalDeleteOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500/40 dark:bg-darkBg/40" aria-hidden="true"></div>

                            <div x-cloak x-show="modalDeleteOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-darkBg rounded-lg shadow-xl 2xl:max-w-2xl">
                                <div class="flex items-center justify-between space-x-4">
                                    <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100">Delete UMKM</h1>

                                    <button @click="()=>{modalDeleteOpen = false;deleteModal('#deleteModal')}" class="text-gray-600 dark:text-gray-400 focus:outline-none hover:text-gray-700 dark:hover:text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>

                                <p class="mt-2 text-sm text-gray-500 ">
                                    Menghapus UMKM dari sistem
                                </p>


                                <form class="mt-5" id="deleteModalForm">
                                    @csrf
                                    <input type="text" name="id_umkm" value="${id_umkm}" hidden >
                                    <h1 class="text-xl text-wrap dark:text-gray-100 tracking-wide">Apakah Anda Yakin Menghapus <span class="font-semibold text-rose-600 underline underline-offset-8">${nama}</span> </h1>              
                                    <div class="flex justify-end mt-6">
                                        <button type="submit" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-500 rounded-md dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700 hover:bg-blue-600 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                            Delete UMKM
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                `
            $(modalDeleteElemen).insertAfter($(event.target).closest('#deleteButton'))

        }

        function appendUpdateModal(umkm, event) {
            const modalEditElemen = /*html*/ `
                <div id="editModal" x-show="modalEditOpen" class="fixed inset-0 z-40 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                            <div x-cloak @click="()=>{modalEditOpen = false;deleteModal('#editModal')}" x-show="modalEditOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity  bg-gray-500/40 dark:bg-darkBg/40" aria-hidden="true"></div>

                            <div x-cloak x-show="modalEditOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-darkBg rounded-lg shadow-xl 2xl:max-w-2xl">
                                <div class="flex items-center justify-between space-x-4">
                                    <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100  ">Edit UMKM User</h1>

                                    <button @click="()=>{modalEditOpen = false;deleteModal('#editModal')}" class="text-gray-600 dark:text-gray-400 focus:outline-none hover:text-gray-700 dark:hover:text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>

                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    Edit UMKM di dalam sistem
                                </p>


                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach

                                <form enctype="multipart/form-data" class="mt-5" id="editModalForm" action="{{ route('rw.manage.umkm.update') }}" method="post">
                                    @csrf
                                    <input type="text" name="id_umkm" value="${umkm.id_umkm}" hidden >
                                    <x-form.input-form title="Nama UMKM" key="nama" type="text" placeholder="UMKM" value="${umkm.nama}" />
                                    <x-form.input-form title="Nama Pemilik" key="nama_pemilik" type="text" placeholder="Pemilik"  value="${umkm.nama_pemilik}" />
                                    <x-form.input-form title="No. Telepon" key="telepon" type="text" placeholder="1234567892322"  value="${umkm.telepon}" />
                                    <x-form.textarea-input-form title="Alamat" key="alamat" placeholder="Jl Brawijaya no 14"  value="${umkm.alamat}" />
                                    <x-form.input-form title="Maps URL" key="map_url" type="text" placeholder="Maps"  value="${umkm.map_url}"  />
                                    <x-form.input-form title="Instagram URL" key="instagram_url" type="text" placeholder="Instagram"  value="${umkm.instagram_url}" />
                                    <x-form.textarea-input-form title="Deskripsi" key="deskripsi" placeholder="Deskripsi"  value="${umkm.deskripsi}" />
                                    <x-form.input-image id="imageupdate" title="Gambar" key="image" placeholder="Gambar"  value="${umkm.image_url}" />

                                    <div class="flex justify-between mt-6">
                                        <p class="text-xs text-gray-200 dark:text-gray-400">Note: Pastikan semua sudah terisi dengan benar</p>
                                        <button type="submit" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-500 rounded-md dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700 hover:bg-blue-600 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                            Save UMKM
                                        </button>
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
