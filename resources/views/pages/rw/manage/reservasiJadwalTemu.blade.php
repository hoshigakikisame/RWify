{{-- extend to layouts/app --}}
@extends('layouts.sidebar.rw-sidebar')

@push('style')
@endpush

{{-- content --}}
@section('content')
<section class="container px-4 mt-7 mb-8 mx-auto relative" x-data="{modalOpen: false}">
    <div class="relative sm:flex sm:items-center sm:justify-between ">
        <div class="">
            <div class="flex items-center gap-x-3">
                <h2 class="text-lg font-medium text-gray-800 dark:text-white">Jadwal Temu</h2>
                <span class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">{{$count}}
                    Jadwal Temu</span>
                <span class="px-3 py-1 inline-flex gap-2 items-center bg-yellow-100 rounded-full dark:bg-gray-800 ">
                    <p class="text-xs text-yellow-600 dark:text-yellow-400">9 Diterima</p>
                    <span class="relative flex h-3 w-3 items-center justify-center">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400/75 duration-700"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-yellow-500"></span>
                    </span>
                </span>
            </div>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Data ini terakhir di update 12 menit yang lalu.</p>
        </div>


    </div>

    <div class="mt-6 md:flex md:items-center md:justify-between">
        <div class="inline-flex overflow-hidden bg-white border divide-x rounded-lg dark:bg-gray-900 rtl:flex-row-reverse dark:border-gray-700 dark:divide-gray-700">
            <button click="selection('published')" value="All" class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 hover:bg-gray-100 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300">
                Pending
            </button>

            <button click="selection('draft')" class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                Diterima
            </button>
            <button click="selection('draft')" class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">
                Ditolak
            </button>
        </div>

        <div id="search" class="relative flex items-center mt-4 md:mt-0" x-data="{search:''}">
            <span class="absolute">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </span>

            <input x-model="search" @keyup.enter="searchRequest(search,event)" type="text" placeholder="Search" class="block lg:w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
        </div>
    </div>

    <div class="flex flex-col mt-6 ">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden border-t-2 border-gray-200 dark:border-gray-700">
                    <div class="heading mb-4">

                    </div>
                    <div class="Wraper grid grid-cols-2 gap-5">
                        @foreach ($reservasiJadwalTemuInstances as $reservasiJadwalTemu)
                        @php
                        $backgroundStyle = ['pending' => 'bg-blue-50 dark:bg-blue-950', 'ditolak' => 'bg-red-50 dark:bg-red-950', 'diterima' => 'bg-green-50 border dark:bg-green-950'];
                        @endphp
                        <div class="card px-10 py-8 rounded-lg border border-gray-300 ring ring-gray-200/20 dark:border-gray-700 dark:ring-gray-800/20">
                            <div class="card-header flex justify-between items-center mb-4">
                                <p class="text-sm font-light font-Poppins">Tanggal temu <span class="font-semibold">{{ date('l, M jS Y H:i', strtotime($reservasiJadwalTemu->getJadwalTemu()))}}</span> oleh <span class="font-semibold">{{$reservasiJadwalTemu->getPemohon()->getNamaDepan()}}</span></p>
                                <div class="status">
                                    <span class="inline-flex items-center justify-center mx-1 2xl:w-full px-3 py-[2px] rounded-full text-sm w-fit @php 
                                    $statusStyle = ['pending' => 'bg-blue-200 dark:bg-blue-950 text-blue-700 dark:text-blue-200 ring-blue-700/10', 'ditolak' => 'bg-red-200 dark:bg-red-950 text-red-700 dark:text-red-300 ring-red-600/10', 'diterima' => 'bg-green-200 dark:bg-green-950 text-green-700 dark:text-green-300 ring-green-600/20']; $dotStyle=['pending' => 'bg-blue-500 dark:bg-blue-300', 'ditolak' => 'bg-red-500 dark:bg-red-300', 'diterima' => 'bg-green-500 dark:bg-green-300'];
                                    @endphp
                                        @if($reservasiJadwalTemu->getStatus())
                                        {{ $statusStyle[$reservasiJadwalTemu->getStatus()] }}
                                        @else
                                        bg-gray-50 text-gray-600 ring-gray-500/10 
                                        @endif
                                        ">
                                        <span class="me-1 p-[4px] rounded-full inline-block
                                        @if ($reservasiJadwalTemu->getStatus()) 
                                        {{ $dotStyle[$reservasiJadwalTemu->getStatus()] }}
                                        @else 
                                        bg-gray-50
                                        @endif
                                            "></span>
                                        <span class="text-[9px]">
                                            {{ $reservasiJadwalTemu->getStatus() }}
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="card-body me-24 flex flex-col">
                                <h1 class="text-xl leading-6 dark:text-gray-100 text-gray-950 mb-2 capitalize">{{$reservasiJadwalTemu->getSubjek()}}</h1>
                                <p class="text-sm text-gray-700 leading-6 dark:text-gray-400 capitalize pb-4">{{ $reservasiJadwalTemu->getPesan()}}</p>
                                <div class="action ">
                                    <form action="{{route('rw.manage.reservasiJadwalTemu.update')}}" method="post" autocomplete="off">
                                        @csrf
                                        <x-form.inputform title="" id="idReservasiJadwalTemu" key="idReservasiJadwalTemu" type="hidden" value="{{ $reservasiJadwalTemu->getIdReservasiJadwalTemu() }}" placeholder="" />

                                        <label for="status" class="text-sm me-2 text-gray-800 dark:text-gray-300">Change Status</label>
                                        <select name="status" id="status" class="border border-gray-300 rounded-lg bg-gray-50 text-gray-950 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100" onchange="this.form.submit()">
                                            @foreach (\App\Enums\ReservasiJadwalTemu\ReservasiJadwalTemuStatusEnum::getValues() as $status)
                                            <option value="{{ $status }}" {{ $status == $reservasiJadwalTemu->getStatus() ? 'selected=selected' : ''}}>
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

    {{$reservasiJadwalTemuInstances->links('elements.pagination')}}

</section>
@endsection