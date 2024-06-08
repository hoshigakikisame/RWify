@extends(request()->user()->getSidebarView())
@php
    $status = \App\Enums\Pengaduan\PengaduanStatusEnum::getValues();
@endphp

@section('content')
    <section class="container relative mx-auto mt-7 px-4" x-data="{ modalOpen: false }">
        <div class="flex flex-col">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <div class="flex items-center gap-x-3">
                        <h2 class="text-lg font-medium text-gray-800 dark:text-white">Pengaduan</h2>
                        <span
                            class="rounded-full dark:bg-gray-600/30 px-3 py-1 text-xs dark:text-gray-100 bg-gray-200/50 text-gray-400">
                            {{ $count }} Pengaduan
                        </span>
                    </div>

                    @if ($pengaduanInstances->sortByDesc('diperbarui_pada')->first())
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                            Data ini terakhir diupdate
                            {{ $pengaduanInstances->sortByDesc('diperbarui_pada')->first()?->getDiperbaruiPada()->diffForHumans(null, true) }}
                            yang lalu
                        </p>
                    @else
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                            Masih belum ada pengaduan yang diajukan
                        </p>
                    @endif
                </div>
            </div>
            <div class="mt-6 md:flex md:items-center md:justify-between">
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

                    @foreach (\App\Enums\Pengaduan\PengaduanStatusEnum::getValues() as $key => $value)
                        <button id="filter-{{ $key }}"
                            onclick="window.utils.Request.filterRequest({'status': '{{ $value }}'})"
                            x-effect="let params = new URLSearchParams(window.location.search); params.has('filters[status]') && params.get('filters[status]') == '{{ $value }}' ? $('#filter-{{ $key }}').addClass('!text-blue-400') : $('#filter-{{ $key }}').removeClass('!text-blue-400')"
                            class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 sm:text-sm">
                            {{ $value }}
                        </button>
                    @endforeach
                </div>
                <div id="search" class="relative mt-4 flex items-center md:mt-0" x-data="{ search: '' }">
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
                </div>
            </div>
        </div>

        <div class="mt-6 flex flex-col">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                        <table class="w-full min-w-full table-auto divide-y divide-gray-200 px-2 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-darkBg">
                                <tr>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Pengadu</span>
                                        </button>
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Judul</span>
                                        </button>
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Isi</span>
                                        </button>
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Tanggal</span>
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
                                        <button class="mx-auto flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Status</span>
                                        </button>
                                    </th>
                                    <th scope="col" class="relative px-4 py-3.5">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-darkBg">
                                @foreach ($pengaduanInstances as $pengaduan)
                                    <tr>
                                        <td class="px-4 py-4 text-sm font-medium">
                                            <div>
                                                <h2
                                                    class="inline gap-x-2 text-nowrap rounded-full bg-emerald-100/60 px-3 py-1 text-sm font-normal text-emerald-500 dark:bg-darkBg">
                                                    {{ $pengaduan->getNamaPengadu() }}
                                                </h2>
                                            </div>
                                        </td>

                                        <td class="px-4 py-4 align-middle text-sm">
                                            <h4 class="w-[200px] text-gray-700 dark:text-gray-200">
                                                {{ $pengaduan->getJudul() }}
                                            </h4>
                                        </td>

                                        <td class="px-4 py-4 align-top text-sm">
                                            <h4 class="text-gray-700 dark:text-gray-200">
                                                {{ implode(' ', array_slice(str_word_count($pengaduan->getIsi(), 1), 0, 13)) }}
                                                {{ str_word_count($pengaduan->getIsi()) > 10 ? '.....' : '' }}
                                            </h4>
                                        </td>

                                        <td class="px-4 py-4 text-sm">
                                            <p class=" text-nowrap text-xs text-blue-600">
                                                {{ date('F, j-Y ', strtotime($pengaduan->getDibuatPada())) }}
                                            </p>
                                        </td>

                                        <td class="px-4 py-4 text-center" x-data="{ showImage: false }">
                                            <button id="imageButton"
                                                class="text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30 relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase transition-all disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                type="button" @click="showImage = !showImage"
                                                onclick="(function () {appendImageModal('{{ $pengaduan->getImageUrl() }}','{{ $pengaduan->getJudul() }}',event);})()">
                                                <span
                                                    class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transform">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-6 w-6 fill-blue-700 dark:fill-blue-400"
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
                                            <span
                                                class="@php
