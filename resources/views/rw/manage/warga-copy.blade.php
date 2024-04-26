{{-- extend to layouts/app --}}
@extends('layouts.sidebar')


{{-- content --}}
@section('content')
@php
$genderOptions = \App\Models\UserModel::getKelaminOption();
$agama = \App\Models\UserModel::getAgamaOption();
$statusPerkawinan = \App\Models\UserModel::getStatusPerkawinanOption();
$golonganDarah = \App\Models\UserModel::getGolonganDarahOption();
$tipeWarga = \App\Models\UserModel::getTipeWargaOption();
$role = \App\Models\UserModel::getRoleOption();
$rukunTetangga = \App\Models\UserModel::getRukunTetanggaOption();

@endphp
<section class="container px-2 mx-auto relative" x-data="{modalOpen: false}">
    <div class=" sm:flex sm:items-center sm:justify-between ">

        <div>
            <div class=" flex items-center gap-x-3">
                <h2 class="text-lg font-medium text-gray-800 dark:text-white">Warga</h2>
                <span class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">240
                    Warga</span>
            </div>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Data ini terakhir di update 12 menit yang lalu.</p>
        </div>

        <div class="flex items-center mt-4 gap-x-3" x-data="{modalOpen: false}">
            <button class="flex items-center justify-center md:w-1/2 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_3098_154395)">
                        <path d="M13.3333 13.3332L9.99997 9.9999M9.99997 9.9999L6.66663 13.3332M9.99997 9.9999V17.4999M16.9916 15.3249C17.8044 14.8818 18.4465 14.1806 18.8165 13.3321C19.1866 12.4835 19.2635 11.5359 19.0351 10.6388C18.8068 9.7417 18.2862 8.94616 17.5555 8.37778C16.8248 7.80939 15.9257 7.50052 15 7.4999H13.95C13.6977 6.52427 13.2276 5.61852 12.5749 4.85073C11.9222 4.08295 11.104 3.47311 10.1817 3.06708C9.25943 2.66104 8.25709 2.46937 7.25006 2.50647C6.24304 2.54358 5.25752 2.80849 4.36761 3.28129C3.47771 3.7541 2.70656 4.42249 2.11215 5.23622C1.51774 6.04996 1.11554 6.98785 0.935783 7.9794C0.756025 8.97095 0.803388 9.99035 1.07431 10.961C1.34523 11.9316 1.83267 12.8281 2.49997 13.5832" stroke="currentColor" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round" />
                    </g>
                    <defs>
                        <clipPath id="clip0_3098_154395">
                            <rect width="20" height="20" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
                <span>Import</span>
            </button>
            <button id="addButton" @click="modalOpen = !modalOpen" class=" flex items-center justify-center text-nowrap md:w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg shrink-0 sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600" onclick="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

                <span>Add warga</span>
            </button>
            <div id="addModal" x-show="modalOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                    <div x-cloak @click="modalOpen = false" x-show="modalOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"></div>

                    <div x-cloak x-show="modalOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                        <div class="flex items-center justify-between space-x-4">
                            <h1 class="text-xl font-medium text-gray-800 ">Add Warga User</h1>

                            <button @click="modalOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </div>

                        <p class="mt-2 text-sm text-gray-500 ">
                            Add user warga ke dalam sistem
                        </p>


                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach


                        <form class="mt-5" id="addModalForm">
                            @csrf
                            <x-inputform title="Email Warga" key="email" type="email" placeholder="exemple@exemple.exemple" />
                            <x-inputform title="Password Warga" key="password" type="password" placeholder="Use strong password" />
                            <x-inputform title="NIK Warga" key="nik" type="number" placeholder="1234567892322" />
                            <x-inputform title="NKK Warga" key="nkk" type="number" placeholder="1234567892322" />
                            <div class="grid grid-cols-4 gap-4 ">
                                <x-inputform title="Nama Depan Warga" key="nama_depan" type="text" placeholder="Thoriq" class="col-span-2" />
                                <x-inputform title="Nama Belakang Warga" key="nama_belakang" type="text" placeholder="Fathurrozi" class="col-span-2" />
                            </div>
                            <div class="grid grid-cols-4 gap-4">
                                <x-inputform title="Tempat Lahir Warga" key="tempat_lahir" type="text" placeholder="Banyuwangi" class="col-span-2" />
                                <x-inputform title="Tanggal Lahir Warga" key="tanggal_lahir" type="date" placeholder="Fathurrozi" class="col-span-2" />
                            </div>

                            <div class="mt-4">
                                <h1 class="text-xs font-medium text-gray-400 uppercase">Identification Status</h1>
                            </div>
                            <x-textareainputform title="Alamat Warga" key="alamat" placeholder="Jl Brawijaya no 14" />
                            <x-selectinputform title="Jenis Kelamin" key="jenis_kelamin" :options="$genderOptions" placeholder="Pilih Jenis Kelamin Warga" />
                            <x-inputform title="Pekerjaan Warga" key="pekerjaan" type="text" placeholder="Mahasiswa" />
                            <x-selectinputform title="Agama" key="agama" :options="$agama" placeholder="Pilih Agama Warga" />
                            <x-selectinputform title="Status Perkawinan Warga" key="status_perkawinan" :options="$statusPerkawinan" placeholder="Pilih Status Perkawinan Warga" />
                            <x-selectinputform title="Golongan Darah Warga" key="golongan_darah" :options="$golonganDarah" placeholder="Pilih Golongan Darah Warga" />
                            <x-selectinputform title="Tipe Warga" key="tipe_warga" :options="$tipeWarga" placeholder="Pilih Tipe Warga" />
                            <x-selectinputform title="Role Warga" key="role" :options="$role" placeholder="Pilih Role Warga" />
                            <x-selectinputform title="Rukun Tetangga Warga" key="id_rukun_tetangga" :options="$rukunTetangga" placeholder="Pilih Rukun Tetangga Warga" />
                            <div class="flex justify-between mt-6">
                                <p class="text-xs text-gray-200">Note: Pastikan semua sudah terisi dengan benar</p>
                                <button type="click" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-500 rounded-md dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700 hover:bg-blue-600 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                    Tambah Warga
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 md:flex md:items-center md:justify-between">
        <div class="inline-flex overflow-hidden bg-white border divide-x rounded-lg dark:bg-gray-900 rtl:flex-row-reverse dark:border-gray-700 dark:divide-gray-700">
            <button wire:click="selection('')" value="All" class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 hover:bg-gray-100 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300">
                Semua Warga
            </button>

            <button wire:click="selection('Ketua Rukun Tetangga')" class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                Ketua RT
            </button>

            <button wire:click="selection('Petugas Keamanan')" class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                Satpam
            </button>
        </div>

        <div class="relative flex items-center mt-4 md:mt-0">
            <span class="absolute">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </span>

            <input wire:model.live.debounce.400ms="search" type="text" placeholder="Search" class="block lg:w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
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
                                        <span class="text-nowrap">NIK</span>
                                    </button>
                                </th>

                                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                        <span class="text-nowrap">NKK</span>
                                    </button>
                                </th>
                                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                        <span class="text-nowrap">Nama</span>

                                    </button>
                                </th>
                                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                        <span class="text-nowrap">Tempat Tanggal Lahir</span>

                                    </button>
                                </th>
                                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                        <span class="text-nowrap">Alamat</span>

                                    </button>
                                </th>
                                <th scope="col" class="relative py-3.5 px-4">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            @foreach ($users as $user)
                            <tr>
                                <td class=" px-4 py-4 text-sm font-medium whitespace-nowrap">
                                    <div>
                                        <h2 class="font-medium text-gray-800 dark:text-white ">{{ $user->getNIK() }}
                                        </h2>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                    <div class="inline px-3 py-1 text-sm font-normal rounded-full text-emerald-500 gap-x-2 bg-emerald-100/60 dark:bg-gray-800">
                                        {{ $user->getNKK() }}
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                    <div>
                                        <h4 class="text-gray-700 dark:text-gray-200">
                                            {{ $user->getNamaDepan() . ' ' . $user->getNamaBelakang() }}
                                        </h4>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                    <p class=" -mx-1 text-xs text-blue-600 ">
                                        {{ $user->getTempatLahir() . ', ' . $user->getTanggalLahir() }}
                                    </p>
                                </td>

                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                    <p class="dark:text-gray-200 truncate ..">{{ $user->getAlamat() }}</p>
                                </td>

                                <td class="px-4 py-4 text-sm whitespace-nowrap flex" id="action" x-data="{modalEditOpen: false}">
                                    <button id="editButton" @click="modalEditOpen = !modalEditOpen" class="relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30" type="button" onclick="(function () {appendUpdateModal({{$user}},event);request(`{{route('rw.manage.warga.update')}}`, '#editModal', '#editModalForm')})()">
                                        <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 dark:fill-gray-200" fill="currentColor" aria-hidden="true">
                                                <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z">
                                                </path>
                                            </svg>
                                        </span>
                                    </button>
                                    <button type="" x-click="delete({{$user->getNik()}})" name="nik" value="{{ $user->getNik() }}" class="relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30">
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
    <div class="pt-3 ">
        <div class="flex">
            <div class="flex items-center">
                <label for="perPage" class="w-32 text-sm font-medium text-gray-800 dark:text-gray-300">Per Page</label>
                <select name="" id="" class="bg-white border border-gray-300 dark:bg-gray-900 text-gray-800 dark:text-gray-200 text-sm rounded-lg" wire:model.live='perPage'>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
    </div>

    {{$users->links('elements.pagination')}}

