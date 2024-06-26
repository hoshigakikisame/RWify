{{-- extend to layouts/app --}}
@extends(request()->user()->getSidebarView())

{{-- content --}}
@section('content')
    <section class="container pb-20 px-10 mt-7">
        <div class="header mb-5 border-b pb-5 w-full">
            <h1 class="text-lg font-medium text-gray-950 dark:text-gray-100">Pembayaran Iuran</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Lakukan Pembayaran Iuran Secara Online Melalui Halaman Ini
            </p>
        </div>

        <div class="header mb-2">
            <h4 class="text-md text-gray-950 dark:text-gray-100">Metode Pembayaran Iuran</h4>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Pembayaran Secara Transfer Bisa Melalui
            </p>
        </div>

        <div class="flex flex-col lg:flex-row pb-4 pt-2 w-full h-full justify-between">
            <div class="mr-0 lg:mr-4 mb-4 h-full">
                <div
                    class="grid grid-flow-row-dense h-full grid-cols-2 items-center gap-6 rounded-lg border p-7 dark:border-gray-700 w-full ">
                    <div class="col-span-1 h-28 flex items-center">
                        <img src="{{ Vite::asset('resources/assets/images/dana.png') }}" alt="dana" class="w-96" />
                    </div>
                    <div class="col-span-1">
                        <p class="font-medium dark:text-gray-100">RW Satu Landungsari</p>
                        <p class="font-bold dark:text-gray-100">081234567812</p>
                    </div>
                </div>
            </div>
            <div class="mr-0 lg:mr-4 mb-4">
                <div
                    class="grid grid-flow-row-dense grid-cols-2 items-center gap-6 rounded-lg border p-4 p-7 dark:border-gray-700 w-full max-h-screen">
                    <div class="col-span-1 h-28 flex items-center">
                        <img src="{{ Vite::asset('resources/assets/images/logo-mandiri.png') }}" alt="dana"
                            class="w-96" />
                    </div>
                    <div class="col-span-1">
                        <p class="font-medium dark:text-gray-100">RW Satu Landungsari</p>
                        <p class="font-bold dark:text-gray-100">3472629292213</p>
                    </div>
                </div>
            </div>
            <div class="">
                <div
                    class="grid grid-flow-row-dense grid-cols-2 items-center gap-6 rounded-lg border p-4 p-7 dark:border-gray-700 w-full max-h-screen">
                    <div class="col-span-1 flex items-center h-28">
                        <img src="{{ Vite::asset('resources/assets/images/logo-bca.png') }}" alt="bca"
                            class="w-96 " />
                    </div>
                    <div class="col-span-1">
                        <p class="font-medium dark:text-gray-100">RW Satu Landungsari</p>
                        <p class="font-bold dark:text-gray-100">3472629292</p>
                    </div>
                </div>
            </div>
        </div>

        <div id="addPembayaran" class="form rounded-lg bg-gray-50 px-8 py-4 pb-8 shadow-sm dark:bg-SecondaryBg"
            x-data="{}">
            <form id="addPembayaranForm" action="{{ route('warga.layanan.pembayaranIuran.new') }}" method="POST"
                x-effect="window.utils.Request.actionRequest('{{ route('warga.layanan.pembayaranIuran.new') }}','#addPembayaran','#addPembayaranForm',true);window.utils.Request.redirectToPage('{{ route('warga.layanan.pembayaranIuran.riwayatPembayaranIuran') }}')"
                enctype="multipart/form-data">
                @csrf

                <div class="">
                    <div class="form-header col-span-3 mb-6 mt-2">
                        <h1 class="font-medium dark:text-gray-100">Form Pembayaran Iuran</h1>
                        <p class="text-sm mt-1 text-gray-500 dark:text-gray-400">
                            Berikan informasi pembayaran iuran yang lengkap dengan keterangan yang jelas
                        </p>
                    </div>

                    <div class="form-body grid grid-flow-row-dense grid-cols-5 gap-10">
                        <div class="col-span-3" x-ref="wrap" x-data="{ fileName: '' }">
                            <x-form.input-form title="NIK" key="nik_pembayar" type="text"
                                value="{{ request()->user()->nik }}" placeholder="" readonly="true" />
                            <x-form.textarea-input-form title="Keterangan" key="keterangan"
                                placeholder="Tambahkan Keterangan Bulan Apa Saja yang Dibayarkan    " value=""
                                rows="7 " resize="none" />
                            <div class="mt-4">
                                <label for="image" class="mt-4 text-sm capitalize text-gray-700 dark:text-gray-300">
                                    Bukti Pembayaran
                                </label>

                                <div
                                    class="dark:hover:bg-bray-800 relative mt-2 flex h-[300px] h-full w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div x-ref="dnd" class="flex h-full w-full flex-col">
                                        <input id="image" accept="*" type="file" name="image" title=""
                                            x-ref="file" @change="fileName = $refs.file.files[0]"
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
                                        <ul id="error"
                                            class="'text-sm text-center space-y-1' text-red-600 dark:text-red-400"></ul>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 flex justify-end">
                                <x-button.submit-button title="Kirim Pembayaran">
                                </x-button.submit-button>
                            </div>
                        </div>


                        <div class="col-span-2 row-span-1 mt-4">
                            <div class="rounded-lg border p-6">
                                <div class="container">
                                    <h1 class="font-bold font-poppins text-md dark:text-gray-100">Total Pembayaran Bulanan
                                    </h1>
                                    <div class="mt-4">
                                        <div class="border-b-2 dark:text-gray-100">
                                            @foreach ($ownedPropertiInstances as $properti)
                                                <div class="mt-2 grid grid-cols-3 grid-rows-2">
                                                    <div class="col-span-2 row-span-2">
                                                        <p class="text-md mb-2">{{ $properti->getNamaProperti() }}</p>
                                                        <p class="mb-2 text-sm text-gray-500">
                                                            {{ $properti->getTipeProperti()->getNamaTipe() }}
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="col-span-1 row-span-2 inline-flex items-center justify-end text-right">
                                                        <p
                                                            class="font-semi-bold font-poppins mb-2 items-center align-middle text-md dark:text-gray-100">
                                                            {{ \Illuminate\Support\Number::currency($properti->getTipeProperti()->getIuranPerBulan(), 'IDR') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="mt-2 grid grid-cols-3 grid-rows-1 dark:text-gray-100">
                                        <div class="col-span-2 row-span-1">
                                            <p class="mb-2 font-poppins text-lg">Total</p>
                                        </div>
                                        <div class="col-span-1 row-span-1 inline-flex items-center justify-end text-right">
                                            <p class="font-semi-bold mb-2 align-middle text-md ">
                                                {{ \Illuminate\Support\Number::currency($monthlyTotal, 'IDR') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="container mt-10">
                                    <h1 class="font-bold text-md dark:text-gray-100">Total Tunggak Iuran</h1>
                                    <div class="border-b-2 mt-4">
                                        @php
                                            $sumTotalUnpaidDueMonths = 0;
                                        @endphp
                                        @foreach ($ownedPropertiInstances as $properti)
                                            @php
                                                $totalUnpaidDueMonths = $properti->getTotalUnpaidDueMonths();
                                                $sumTotalUnpaidDueMonths += $totalUnpaidDueMonths;
                                            @endphp
                                            <div class="container">
                                                <div class="mt-2 grid grid-cols-3 grid-rows-2">
                                                    <div class="col-span-2 row-span-2">
                                                        <p class="text-md mb-2 dark:text-white">
                                                            {{ $properti->getNamaProperti() }}</p>
                                                        <p class="font-semi-bold mb-2 text-sm text-gray-500">
                                                            {{ $properti->getUnpaidDueMonths() }} Bulan
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="col-span-1 row-span-2 inline-flex items-center justify-end text-right">
                                                        <p
                                                            class="font-semi-bold mb-2 align-middle text-md dark:text-gray-100">
                                                            {{ \Illuminate\Support\Number::currency($totalUnpaidDueMonths, 'IDR') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mt-2 grid grid-cols-3 grid-rows-1 dark:text-gray-100">
                                        <div class="col-span-2 row-span-1">
                                            <p class="mb-2 font-poppins text-lg">Total</p>
                                        </div>
                                        <div class="col-span-1 row-span-1 inline-flex items-center justify-end text-right">
                                            <p class="font-semi-bold mb-2 align-middle text-md ">
                                                {{ \Illuminate\Support\Number::currency($sumTotalUnpaidDueMonths, 'IDR') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
