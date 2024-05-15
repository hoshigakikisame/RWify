{{-- extend to layouts/app --}}
@extends('layouts.sidebar.rw-sidebar')


{{-- content --}}
@section('content')
<section class="container px-4 mt-7 mx-auto relative " x-data="{ modalOpen: false }">
    <div class="flex flex-col">
        <div class="sm:flex sm:items-center sm:justify-between ">
            <div>
                <div class=" flex items-center gap-x-3">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white">Tipe Properti</h2>
                    <span class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">{{ $tipePropertiInstances->total() }}
                        Tipe Properti</span>
                </div>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Data ini terakhir di update 12 menit yang lalu.
                </p>
            </div>

            <div class=" md:flex md:items-right md:justify-between">
                <div class="flex items-center mt-2 gap-x-3" x-data="{ modalOpen: false }">
                    <button id="addButton" @click="modalOpen = !modalOpen" class=" flex items-center justify-center mb-2 text-nowrap px-5 py-2.5 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg shrink-0 sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600" onclick="request('{{ route('rw.manage.tipeProperti.new') }}', '#addModal', '#addModalForm')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        <span>Add Tipe Properti</span>
                    </button>
                    <div id="addModal" x-show="modalOpen" class="fixed inset-0 z-40 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
                        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                            <div @click="modalOpen = false" x-show="modalOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500/40 dark:bg-gray-800/40" aria-hidden="true">
                            </div>

                            <div x-show="modalOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-gray-800 rounded-lg shadow-xl 2xl:max-w-2xl">
                                <div class="flex items-center justify-between space-x-4">
                                    <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100 ">Add Tipe Properti</h1>

                                    <button @click="modalOpen = false" class="text-gray-600 dark:text-gray-400 focus:outline-none hover:text-gray-700 dark:hover:text-gray-500 mt-">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>

                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    Add Properti ke dalam sistem
                                </p>

                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach

                                <form class="mt-5" id="addModalForm" action="{{ route('rw.manage.tipeProperti.new') }}" method="post">
                                    @csrf
                                    <x-form.input-form title="Nama Tipe" key="nama_tipe" type="text" placeholder="Nama Tipe" />
                                    <x-form.input-form title="Iuran Per Bulan" key="iuran_per_bulan" type="int" placeholder="Iuran Perbulan" />

                                    <div class="flex justify-between mt-6">
                                        <p class="text-xs text-gray-200 dark:text-gray-400">Note: Pastikan semua sudah
                                            terisi dengan benar</p>
                                        <button type="submit" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-500 rounded-md dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700 hover:bg-blue-600 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                            Save Properti
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative flex items-center mt-4 md:mt-0  w-fit self-end" x-data="{search: ''}">
            <span class=" absolute">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </span>

            <input x-model="search" @keyup.enter="window.utils.Request.searchRequest(search)" type="text" placeholder="Search" class="block lg:w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">

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
                                        <span class="text-nowrap">Nama Tipe</span>
                                    </button>
                                </th>

                                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                        <span class="text-nowrap">Iuran Per Bulan</span>
                                    </button>
                                </th>
                                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                        <span class="text-nowrap"></span>
                                    </button>
                                </th>
                                <th scope="col" class="relative py-3.5 px-4">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            @foreach ($tipePropertiInstances as $tipeProperti)
                            <tr>
                                <td class="px-4 py-4 text-sm font-medium">
                                    <div>
                                        <h2 class="font-medium text-gray-800 dark:text-white text-nowrap">
                                            {{ $tipeProperti->getNamaTipe() }}
                                        </h2>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm ">
                                    <div>
                                        <h4 class="text-gray-700 dark:text-gray-200">
                                            {{ \Illuminate\Support\Number::currency($tipeProperti->getIuranPerBulan(), 'IDR') }}
                                        </h4>
                                    </div>
                                </td>

                                <td class="px-4 py-4 pe-4 pe-0 ps-6 text-sm flex" id="action" x-data="{ modalEditOpen: false, modalDeleteOpen: false }">
                                    <button id="editButton" @click="modalEditOpen = !modalEditOpen" class="relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30" type="button" onclick="(function () {appendUpdateModal({{ $tipeProperti }},event);request(`{{ route('rw.manage.tipeProperti.update') }}`, '#editModal', '#editModalForm')})()">
                                        <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 dark:fill-gray-200" fill="currentColor" aria-hidden="true">
                                                <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z">
                                                </path>
                                            </svg>
                                        </span>
                                    </button>
                                    <button id="deleteButton" @click="modalDeleteOpen = !modalDeleteOpen" onclick="(function (){appendDeleteModal({{ $tipeProperti }},event);request(`{{ route('rw.manage.tipeProperti.delete') }}`, '#deleteModal', '#deleteModalForm')})()" class="relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30">
                                        <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" class="h-4 w-4 fill-red-500" viewBox="0 0 24 24" fill="currentColor" version="1.1">
                                                <path d="M21 4h-3.1C17.422 1.674 15.375 0.003 13 0h-2c-2.375 0.003 -4.422 1.674 -4.9 4H3c-0.552 0 -1 0.448 -1 1S2.448 6 3 6h1v13C4.003 21.76 6.24 23.997 9 24h6c2.76 -0.003 4.997 -2.24 5 -5V6H21c0.552 0 1 -0.448 1 -1S21.552 4 21 4M11 17c0 0.552 -0.448 1 -1 1 -0.552 0 -1 -0.448 -1 -1v-6c0 -0.552 0.448 -1 1 -1s1 0.448 1 1v6zm4 0c0 0.552 -0.448 1 -1 1s-1 -0.448 -1 -1v-6c0 -0.552 0.448 -1 1 -1S15 10.448 15 11zM8.171 4c0.425 -1.198 1.558 -1.998 2.829 -2h2c1.271 0.002 2.404 0.802 2.829 2z">
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


    {{ $tipePropertiInstances->links('elements.pagination') }}

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
<script>
    function appendImageModal(img_url, nama, event) {
        const modalImageElement = /*html*/ `
        <div id="imageModal" x-show="showImage" class="fixed inset-0 z-40 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                                            <div x-cloak @click="()=>{showImage = false;deleteModal('#imageModal')}" x-show="showImage" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity  bg-gray-500/40 dark:bg-gray-800/40" aria-hidden="true"></div>

                                            <div x-cloak x-show="showImage" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-gray-800 rounded-lg shadow-xl 2xl:max-w-2xl">
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

    function appendDeleteModal(tipeProperti, event) {
        const modalDeleteElemen = /*html*/ `
        <div id="deleteModal" x-show="modalDeleteOpen" class="fixed inset-0 z-40 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                    <div x-cloak @click="()=>{modalDeleteOpen = false;deleteModal('#deleteModal')}" x-show="modalDeleteOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500/40 dark:bg-gray-800/40" aria-hidden="true"></div>

                    <div x-cloak x-show="modalDeleteOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-gray-800 rounded-lg shadow-xl 2xl:max-w-2xl">
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
                            <input type="text" name="id_tipe_properti" value="${tipeProperti.id_tipe_properti}" hidden >
                            <h1 class="text-xl text-wrap dark:text-gray-100 tracking-wide">Apakah Anda Yakin Menghapus <span class="font-semibold text-rose-600 underline underline-offset-8">${tipeProperti.nama_tipe}</span> </h1>              
                            <div class="flex justify-end mt-6">
                                <button type="submit" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-500 rounded-md dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700 hover:bg-blue-600 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                    Delete Properti
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        `
        $(modalDeleteElemen).insertAfter($(event.target).closest('#deleteButton'))

    }

    function appendUpdateModal(tipeProperti, event) {
        const modalEditElemen = /*html*/ `
        <div id="editModal" x-show="modalEditOpen" class="fixed inset-0 z-40 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                    <div x-cloak @click="()=>{modalEditOpen = false;deleteModal('#editModal')}" x-show="modalEditOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity  bg-gray-500/40 dark:bg-gray-800/40" aria-hidden="true"></div>

                    <div x-cloak x-show="modalEditOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white dark:bg-gray-800 rounded-lg shadow-xl 2xl:max-w-2xl">
                        <div class="flex items-center justify-between space-x-4">
                            <h1 class="text-xl font-medium text-gray-800 dark:text-gray-100  ">Edit Tipe Properti</h1>

                            <button @click="()=>{modalEditOpen = false;deleteModal('#editModal')}" class="text-gray-600 dark:text-gray-400 focus:outline-none hover:text-gray-700 dark:hover:text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </div>

                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Edit Tipe Properti di dalam sistem
                        </p>


                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach

                        <form class="mt-5" id="editModalForm" action="{{ route('rw.manage.tipeProperti.update') }}" method="post">
                            @csrf
                            <input type="text" name="id_tipe_properti" value="${tipeProperti.id_tipe_properti}" hidden>
                            <x-form.input-form title="Nama Properti" key="nama_tipe" type="text" placeholder="Properti" value="${tipeProperti.nama_tipe}" />
                            <x-form.input-form title="Nama Pemilik" key="iuran_per_bulan" type="text" placeholder="Pemilik"  value="${tipeProperti.iuran_per_bulan}" />
                            <div class="flex justify-between mt-6">
                                <p class="text-xs text-gray-200 dark:text-gray-400">Note: Pastikan semua sudah terisi dengan benar</p>
                                <button type="submit" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-500 rounded-md dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700 hover:bg-blue-600 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                    Save Tipe Properti
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
    `
        $(modalEditElemen).insertAfter($(event.target).closest('#editButton'))
        // $("#editModal select[aria-selected]").each(function() {
        //     $(this).val(this.ariaSelected).change()
        // })
    }

    function request(url, selectorParent, selectorForm) {
        $(selectorParent).ready((e) => {
            $(selectorForm).on('submit', function(e) {
                e.preventDefault()
                $.ajax({
                    url: url,
                    beforeSend: window.Loading.showLoading,
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        $.ajax({
                            url: document.location,
                            type: "GET",
                            success: function(response) {
                                let parser = new DOMParser();
                                let doc = parser.parseFromString(response,
                                    'text/html');
                                $('body').html(doc.body.innerHTML)
                                setTimeout(function() {
                                    $(".flash-message").remove()
                                }, 5000)
                            }
                        })


                    },
                    error: function(res) {
                        $.each(res.responseJSON.errors, (key, value) => {
                            value.forEach(element => {
                                $(e.currentTarget).find('#' + key).siblings(
                                    '#error').append(
                                    `<li>${element}</li>`)
                            });

                            setTimeout(element => {
                                $(e.currentTarget).find('#' + key).siblings(
                                    '#error').fadeOut("slow", () => {
                                    $(e.currentTarget).find('#' +
                                            key).siblings('#error')
                                        .empty()
                                })
                            }, 8000)
                        })

                    }
                })


            })
        })
    }


    function deleteModal(selector) {
        $(selector).ready(() => {
            $(selector).remove()
        })
    }
</script>
@endpush