</section>

<script>
    function appendUpdateModal(user, event) {
        let modalEditElemen = /*html*/ `
        <div id="editModal" x-show="modalEditOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                    <div x-cloak @click="()=>{modalEditOpen = false;deleteModal('#editModal')}" x-show="modalEditOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"></div>

                    <div x-cloak x-show="modalEditOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                        <div class="flex items-center justify-between space-x-4">
                            <h1 class="text-xl font-medium text-gray-800 ">Edit Warga User</h1>

                            <button @click="()=>{modalEditOpen = false;deleteModal('#editModal')}" class="text-gray-600 focus:outline-none hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </div>

                        <p class="mt-2 text-sm text-gray-500 ">
                            Add user warga ke dalam sistem
                        </p>


                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach


                        <form class="mt-5" id="editModalForm">
                            @csrf
                            <x-inputform title="Email Warga" key="email" type="email" placeholder="exemple@exemple.exemple" value="${user.email}" />
                            <x-inputform title="Password Warga" key="password" type="password" placeholder="Use strong password" />
                            <x-inputform title="NIK Warga" key="nik" type="number" placeholder="1234567892322" value="${user.nik}" />
                            <x-inputform title="NKK Warga" key="nkk" type="number" placeholder="1234567892322" value="${user.nkk}" />
                            <div class="grid grid-cols-4 gap-4 ">
                                <x-inputform title="Nama Depan Warga" key="nama_depan" type="text" placeholder="Thoriq" class="col-span-2" value="${user.nama_depan}"/>
                                <x-inputform title="Nama Belakang Warga" key="nama_belakang" type="text" placeholder="Fathurrozi" class="col-span-2" value="${user.nama_belakang}"/>
                            </div>
                            <div class="grid grid-cols-4 gap-4">
                                <x-inputform title="Tempat Lahir Warga" key="tempat_lahir" type="text" placeholder="Banyuwangi" class="col-span-2" value="${user.tempat_lahir}"/>
                                <x-inputform title="Tanggal Lahir Warga" key="tanggal_lahir" type="date" placeholder="Fathurrozi" class="col-span-2" value="${user.tanggal_lahir}" />
                            </div>

                            <div class="mt-4">
                                <h1 class="text-xs font-medium text-gray-400 uppercase">Identification Status</h1>
                            </div>
                            <x-textareainputform title="Alamat Warga" key="alamat" placeholder="Jl Brawijaya no 14" value="${user.alamat}"/>
                            <x-selectinputform title="Jenis Kelamin" key="jenis_kelamin" :options="$genderOptions" placeholder="Pilih Jenis Kelamin Warga" selected="${user.jenis_kelamin}"/>
                            <x-inputform title="Pekerjaan Warga" key="pekerjaan" type="text" placeholder="Mahasiswa" value="${user.pekerjaan}" />
                            <x-selectinputform title="Agama" key="agama" :options="$agama" placeholder="Pilih Agama Warga" selected="${user.agama}" />
                            <x-selectinputform title="Status Perkawinan Warga" key="status_perkawinan" :options="$statusPerkawinan" placeholder="Pilih Status Perkawinan Warga" selected="${user.status_perkawinan}" />
                            <x-selectinputform title="Golongan Darah Warga" key="golongan_darah" :options="$golonganDarah" placeholder="Pilih Golongan Darah Warga" selected="${user.golongan_darah}" />
                            <x-selectinputform title="Tipe Warga" key="tipe_warga" :options="$tipeWarga" placeholder="Pilih Tipe Warga" selected="${user.tipe_warga}"/>
                            <x-selectinputform title="Role Warga" key="role" :options="$role" placeholder="Pilih Role Warga" />
                            <x-selectinputform title="Rukun Tetangga Warga" key="id_rukun_tetangga" :options="$rukunTetangga" placeholder="Pilih Rukun Tetangga Warga" selected="${user.id_rukun_tetangga}"/>
                            <div class="flex justify-between mt-6">
                                <p class="text-xs text-gray-200">Note: Pastikan semua sudah terisi dengan benar</p>
                                <button type="submit" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-500 rounded-md dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700 hover:bg-blue-600 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                    Save Warga
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    `
        $(modalEditElemen).insertAfter($(event.target).closest('#editButton'))
    }

    function request(url, selectorParent, selectorForm) {
        $(selectorParent).ready((e) => {
            $(selectorForm).on('submit', function(e) {
                e.preventDefault()
                $.ajax({
                    url: url,
                    type: "POST",
                    data: $(selectorForm).serialize(),
                    success: function(res) {
                        alert('Request Data Berhasil ');
                    }
                })

                $.ajax({
                    url: document.location,
                    type: "GET",
                    success: function(response) {
                        let parser = new DOMParser();
                        let doc = parser.parseFromString(response, 'text/html');
                        $('body').html(doc.body.innerHTML)
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

<script type="module">
    $('#editButton').on('click', function() {

    })

    $('#addModal').ready(function() {
        $('#addModalForm').on('submit', function(e) {
            console.log(e)
            e.preventDefault();

            $.ajax({
                url: "{{route('rw.manage.warga.new')}}",
                type: "POST",
                data: $('#addModalForm').serialize(),
                success: function(res) {
                    alert('Data Berhasil Ditambahkan');
                }
            })

            $.ajax({
                url: document.location,
                type: "GET",
                success: function(response) {
                    let parser = new DOMParser();
                    let doc = parser.parseFromString(response, 'text/html');
                    $('body').html(doc.body.innerHTML)
                }
            })
        })
    })
</script>
@endsection