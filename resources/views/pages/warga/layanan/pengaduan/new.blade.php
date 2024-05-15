{{-- extend to layouts/app --}}
@extends('layouts.sidebar.warga-sidebar')

{{-- content --}}
@section('content')
<section class="mt-7 ms-10 mb-20">
    <div class="header mb-5 border-b pb-5 ">
        <h1 class="dark:text-gray-100 font-medium text-lg text-gray-950">Pengaduan</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kirim kan pengaduan ke Ketua RW melewati form ini</p>
    </div>
    <div class="form bg-gray-50 dark:bg-gray-800/50 px-8 py-4 pb-8 rounded-lg shadow-sm w-1/2">
        <form action="{{route('warga.layanan.pengaduan.new')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-header mt-2 mb-6">
                <h1 class="font-medium dark:text-gray-100">Form Pengaduan</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Berikan pengaduan yang lengkap dengan deskripsi yang jelas</p>
            </div>
            <div class="form-body">
                <x-form.inputform title="Judul" key="judul" type="text" placeholder="Enter Judul" value="{{old('judul')}}" />
                <x-form.textareainputform title="Deskripsi Pengaduan" key="isi" type="text" placeholder="Enter Isi Pengaduan" value="{{old('isi')}}" />
                <x-form.inputimage id="imagePengaduan" title="Evidence" key="image" placeholder="Gambar" />
            </div>
            <div class="flex mt-5 justify-end">
                <button type="submit" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-500 rounded-md dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700 hover:bg-blue-600 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                    Add Pengaduan
                </button>
            </div>
        </form>
    </div>
</section>
@endsection