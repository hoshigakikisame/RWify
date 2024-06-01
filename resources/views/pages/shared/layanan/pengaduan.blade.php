{{-- extend to layouts/app --}}
@extends(request()->user()->getSidebarView())

{{-- content --}}
@section('content')
    <section class="ms-10 mt-7">
        <h1 class="dark:text-gray-100">Pengaduan</h1>
        <div class="form">
            <form action="">
                <div class="flex gap-2">
                    <div class="">
                        <x-form.input-form title="Nama" key="email" type="text" placeholder="Enter Nama" />
                        <x-form.input-form title="NIK" key="nik" type="text" placeholder="Enter Email" />
                        <x-form.input-form title="Judul" key="judul" type="text" placeholder="Enter Judul" />
                        <x-form.textarea-input-form title="Deskripsi Pengaduan" key="judul" type="text"
                            placeholder="Enter Deskripsi Pengaduan" />
                    </div>
                    <div class="">
                        <x-form.input-image id="imagePengaduan" title="Evidence" key="image" placeholder="Gambar" />
                    </div>
                </div>
                <div class="mt-6 flex">
                    <button type="submit"
                        class="transform rounded-md bg-blue-500 px-3 py-2 text-sm capitalize tracking-wide text-white transition-colors duration-200 hover:bg-blue-600 focus:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700">
                        Add Pengaduan
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
