@extends(request()->user()->getSidebarView())

@section('content')
    <section class="container relative mx-auto mb-8 mt-7 px-4" x-data="{ modalOpen: false }">
        <div class="sm:flex sm:items-center sm:justify-between border-b pb-2">
            <div>
                <div class="flex items-center gap-x-3">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white">
                        Verifikasi Data Warga
                    </h2>
                </div>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                    Verifikasi data warga dalam RW
                </p>
            </div>
        </div>
        <div class="py-4 px-2">
            <div class="header">
                <h3 class="text-lg font-medium text-gray-800 dark:text-white">
                    Pencarian Data Warga
                </h3>
                <p class="text-xs text-gray-500 dark:text-gray-30">
                    Cari data warga berdasarkan nama, nik, nkk atau alamat
                </p>
            </div>

            <div class="search mt-4 mb-4">
                <div class="">
                    <div class="grid grid-cols-9 gap-2 text-gray-400">
                        <label for="search" class="text-xs font-Poppins font-medium col-span-3">Search</label>
                    </div>
                    <div class="grid grid-cols-9 divide-x mt-2 divide-gray-300 dark:divide-gray-500">
                        <input id="search" type="text"
                            class="border-t border-b border-e-0 border-s border-gray-300 dark:border-gray-500 dark:bg-gray-800 rounded-s-md focus:outline-none focus:ring-0 col-span-8 dark:text-gray-300 dark:placeholder-gray-300"
                            placeholder="Search" />
                        <button onclick="window.utils.Request.searchRequest(document.querySelector('#search').value)"
                            class="flex shrink-0 items-center justify-center gap-x-2 text-nowrap bg-blue-500 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-500 sm:w-auto fill-white">
                            <div class="w-4 h-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 513.749 513.749" xml:space="preserve">
                                    <path
                                        d="m504.352 459.061-99.435-99.477c74.402-99.427 54.115-240.344-45.312-314.746S119.261-9.277 44.859 90.15-9.256 330.494 90.171 404.896c79.868 59.766 189.565 59.766 269.434 0l99.477 99.477c12.501 12.501 32.769 12.501 45.269 0s12.501-32.769 0-45.269zm-278.635-73.365c-88.366 0-160-71.634-160-160s71.634-160 160-160 160 71.634 160 160c-.094 88.326-71.673 159.906-160 160" />
                                </svg>
                            </div>
                            <h1>Search</h1>
                        </button>
                    </div>
                </div>
            </div>
            <div class="body-wrap py-5">
                <div class="body-header">
                    <h1 class="text-gray-800 dark:text-white">
                        List Data Warga
                    </h1>
                    <p class="text-xs mt-1 text-gray-500 dark:text-gray-30">
                        {{ count($users) }} warga ditemukan
                    </p>
                </div>
                <div class="body-search mt-5 flex flex-col gap-2">
                    @foreach ($users as $user)
                        <div
                            class="card border border-gray-200 shadow-sm ring-4 ring-gray-200/10 dark:border-gray-800 dark:ring-gray-700/10 pt-2 rounded-lg mb-4">
                            <div class="flex py-4 px-5 gap-3 justify-between items-start">
                                <div class="header pb-2 grow flex gap-2">
                                    <div class="rounded-lg w-36 h-36 overflow-hidden">
                                        <div class="bg-indigo-100 w-full h-full " x-data="{ isOnImg: false, showImage: false }"
                                            @mouseover="isOnImg = true" @mouseleave="isOnImg = false"
                                            style="background: url({{ $user->getImageUrl() }});background-size:cover;background-position:center">
                                            <button x-show="isOnImg" id="imageButton" @click="showImage = true"
                                                onclick="(function(){appendImageModal('{{ $user->getImageUrl() }}','{{ $user->getNamaLengkap() }}',event);zoomInit()})()"
                                                class="w-full h-full flex justify-center items-center "
                                                :class="{
                                                    'backdrop-brightness-75 dark:backdrop-brightness-50': isOnImg
                                                }">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    class="w-8 h-8 fill-gray-50">
                                                    <path
                                                        d="M10 20a9.96 9.96 0 0 0 6.327-2.258l5.966 5.965a1 1 0 0 0 1.414-1.414l-5.966-5.965A10 10 0 1 0 10 20M7 9h2V7a1 1 0 0 1 2 0v2h2a1 1 0 0 1 0 2h-2v2a1 1 0 0 1-2 0v-2H7a1 1 0 0 1 0-2" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="text w-full h-full">
                                        <h1 class="text-xl mb-0.5 font-Poppins dark:text-gray-100">
                                            {{ $user->getNamaLengkap() }}</h1>
                                        <h2 class="text-xs text-gray-600 dark:text-gray-400 mb-2">
                                            {{ $user->getNik() }}
                                        </h2>
                                        <p class="text-sm text-gray-700 dark:text-gray-400">
                                            {{ $user->getAlamat() }}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script type="module" src="{{ Vite::asset('resources/js/image-zoom.js') }}"></script>
    <script type="module">
        $(document).ready(() => {
            let reg = new RegExp('[?&]q=([^&#]*)', 'i');
            let queryString = reg.exec(document.location);
            if (queryString != null) {
                let search = decodeURIComponent(queryString[1].replace(/\+/g, ' '));
                $('#search').val(search);
            }
        });
    </script>
    <script>
        function appendImageModal(img_url, nama, event) {
            const modalImageElement = /*html*/ `
<div id="imageModal" x-show="showImage" class="fixed inset-0 z-40 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
<div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
    <div x-cloak @click="()=>{showImage = false;isOnImg=false;deleteModal('#imageModal')}" x-show="showImage"
        x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 transition-opacity  bg-gray-500/40 dark:bg-gray-800/40" aria-hidden="true"></div>

    <div x-cloak x-show="showImage" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="inline-block w-full max-w-3xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-gray-800 rounded-lg shadow-xl 2xl:max-w-2xl">
        <div class="flex items-center justify-between space-x-4">
            <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100  ">Gambar Pembayaran</h1>

            <button @click="()=>{showImage = false;isOnImg=false;setTimeout(deleteModal('#imageModal'),3000)}"
                class="text-gray-600 dark:text-gray-400 focus:outline-none hover:text-gray-700 dark:hover:text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
        </div>

        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            Foto Warga ${nama}
        </p>

        <div class="image-container">
			<img id="imageZoom" src="${img_url}" alt="image">
		</div>

    </div>
</div>
</div>
                `
            $(modalImageElement).insertAfter($(event.target).closest('#imageButton'))
        }

        function deleteModal(selector) {
            $(selector).ready(() => {
                $(selector).remove()
            })
        }

        function zoomInit() {
            $(document).ready(function() {
                $('#imageZoom').imageZoom();
            });
        }
    </script>
@endpush
