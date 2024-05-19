@extends(request()->user()->getSidebarView())
@section('content')
<section class=" mt-7 ms-10 mb-20">
    <div class="header mb-5 border-b pb-5 ">
        <h1 class="dark:text-gray-100 font-medium text-2xl text-gray-950">Bayar Iuran</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kirim Pembayaran Iuran Anda Melalui Form Berikut</p>
    </div>
    <div class="header mb-5 pb-5 container">
        <h1 class=" dark:text-gray-100 font-medium text-xl text-gray-950">Metode Pembayaran</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Pembayaran Secara Transfer Bisa Melalui</p>
        <div class="grid grid-flow-row-dense grid-cols-3 gap-10 pt-5">
            <div class="grid grid-flow-row-dense grid-cols-2 gap-6 items-center rounded-lg p-4 border dark:border-gray-700 p-7">
                <div class="col-span-1">
                    <img src="{{ Vite::asset('resources/assets/images/dana.png') }}" alt="dana" class="w-full" />
                </div>
                <div class="col-span-1 rows-2">
                    <p class="font-medium dark:text-gray-100">RW Satu Landungsari</p>
                    <p class="font-bold dark:text-gray-100">081234567812</p>
                </div>
            </div>
            <div class="grid grid-flow-row-dense grid-cols-2 gap-6 items-center rounded-lg p-4 border dark:border-gray-700 p-7">
                <div class="col-span-1">
                    <img src="{{ Vite::asset('resources/assets/images/dana.png') }}" alt="dana" class="w-full" />
                </div>
                <div class="col-span-1 rows-2">
                    <p class="font-medium dark:text-gray-100">RW Satu Landungsari</p>
                    <p class="font-bold dark:text-gray-100">081234567812</p>
                </div>
            </div>
            <div class="grid grid-flow-row-dense grid-cols-2 gap-6 items-center rounded-lg p-4 border dark:border-gray-700 p-7">
                <div class="col-span-1">
                    <img src="{{ Vite::asset('resources/assets/images/dana.png') }}" alt="dana" class="w-full" />
                </div>
                <div class="col-span-1 rows-2">
                    <p class="font-medium dark:text-gray-100">RW Satu Landungsari</p>
                    <p class="font-bold dark:text-gray-100">081234567812</p>
                </div>
            </div>
        </div>
    </div>
    <div class="form bg-gray-50 dark:bg-gray-800/50 px-8 py-4 pb-8 rounded-lg shadow-sm container">
        <form action="{{ route('warga.layanan.pengaduan.new') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class=" flex flex-col">
                <div class="form-header mt-2 mb-6 col-span-3 shrink">
                    <h1 class="font-medium text-xl dark:text-gray-100">Form Pembayaran Iuran</h1>
                    <p class="text-l text-gray-500 dark:text-gray-400 mt-1">Berikan pengaduan yang lengkap dengan
                        deskripsi
                        yang jelas</p>
                </div>
                <div class="form-body flex gap-10 relative mb-10" x-data="{ fileName: '' }">
                    <div class="left grow h-fit">
                        <x-form.input-form title="NIK" key="nik_pembayar" type="text" value="{{ request()->user()->nik }}" placeholder="dsa" readonly="true" />
                        <x-form.textarea-input-form title="Keterangan" key="keterangan" placeholder="Tambahkan keterangan bulan apa saja yang dibayarkan" value="" rows="5" />
                    </div>
                    <div class="right grow mt-4 relative" x-ref="wrap" x-data="{ fileName: '' }">
                        <label for="dropzone-file" class=" text-sm text-gray-700 capitalize dark:text-gray-300">Bukti Pembayaran</label>
                        <div class="flex mt-2 flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 relative">
                            <div x-ref="dnd" class="w-full h-full relative">
                                <input id="dropzone-file" accept="*" type="file" name="image" title="" x-ref="file" @change="fileName = $refs.file.files[0]" class="absolute inset-0 z-40 w-full h-full outline-none opacity-0 cursor-pointer" @dragover="$refs.dnd.classList.add('bg-indigo-50')" @dragleave="$refs.dnd.classList.remove('bg-indigo-50')" @drop="$refs.dnd.classList.remove('bg-indigo-50')" x-effect="if(fileName){ $refs.desc.classList.add('hidden');$refs.wrap.classList.remove('grow');$refs.wrap.classList.add('h-fit')}else{$refs.desc.classList.remove('hidden')}" x-on:change="const fileReader = new FileReader(); fileReader.onload = event => {
                                    $refs.imgPreview.setAttribute('src', event.target.result)};fileReader.readAsDataURL(fileName);">
                                <div class="max-w-3xl"><img src="" alt="" class="relative" x-ref="imgPreview"></div>
                                <div class="flex flex-col w-full h-full items-center justify-center text-center" x-ref="desc">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click
                                            to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF</p>
                                    <p class="mt-2 text-gray-900" x-text="fileName.name"></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full flex justify-end">
                    <x-button.primary-button class="col-span-1 row-span-1 mt-4">Kirim</x-button.primary-button>
                </div>
        </form>
    </div>
</section>
@endsection