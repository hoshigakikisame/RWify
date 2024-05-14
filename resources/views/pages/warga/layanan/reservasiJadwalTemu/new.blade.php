{{-- extend to layouts/app --}}
@extends('layouts.sidebar.warga-sidebar')

{{-- content --}}
@section('content')

<section>
    <h1 class="dark:text-gray-100">Pengaduan</h1>
    <div class="form">
        <form action="{{route('warga.layanan.reservasiJadwalTemu.new')}}" method="POST" enctype="">
            @csrf
            <div class="flex gap-2">
                <div class="">
                    <x-form.input-form title="Subjek" key="subjek" type="text" placeholder="Enter Judul" value="{{old('subjek')}}" />
                    <x-form.textarea-input-form title="Pesan Reservasi" key="pesan" type="text" placeholder="Enter Pesan Reservasi" value="{{old('subjek')}}" />
                </div>
                <div class="">
                    <x-form.input-form title="Tanggal Reservasi" key="jadwal_temu" type="datetime-local" placeholder="Enter date" />
                    <div class="mt-4">
                        <label for="reservationTargets" class="block text-sm text-gray-700 capitalize dark:text-gray-300">Target</label>
                        <select name="nik_penerima" id="reservationTargets" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:focus:ring-blue-200 dark:focus:border-blue-300 dark:bg-gray-700 dark:border-gray-500 dark:text-gray-300 dark:placeholder-gray-500" onchange="this.form.submit()">
                            @foreach ($reservationTargets as $user)
                            <option value="{{ $user->getNik() }}">
                                {{ $user->getNamaLengkap() }} - {{ $user->getRole() }} 
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex  mt-6">
                <button type="submit" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-500 rounded-md dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700 hover:bg-blue-600 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                    Add Reservasi
                </button>
            </div>
        </form>
    </div>
</section>
@endsection