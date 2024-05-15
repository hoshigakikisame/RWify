{{-- extend to layouts/app --}}
@extends('layouts.sidebar')

{{-- content --}}
@section('content')
<section class="mt-7 ms-10">
    <h1 class="dark:text-gray-100">Pengaduan</h1>
    <div class="form">
        <form action="">
            <div class="flex gap-2">
                <div class="">
                    <x-form.input-form title="Nama" key="email" type="text" placeholder="Enter Nama" />
                    <x-form.input-form title="NIK" key="nik" type="text" placeholder="Enter Email" />
                    <x-form.input-form title="Judul" key="judul" type="text" placeholder="Enter Judul" />
                    <x-form.textarea-input-form title="Deskripsi Pengaduan" key="judul" type="text" placeholder="Enter Deskripsi Pengaduan" />
                </div>
                <div class="">
                    <x-form.input-image id="imagePengaduan" title="Evidence" key="image" placeholder="Gambar" />
                </div>
            </div>
            <div class="flex  mt-6">
                <button type="submit" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-500 rounded-md dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700 hover:bg-blue-600 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                    Add Pengaduan
                </button>
            </div>
        </form>
    </div>
</section>
@endsection