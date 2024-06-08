@extends(request()->user()->getSidebarView())
@section('content')
    <section class="container relative mx-auto mt-7 px-4" x-data="{ modalOpen: false }">
        <div class="flex flex-col">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <div class="flex items-center gap-x-3">
                        <h2 class="text-lg font-medium text-gray-800 dark:text-white">Riwayat Pembayaran Iuran</h2>
                        <span
                            class="rounded-full dark:bg-gray-600/30 px-3 py-1 text-xs dark:text-gray-100 bg-gray-200/50 text-gray-400">
                            {{ $count }} Pembayaran Iuran
                        </span>
                    </div>
                    <div class="flex items-center gap-x-3"></div>
                    @if ($pembayaranIuranInstances->sortByDesc('diperbarui_pada')->first())
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-300">
                            Data ini terakhir diupdate
                            {{ $pembayaranIuranInstances->sortByDesc('diperbarui_pada')->first()?->getDiperbaruiPada()->diffForHumans(null, true) }}
                            yang lalu
                        </p>
                    @else
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                            Masih belum ada pembayaranIuran yang diajukan
                        </p>
                    @endif
                </div>
            </div>
            <div class="w-1/3 self-end">
                <x-form.search-input placeholder="Tekan Enter Untuk Mencari Riwayat ...">
    
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
                                            <span class="text-nowrap">Pembayar</span>
                                        </button>
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Tanggal Bayar</span>
                                        </button>
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Image</span>
                                        </button>
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Keterangan</span>
                                        </button>
                                    </th>
                                    {{--
                                        <th scope="col" class="relative py-3.5 px-4">
                                        <span class="sr-only">Edit</span>
                                        </th>
                                    --}}
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-darkBg">
                                @foreach ($pembayaranIuranInstances as $pembayaranIuran)
                                    <tr>
                                        <td class="px-4 py-4 text-sm font-medium">
                                            <div>
                                                <h2
                                                <h2 class="inline gap-x-2 rounded-full bg-emerald-100/60 px-3 py-1 text-sm font-normal text-emerald-500 dark:bg-gray-800">
                                                    {{ $pembayaranIuran->getNamaPembayar() }}
                                                </h2>
                                            </div>
                                        </td>

                                        <td class="px-4 py-4 text-sm">
                                            <p class="inline gap-x-2 rounded-full dark:bg-gray-600/30 px-3 py-1 text-sm dark:text-gray-100 bg-gray-200/50 text-gray-500/70">
                                                {{ date('F, j-Y ', strtotime($pembayaranIuran->getTanggalBayar())) }}
                                            </p>
                                        </td>

                                        <td class="px-4 py-4 text-start" x-data="{ showImage: false }">
                                            <button id="imageButton"
                                                class="text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30 relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg font-sans text-xs font-medium uppercase transition-all disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                type="button" @click="showImage = !showImage"
                                                onclick="appendImageModal({{ $pembayaranIuran }})">
                                                <span class="">
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

                                        <td class="px-4 py-4 align-center text-sm">
                                            <h4 class=".. truncate w-96 text-gray-700 dark:text-gray-200">
                                                {{ $pembayaranIuran->getKeterangan() }}
                                            </h4>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{ $pembayaranIuranInstances->links('elements.pagination') }}
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
        function appendImageModal(riwayatPembayaran) {
            const modalImageElement =
                /*html*/
                `<div id="imageModal" x-show="showImage" class="fixed inset-0 z-40 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                                            <div x-cloak @click="()=>{showImage = false;deleteModal('#imageModal')}" x-show="showImage" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity  bg-gray-500/40 dark:bg-darkBg/40" aria-hidden="true"></div>

                                            <div x-cloak x-show="showImage" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-darkBg rounded-lg shadow-xl 2xl:max-w-2xl">
                                                <div class="flex items-center justify-between space-x-4">
                                                    <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100  ">Bukti Gambar Pembayaran Iuran</h1>

                                                    <button @click="()=>{showImage = false;setTimeout(deleteModal('#imageModal'),3000)}" class="text-gray-600 dark:text-gray-400 focus:outline-none hover:text-gray-700 dark:hover:text-gray-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    </button>
                                                </div>

                                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                                    ${riwayatPembayaran.tanggal_bayar}
                                                </p>
                                                <div class="mt-7">
                                                    <img src="${riwayatPembayaran.image_url}" alt="">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
        `;
            $(modalImageElement).insertAfter($(event.target).closest('#imageButton'));
        }

        function deleteModal(selector) {
            $(selector).ready(() => {
                $(selector).remove();
            });
        }
    </script>
@endpush
