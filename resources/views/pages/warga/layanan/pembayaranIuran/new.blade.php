@extends(request()->user()->getSidebarView())
@section('content')
    <section class="container mb-20 ms-10 mt-7">
        <div class="header mb-5 border-b pb-5">
            <h1 class="text-2xl font-medium text-gray-950 dark:text-gray-100">Bayar Iuran</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Kirim Pembayaran Iuran Anda Melalui Form Berikut
            </p>
        </div>
        <div class="header container mb-5 pb-5">
            <h1 class="text-xl font-medium text-gray-950 dark:text-gray-100">Metode Pembayaran</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Pembayaran Secara Transfer Bisa Melalui</p>
            <div class="grid grid-flow-row-dense grid-cols-3 gap-10 pt-5">
                <div
                    class="grid grid-flow-row-dense grid-cols-2 items-center gap-6 rounded-lg border p-4 p-7 dark:border-gray-700"
                >
                    <div class="col-span-1">
                        <img src="{{ Vite::asset('resources/assets/images/dana.png') }}" alt="dana" class="w-full" />
                    </div>
                    <div class="rows-2 col-span-1">
                        <p class="font-medium dark:text-gray-100">RW Satu Landungsari</p>
                        <p class="font-bold dark:text-gray-100">081234567812</p>
                    </div>
                </div>
                <div
                    class="grid grid-flow-row-dense grid-cols-2 items-center gap-6 rounded-lg border p-4 p-7 dark:border-gray-700"
                >
                    <div class="col-span-1">
                        <img src="{{ Vite::asset('resources/assets/images/dana.png') }}" alt="dana" class="w-full" />
                    </div>
                    <div class="rows-2 col-span-1">
                        <p class="font-medium dark:text-gray-100">RW Satu Landungsari</p>
                        <p class="font-bold dark:text-gray-100">081234567812</p>
                    </div>
                </div>
                <div
                    class="grid grid-flow-row-dense grid-cols-2 items-center gap-6 rounded-lg border p-4 p-7 dark:border-gray-700"
                >
                    <div class="col-span-1">
                        <img src="{{ Vite::asset('resources/assets/images/dana.png') }}" alt="dana" class="w-full" />
                    </div>
                    <div class="rows-2 col-span-1">
                        <p class="font-medium dark:text-gray-100">RW Satu Landungsari</p>
                        <p class="font-bold dark:text-gray-100">081234567812</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="form rounded-lg bg-gray-50 px-8 py-4 pb-8 shadow-sm dark:bg-gray-800/50">
            <form
                action="{{ route('warga.layanan.pembayaranIuran.new') }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf

                <div class="">
                    <div class="form-header col-span-3 mb-6 mt-2">
                        <h1 class="text-xl font-medium dark:text-gray-100">Form Pembayaran Iuran</h1>
                        <p class="text-l mt-1 text-gray-500 dark:text-gray-400">
                            Berikan pengaduan yang lengkap dengan deskripsi yang jelas
                        </p>
                    </div>

                    <div class="form-body grid grid-flow-row-dense grid-cols-5 gap-10">
                        <div class="col-span-2 row-span-1 mt-4">
                            <div class="container">
                                <h1 class="font-semi-bold text-xl dark:text-gray-100">Total Bulanan</h1>
                                <div class="mt-4">
                                    <div class="border-b-2">
                                        @foreach ($ownedPropertiInstances as $properti)
                                            <div class="mt-2 grid grid-cols-3 grid-rows-2">
                                                <div class="col-span-2 row-span-2">
                                                    <p class="text-md mb-2">{{ $properti->getNamaProperti() }}</p>
                                                    <p class="mb-2 text-sm text-gray-500">
                                                        {{ $properti->getTipeProperti()->getNamaTipe() }}
                                                    </p>
                                                </div>
                                                <div
                                                    class="col-span-1 row-span-2 inline-flex items-center justify-end text-right"
                                                >
                                                    <p class="font-semi-bold mb-2 align-middle text-xl">
                                                        {{ \Illuminate\Support\Number::currency($properti->getTipeProperti()->getIuranPerBulan(), 'IDR') }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mt-2 grid grid-cols-3 grid-rows-1">
                                    <div class="col-span-2 row-span-1">
                                        <p class="mb-2 text-lg">Total</p>
                                    </div>
                                    <div class="col-span-1 row-span-1 inline-flex items-center justify-end text-right">
                                        <p class="font-semi-bold mb-2 align-middle text-xl">
                                            {{ \Illuminate\Support\Number::currency($monthlyTotal, 'IDR') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="container mt-10">
                                <h1 class="font-semi-bold text-xl dark:text-gray-100">Total Tunggak Iuran</h1>
                                <div class="mt-4">
                                    <div class="container">
                                        <div class="mt-2 grid grid-cols-3 grid-rows-2">
                                            <div class="col-span-2 row-span-2">
                                                <p class="font-semi-bold mb-2 text-lg text-gray-500">
                                                    {{ $oldestMonthDiff }} Bulan
                                                </p>
                                            </div>
                                            <div
                                                class="col-span-1 row-span-2 inline-flex items-center justify-end text-right"
                                            >
                                                <p class="font-semi-bold mb-2 align-middle text-xl">
                                                    {{ \Illuminate\Support\Number::currency($totalUnpaidDueMonths, 'IDR') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-3 mt-4" x-ref="wrap" x-data="{ fileName: '' }">
                            <x-form.input-form
                                title="NIK"
                                key="nik_pembayar"
                                type="text"
                                value="{{ request()->user()->nik }}"
                                placeholder=""
                                readonly="true"
                            />
                            <x-form.textarea-input-form
                                title="Keterangan"
                                key="keterangan"
                                placeholder="Tambahkan keterangan bulan apa saja yang dibayarkan"
                                value=""
                                rows="11"
                                resize="none"
                            />
                            <div class="mt-4">
                                <label
                                    for="dropzone-file"
                                    class="mt-4 text-sm capitalize text-gray-700 dark:text-gray-300"
                                >
                                    Bukti Pembayaran
                                </label>
                                <div
                                    class="dark:hover:bg-bray-800 relative mt-2 flex h-[300px] h-full w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:border-gray-500 dark:hover:bg-gray-600"
                                >
                                    <div x-ref="dnd" class="flex h-full w-full flex-col">
                                        <input
                                            id="dropzone-file"
                                            accept="*"
                                            type="file"
                                            name="image"
                                            title=""
                                            x-ref="file"
                                            @change="fileName = $refs.file.files[0]"
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
                                                    $refs.imgPreviewWrapper.style.backgroundImage = img
                                                    $refs.imgPreviewWrapper.classList.remove('hidden')
                                                }
                                                fileReader.readAsDataURL(fileName)
                                            "
                                        />
                                        <div
                                            class="hidden h-[360px] w-full bg-cover bg-center"
                                            x-ref="imgPreviewWrapper"
                                        ></div>
                                        <div
                                            class="flex h-full w-full flex-col items-center justify-center text-center"
                                            x-ref="desc"
                                        >
                                            <svg
                                                class="mb-4 h-8 w-8 text-gray-500 dark:text-gray-400"
                                                aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 20 16"
                                            >
                                                <path
                                                    stroke="currentColor"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"
                                                />
                                            </svg>
                                            {{-- $refs.imgPreview.setAttribute('src', event.target.result); --}}
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                                <span class="font-semibold">Click to upload</span>
                                                or drag and drop
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF</p>
                                            <p class="mt-2 text-gray-900" x-text="fileName.name"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-start-2 row-span-1 inline-flex w-full justify-end">
                                <button
                                    type="submit"
                                    class="text-md col-span-1 row-span-1 mt-4 transform rounded-md bg-blue-500 px-5 py-2 text-xs font-semibold uppercase capitalize tracking-widest text-white ring-2 transition-colors duration-200 hover:bg-blue-600 focus:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700"
                                >
                                    KIRIM
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
