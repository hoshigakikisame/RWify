{{-- extend to layouts/app --}}
@extends(request()->user()->getSidebarView())

{{-- content --}}
@section('content')
    <section class="container pb-20 px-10 mt-7">
        <div class="header mb-5 border-b pb-5">
            <h1 class="text-lg font-medium text-gray-950 dark:text-gray-100">Pengaduan</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Kirim kan pengaduan ke Ketua RW melewati form ini
            </p>
        </div>
        <div class="form rounded-lg bg-gray-50 px-8 py-4 pb-8 shadow-sm dark:bg-gray-800/50">
            <form action="{{ route('warga.layanan.pengaduan.new') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-header mb-6 mt-2">
                    <h1 class="font-medium dark:text-gray-100">Form Pengaduan</h1>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Berikan pengaduan yang lengkap dengan deskripsi yang jelas
                    </p>
                </div>
                <div class="form-body">
                    <div class="flex w-full lg:gap-8 gap-4 flex-col lg:flex-row">
                        <div class="flex-grow">
                            <x-form.input-form title="Judul" key="judul" type="text"
                                placeholder="Masukkan Judul Pengaduan" value="{{ old('judul') }}" />
                            <x-form.textarea-input-form title="Deskripsi Pengaduan" key="isi" type="text"
                                rows="5" placeholder="Masukkan Isi Pengaduan" value="{{ old('isi') }}" />
                        </div>
                        <div class="flex-grow">
                            <div class=" flex flex-col   h-full ">
                                <label for="imagePengaduan"
                                    class="mt-4 text-sm capitalize text-gray-700 dark:text-gray-300">
                                    Bukti Pengaduan
                                </label>
                                <div
                                    class="dark:hover:bg-bray-800 relative mt-1 flex  h-full w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div x-ref="dnd" class="flex h-full w-full flex-col" x-data="{ fileName: '' }">
                                        <input id="imagePengaduan" accept="*" type="file" name="image"
                                            title="" x-ref="file" @change="fileName = $refs.file.files[0]"
                                            class="absolute inset-0 z-40 h-full w-full cursor-pointer opacity-0 outline-none"
                                            @dragover="$refs.dnd.classList.add('bg-indigo-50')"
                                            @dragleave="$refs.dnd.classList.remove('bg-indigo-50')"
                                            @drop="$refs.dnd.classList.remove('bg-indigo-50')"
                                            x-effect="
                                                if (fileName) {
                                                    $refs.desc.classList.add('hidden')
                                                    $refs.wrap.classList.remove('grow')
                                                    $refs.wrap.classList.add('h-fit')
                                                } else {
                                                    $refs.desc.classList.remove('hidden')
                                                }
                                            "
                                            x-on:change="
                                                const fileReader = new FileReader()
                                                fileReader.onload = (event) => {
                                                    var img = 'url(' + event.target.result + ')'
                                                    console.log(event.target)
                                                    $refs.imgPreviewWrapper.style.backgroundImage = img
                                                    $refs.imgPreviewWrapper.classList.remove('hidden')
                                                }
                                                fileReader.readAsDataURL(fileName)
                                            " />
                                        <div class="hidden h-[360px] w-full bg-cover bg-center" x-ref="imgPreviewWrapper">
                                        </div>
                                        <div class="flex p-4 h-full w-full flex-col items-center justify-center text-center"
                                            x-ref="desc">
                                            <svg class="mb-4 h-8 w-8 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            {{-- $refs.imgPreview.setAttribute('src', event.target.result); --}}
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                                <span class="font-semibold">Click to Upload</span>
                                                or Drag and Drop
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF</p>
                                            <p class="mt-2 text-gray-900" x-text="fileName.name"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <x-form.input-image id="imagePengaduan" title="Evidence" key="image" placeholder="Gambar" /> --}}
                </div>
                <div class="mt-5 flex justify-end">
                    <button type="submit"
                        class="transform rounded-md bg-blue-500 px-3 py-2 text-sm capitalize tracking-wide text-white transition-colors duration-200 hover:bg-blue-600 focus:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700">
                        Kirim Pengaduan
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
