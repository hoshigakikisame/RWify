{{-- extend to layouts/app --}}
@extends(request()->user()->getSidebarView())

{{-- content --}}
@section('content')
    <section class="container mb-20 ms-10 mt-7">
        <div class="header mb-5 border-b pb-5">
            <h1 class="text-lg font-medium text-gray-950 dark:text-gray-100">Pengaduan</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Kirim kan pengaduan ke Ketua RW melewati form ini
            </p>
        </div>
        <div class="form w-1/2 rounded-lg bg-gray-50 px-8 py-4 pb-8 shadow-sm dark:bg-gray-800/50">
            <form action="{{ route('rt.layanan.pengaduan.new') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-header mb-6 mt-2">
                    <h1 class="font-medium dark:text-gray-100">Form Pengaduan</h1>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Berikan pengaduan yang lengkap dengan deskripsi yang jelas
                    </p>
                </div>
                <div class="form-body">
                    <x-form.input-form
                        title="Judul"
                        key="judul"
                        type="text"
                        placeholder="Enter Judul"
                        value="{{old('judul')}}"
                    />
                    <x-form.textarea-input-form
                        title="Deskripsi Pengaduan"
                        key="isi"
                        type="text"
                        placeholder="Enter Isi Pengaduan"
                        value="{{old('isi')}}"
                    />
                    <x-form.input-image id="imagePengaduan" title="Evidence" key="image" placeholder="Gambar" />
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