$statusStyle = ["baru" => "bg-blue-50 text-blue-700 ring-blue-700/10 dark:bg-blue-950 dark:text-blue-200", "diproses" => "bg-yellow-50 text-yellow-800 ring-yellow-600/20 dark:bg-yellow-950 dark:text-yellow-200", "invalid" => "bg-red-50 text-red-700 ring-red-600/10 dark:bg-red-950 dark:text-red-300", "selesai" => "bg-green-50 text-green-700 ring-green-600/20 dark:bg-green-950 dark:text-green-300"];
                                                $dotStyle = ["baru" => "bg-blue-500 dark:bg-blue-300", "diproses" => "bg-yellow-500 dark:bg-yellow-300", "invalid" => "bg-red-500 dark:bg-red-300", "selesai" => "bg-green-500 dark:bg-green-300"]; @endphp @if ($pengaduan->getStatus()) {{ $statusStyle[$pengaduan->getStatus()] }}
                                                @else
                                                    bg-gray-50
                                                    text-gray-600
                                                    ring-gray-500/10 @endif mx-1 inline-flex w-56 w-fit items-center justify-center rounded-full px-3 py-1.5 text-sm 2xl:w-full">
                                                <span
                                                    class="@if ($pengaduan->getStatus()) {{ $dotStyle[$pengaduan->getStatus()] }}
                                                    @else
                                                        bg-gray-50 @endif me-1 inline-block rounded-full p-[5px]"></span>
                                                <span class="text-xs">
                                                    {{ $pengaduan->getStatus() }}
                                                </span>
                                            </span>
                                        </td>

                                        <td class="pb-2 w-20" id="action" x-data="{ modalEditOpen: false, modalDeleteOpen: false }">
                                            <a class="text-blue-gray-500 hover:bg-blue-gray-500/10 pe-5 active:bg-blue-gray-500/30 relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase transition-all disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                target="_blank"
                                                href="{{ route('layanan.pengaduan.detail', ['idPengaduan' => $pengaduan->getIdPengaduan()]) }}">
                                                <span
                                                    class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 transform">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-blue-500"
                                                        viewBox="0 0 28 28" fill="currentColor">
                                                        <path
                                                            d="M25.257 16h.005h-.01zm-.705-.52c.1.318.387.518.704.52c.07 0 .148-.02.226-.04c.39-.12.61-.55.48-.94C25.932 14.93 22.932 6 14 6S2.067 14.93 2.037 15.02c-.13.39.09.81.48.94c.4.13.82-.09.95-.48l.003-.005c.133-.39 2.737-7.975 10.54-7.975c7.842 0 10.432 7.65 10.542 7.98M9 16a5 5 0 1 1 10 0a5 5 0 0 1-10 0" />
                                                    </svg>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{ $pengaduanInstances->links('elements.pagination') }}
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
        function appendImageModal(img_url, judul, event) {
            const modalImageElement = /*html*/ `
                <div id="imageModal" x-show="showImage" class="fixed inset-0 z-40 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                                <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                                                    <div x-cloak @click="()=>{showImage = false;deleteModal('#imageModal')}" x-show="showImage" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity  bg-gray-500/40 dark:bg-darkBg/40" aria-hidden="true"></div>

                                                    <div x-cloak x-show="showImage" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-darkBg rounded-lg shadow-xl 2xl:max-w-2xl">
                                                        <div class="flex items-center justify-between space-x-4">
                                                            <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100  ">Bukti Gambar Pengaduan</h1>

                                                            <button @click="()=>{showImage = false;setTimeout(deleteModal('#imageModal'),3000)}" class="text-gray-600 dark:text-gray-400 focus:outline-none hover:text-gray-700 dark:hover:text-gray-500">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                            </button>
                                                        </div>

                                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                                            Gambar dari Pengaduan ${judul}
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

        function appendDeleteModal(id_pengaduan, judul, event) {
            const modalDeleteElemen = /*html*/ `
                <div id="deleteModal" x-show="modalDeleteOpen" class="fixed inset-0 z-40 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                            <div x-cloak @click="()=>{modalDeleteOpen = false;deleteModal('#deleteModal')}" x-show="modalDeleteOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500/40 dark:bg-darkBg/40" aria-hidden="true"></div>

                            <div x-cloak x-show="modalDeleteOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-darkBg rounded-lg shadow-xl 2xl:max-w-2xl">
                                <div class="flex items-center justify-between space-x-4">
                                    <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100">Delete Pengaduan</h1>

                                    <button @click="()=>{modalDeleteOpen = false;deleteModal('#deleteModal')}" class="text-gray-600 dark:text-gray-400 focus:outline-none hover:text-gray-700 dark:hover:text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>

                                <p class="mt-2 text-sm text-gray-500 ">
                                    Menghapus Pengaduan dari sistem
                                </p>


                                <form class="mt-5" id="deleteModalForm">
                                    @csrf
                                    <input type="text" name="id_pengaduan" value="${id_pengaduan}" hidden >
                                    <h1 class="text-xl text-wrap dark:text-gray-100 tracking-wide">Apakah Anda Yakin Menghapus Pengaduan <span class="font-semibold text-rose-600 underline underline-offset-8">${judul}</span> </h1>              
                                    <div class="flex justify-end mt-6">
                                        <button type="submit" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-500 rounded-md dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700 hover:bg-blue-600 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                            Delete Pengaduan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                `
            $(modalDeleteElemen).insertAfter($(event.target).closest('#deleteButton'))

        }

        function appendUpdateModal(pengaduan, event) {
            const modalEditElemen = /*html*/ `
                <div id="editModal" x-show="modalEditOpen" class="fixed inset-0 z-40 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                            <div x-cloak @click="()=>{modalEditOpen = false;deleteModal('#editModal')}" x-show="modalEditOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity  bg-gray-500/40 dark:bg-darkBg/40" aria-hidden="true"></div>

                            <div x-cloak x-show="modalEditOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-darkBg rounded-lg shadow-xl 2xl:max-w-2xl">
                                <div class="flex items-center justify-between space-x-4">
                                    <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100  ">Edit Pengaduan</h1>

                                    <button @click="()=>{modalEditOpen = false;deleteModal('#editModal')}" class="text-gray-600 dark:text-gray-400 focus:outline-none hover:text-gray-700 dark:hover:text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>

                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    Edit Pengaduan di dalam sistem
                                </p>


                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach

                                <form enctype="multipart/form-data" class="mt-5" id="editModalForm" action="{{ route('rw.manage.pengaduan.update') }}" method="post">
                                    @csrf
                                    <input type="text" name="id_pengaduan" value="${pengaduan.id_pengaduan}" hidden >
                                    <x-form.input-form title="NIK Pengadu" key="nik_pengadu" type="text" placeholder="NIK Pengadu" value="${pengaduan.nik_pengadu}" />
                                    <x-form.input-form title="Judul" key="judul" type="text" placeholder="Judul"  value="${pengaduan.judul}" />
                                    <x-form.textarea-input-form title="Isi" key="isi" placeholder="Isi"  value="${pengaduan.isi}" />
                                    <x-form.select-input-form title="Status" key="status" :options="$status" placeholder="Pilih Status Pengaduan" selected="${pengaduan.status}" />
                                    <x-form.input-image id="imageupdate" title="Gambar" key="image" placeholder="Gambar" value="${pengaduan.image_url}" />

                                    <div class="flex justify-between mt-6">
                                        <p class="text-xs text-gray-200 dark:text-gray-400">Note: Pastikan semua sudah terisi dengan benar</p>
                                        <button type="submit" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-500 rounded-md dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700 hover:bg-blue-600 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                            Save Pengaduan
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
