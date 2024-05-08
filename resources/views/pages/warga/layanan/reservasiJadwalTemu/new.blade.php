{{-- extend to layouts/app --}}
@extends('layouts.sidebar.warga-sidebar')

{{-- content --}}
@section('content')

<section>
    <h1 class="dark:text-gray-100">Pengaduan</h1>
    <div class="form">
        <form action="" method="POST" enctype="">
            @csrf
            <div class="flex gap-2">
                <div class="">
                    <x-form.inputform title="Subjek" key="subjek" type="text" placeholder="Enter Judul" value="{{old('subjek')}}" />
                    <x-form.textareainputform title="Pesan Reservasi" key="pesan" type="text" placeholder="Enter Pesan Reservasi" value="{{old('subjek')}}" />
                </div>
                <div class="">
                    <x-form.inputform title="Tanggal Reservasi" key="jadwal_temu" type="datetime-local" placeholder="Enter date" />

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