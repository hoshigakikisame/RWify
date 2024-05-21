{{-- extend to layouts/app --}}
@extends('layouts.sidebar.warga-sidebar')

{{-- content --}}
@section('content')
    <section class="mb-20 ms-10 mt-7">
        <div class="header mb-5 border-b pb-5">
            <h1 class="text-lg font-medium text-gray-950 dark:text-gray-100">Reservasi</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Buat reservasi menggunakan form ini</p>
        </div>
        <div class="form w-1/2 rounded-lg bg-gray-50 px-8 py-4 pb-8 shadow-sm dark:bg-gray-800/50">
            <form action="{{ route('warga.layanan.reservasiJadwalTemu.new') }}" method="POST" enctype="">
                @csrf
                <div class="form-header mb-6 mt-2">
                    <h1 class="font-medium dark:text-gray-100">Form Reservasi</h1>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Buat reservasi dengan lengkap dengan deskripsi yang jelas
                    </p>
                </div>
                <div class="form-body">
                    <x-form.input-form
                        title="Subjek"
                        key="subjek"
                        type="text"
                        placeholder="Enter Judul"
                        value="{{old('subjek')}}"
                    />
                    <x-form.textarea-input-form
                        title="Pesan Reservasi"
                        key="pesan"
                        type="text"
                        placeholder="Enter Pesan Reservasi"
                        value="{{old('subjek')}}"
                    />
                    <div class="">
                        <x-form.input-form
                            title="Tanggal Reservasi"
                            key="jadwal_temu"
                            type="datetime-local"
                            placeholder="Enter date"
                        />
                        <div class="mt-4">
                            <label
                                for="reservationTargets"
                                class="block text-sm capitalize text-gray-700 dark:text-gray-300"
                            >
                                Target
                            </label>
                            <select
                                name="nik_penerima"
                                id="reservationTargets"
                                class="mt-2 block w-full rounded-md border border-gray-200 bg-white px-3 py-2 text-gray-600 placeholder-gray-400 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-500 dark:focus:border-blue-300 dark:focus:ring-blue-200"
                                onchange="this.form.submit()"
                            >
                                @foreach ($reservationTargets as $user)
                                    <option value="{{ $user->getNik() }}">
                                        {{ $user->getNamaLengkap() }} - {{ $user->getRole() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-5 flex justify-end">
                    <button
                        type="submit"
                        class="transform rounded-md bg-blue-500 px-3 py-2 text-sm capitalize tracking-wide text-white transition-colors duration-200 hover:bg-blue-600 focus:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700"
                    >
                        Add Pengaduan
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
