{{-- extend to layouts/app --}}
@extends('layouts.sidebar')


{{-- content --}}
@section('content')
<section class="container px-2 mx-auto relative">
    <div class="sm:flex sm:items-center justify-normal sm:justify-between">
        <div>
            <div class="flex items-center gap-x-3">
                <h2 class="text-lg font-medium text-gray-800 dark:text-white">Warga</h2>
                <span class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">240 Warga</span>
            </div>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Data ini terakhir di update 12 menit yang lalu.</p>
        </div>
        <section class="container px-2 mx-auto relative">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <div class="flex items-center gap-x-3">
                        <h2 class="text-lg font-medium text-gray-800 dark:text-white">Warga</h2>

                        <span class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">240
                            Warga</span>
                    </div>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Data ini terakhir di update 12 menit yang lalu.</p>
                </div>

                <div class="flex items-center mt-4 gap-x-3">
                    <button class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700">
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

                    <button id="addButton" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg shrink-0 sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        <span>Add warga</span>
                    </button>
                </div>
            </div>

            <div class="mt-6 md:flex md:items-center md:justify-between">
                <div class="inline-flex overflow-hidden bg-white border divide-x rounded-lg dark:bg-gray-900 rtl:flex-row-reverse dark:border-gray-700 dark:divide-gray-700">
                    <button class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 bg-gray-100 sm:text-sm dark:bg-gray-800 dark:text-gray-300">
                        View all
                    </button>

                    <button class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                        Monitored
                    </button>

                    <button class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                        Unmonitored
                    </button>
                </div>

                <div class="relative flex items-center mt-4 md:mt-0">
                    <span class="absolute">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </span>

                    <input type="text" placeholder="Search" class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
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
                                            NKK
                                        </th>

                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            NIK
                                        </th>

                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            <button class="flex items-center gap-x-3 focus:outline-none">
                                                <span>Nama</span>

                                                <svg class="h-3" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2.13347 0.0999756H2.98516L5.01902 4.79058H3.86226L3.45549 3.79907H1.63772L1.24366 4.79058H0.0996094L2.13347 0.0999756ZM2.54025 1.46012L1.96822 2.92196H3.11227L2.54025 1.46012Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                                    <path d="M0.722656 9.60832L3.09974 6.78633H0.811638V5.87109H4.35819V6.78633L2.01925 9.60832H4.43446V10.5617H0.722656V9.60832Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                                    <path d="M8.45558 7.25664V7.40664H8.60558H9.66065C9.72481 7.40664 9.74667 7.42274 9.75141 7.42691C9.75148 7.42808 9.75146 7.42993 9.75116 7.43262C9.75001 7.44265 9.74458 7.46304 9.72525 7.49314C9.72522 7.4932 9.72518 7.49326 9.72514 7.49332L7.86959 10.3529L7.86924 10.3534C7.83227 10.4109 7.79863 10.418 7.78568 10.418C7.77272 10.418 7.73908 10.4109 7.70211 10.3534L7.70177 10.3529L5.84621 7.49332C5.84617 7.49325 5.84612 7.49318 5.84608 7.49311C5.82677 7.46302 5.82135 7.44264 5.8202 7.43262C5.81989 7.42993 5.81987 7.42808 5.81994 7.42691C5.82469 7.42274 5.84655 7.40664 5.91071 7.40664H6.96578H7.11578V7.25664V0.633865C7.11578 0.42434 7.29014 0.249976 7.49967 0.249976H8.07169C8.28121 0.249976 8.45558 0.42434 8.45558 0.633865V7.25664Z" fill="currentColor" stroke="currentColor" stroke-width="0.3" />
                                                </svg>
                                            </button>
                                        </th>
                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            Tempat Tanggal Lahir</th>

                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            Alamat</th>

                                        <th scope="col" class="relative py-3.5 px-4">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                    @foreach ($users as $user)
                                    <tr>
                                        <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
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
                                            <p class="truncate ..">{{ $user->getAlamat() }}</p>
                                        </td>

                                        <td class="px-4 py-4 text-sm whitespace-nowrap" id="action">
                                            <button class="relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30" type="button">
                                                <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="h-4 w-4">
                                                        <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </button>
                                            <form action="{{ route('rw.manage.warga.delete') }}" method="POST" class="w-full ">
                                                @csrf
                                                <button type="submit" name="nik" value="{{ $user->getNik() }}" class="relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30">
                                                    <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" class="h-4 w-4 fill-red-500" viewBox="0 0 24 24" fill="currentColor" version="1.1">
                                                            <path d="M21 4h-3.1C17.422 1.674 15.375 0.003 13 0h-2c-2.375 0.003 -4.422 1.674 -4.9 4H3c-0.552 0 -1 0.448 -1 1S2.448 6 3 6h1v13C4.003 21.76 6.24 23.997 9 24h6c2.76 -0.003 4.997 -2.24 5 -5V6H21c0.552 0 1 -0.448 1 -1S21.552 4 21 4M11 17c0 0.552 -0.448 1 -1 1 -0.552 0 -1 -0.448 -1 -1v-6c0 -0.552 0.448 -1 1 -1s1 0.448 1 1v6zm4 0c0 0.552 -0.448 1 -1 1s-1 -0.448 -1 -1v-6c0 -0.552 0.448 -1 1 -1S15 10.448 15 11zM8.171 4c0.425 -1.198 1.558 -1.998 2.829 -2h2c1.271 0.002 2.404 0.802 2.829 2z">
                                                            </path>
                                                        </svg>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 sm:flex sm:items-center sm:justify-between ">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Page <span class="font-medium text-gray-700 dark:text-gray-100">1 of 10</span>
                </div>

                <div class="flex items-center mt-4 gap-x-4 sm:mt-0">
                    <a href="#" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                        </svg>

                        <span>
                            previous
                        </span>
                    </a>

                    <a href="#" class=" flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 ">
                        <span>
                            Next
                        </span>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>
        @endsection

        @push('scripts')
        <script type="module">
            const addModalElemen = /*html*/ `
    <section id="addPopup" class="bg-gray-500 bg-opacity-60 w-full min-h-screen absolute top-0 left-0 flex">
    <div class="popUp bg-white m-auto rounded-lg px-10 py-5">
        <div class="header border-b">
            <h1 class="text-xl mb-3">
                Add Data Warga
            </h1>
        </div>
        <div class="body">
            <form action="{{ route('rw.manage.warga.new') }}" method="POST" class="w-full ">
                @csrf
                <section class="data-diri flex gap-2 mb-2 border-solid border-b py-3 justify-between ">
                    <div class="form-wrap-header w-28">
                        <h1 class="text-md">Data Diri</h1>
                    </div>
                    <div class="form-fields grow">
                        <x-inputform title="NKK" key="nkk" name="nkk" type="text" />
                        <x-inputform title="NIK" key="nik" name="nik" type="text" />
                        <x-inputform title="Email" key="email" name="email" type="email" />
                        <x-inputform title="Password" key="password" name="password" type="password" />
                        <div class="name flex gap-4 justify-between">
                            <x-inputform title="Nama Depan" key="nama_depan" name="nama_depan" type="text" />
                            <x-inputform title="Nama Belakang" key="nama_belakang" name="nama_belakang" type="text" />
                        </div>
                        <div class="birthdate flex gap-4 ">
                            <x-inputform title="Tempat Lahir" key="tempat_lahir" name="tempat_lahir" type="text" />
                            <x-inputform title="Tanggal Lahir" key="tanggal_lahir" name="tanggal_lahir" type="date" />
                        </div>
                        <div class="jenis-kelamin-dan-golongan-darah flex gap-4">
                            @php
                                $genderOptions = \App\Models\UserModel::getKelaminOption();
                                $golonganDarah = \App\Models\UserModel::getGolonganDarahOption();
                            @endphp
                            <x-selectinputform title="Jenis Kelamin" key="jenis_kelamin" name="jenis_kelamin" :options="$genderOptions" />
                            <x-selectinputform title="Golongan Darah" key="golongan_darah" name="golongan_darah" :options="$golonganDarah" />
                        </div>
                        <x-text-area title="Alamat" key="alamat" name="alamat" />
                    </div>
                </section>
                <section class="status flex gap-2 border-solid border-b py-3 justify-between ">
                    <div class="form-wrap-header w-28">
                        <h1>Status</h1>
                    </div>
                    <div class="form-fields grow">
                        @php
                            $agama = \App\Models\UserModel::getAgamaOption();
                            $statusPerkawinan = \App\Models\UserModel::getStatusPerkawinanOption();
                            $role = \App\Models\UserModel::getRoleOption();
                            $tipeWarga = \App\Models\UserModel::getTipeWargaOption();
                            $rukunTetangga = \App\Models\UserModel::getRukunTetanggaOption();
                        @endphp
                        <x-selectinputform title="Agama" key="agama" name="agama" :options="$agama" />
                        <x-selectinputform title="Status Perkawinan" key="status_perkawinan" name="status_perkawinan" :options="$statusPerkawinan" />
                        <x-inputform title="Pekerjaan" key="pekerjaan" name="pekerjaan" type="text" />
                        <x-selectinputform title="Peran" key="role" name="role" :options="$role" />
                        <x-selectinputform title="Tipe" key="tipe_warga" name="tipe_warga" :options="$tipeWarga" />
                        <x-selectinputform title="RT" key="rukun_tetangga" name="rukun_tetangga" :options="$rukunTetangga" />
                    </div>
                </section>
                <section class="actionButton w-full flex gap-2 justify-end py-3 px-1">
                    <button class="flex items-center justify-center w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg shrink-0 sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">Save</button>
                    <button class="flex items-center justify-center w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-gray-200 rounded-lg shrink-0 sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600" onclick="$('#addPopup').remove()">Close</button>
                </section>
            </form>
        </div>
    </div>
</section>
    `

            const addButton = document.querySelector("#addButton")


            document.addEventListener('click', (event) => {
                if (!addButton.contains(event.target) && !document.querySelector(".popUp").contains(event.target)) {
                    $("#addPopup").remove();
                }
            })


            $('#addButton').on('click', (e) => {
                console.log(
                    $(addModalElemen).insertAfter(
                        $(e.currentTarget).parents('section'))
                )
            })
        </script>
        @endpush