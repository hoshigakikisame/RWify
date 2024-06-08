{{-- extend to layouts/app --}}
@extends(request()->user()->getSidebarView())

@php
    $bulanOptions = \App\Enums\Iuran\IuranBulanEnum::getValues();
@endphp
{{-- content --}}
@section('content')
    <section class="container relative mx-auto mt-7 px-4" x-data="{ modalOpen: false }">
        <div class="flex flex-col">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <div class="flex items-center gap-x-3">
                        <h2 class="text-lg font-medium text-gray-800 dark:text-white">Iuran Terverifikasi</h2>
                        <span
                            class="rounded-full dark:bg-gray-600/30 px-3 py-1 text-xs dark:text-gray-100 bg-gray-200/50 text-gray-400">
                            {{ $count }} Iuran Terverifikasi
                        </span>
                    </div>

                    @if ($iuranInstances->sortByDesc('diperbarui_pada')->first())
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                            Data ini terakhir diupdate
                            {{ $iuranInstances->sortByDesc('diperbarui_pada')->first()?->getDiperbaruiPada()->diffForHumans(null, true) }}
                            yang lalu
                        </p>
                    @else
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                            Masih belum ada iuran yang terverifikasi
                        </p>
                    @endif
                </div>
            </div>
            <div class="w-1/3 self-end">
                <x-form.search-input placeholder="Tekan Enter Untuk Mencari Iuran Terverifikasi ...">

                </x-form.search-input>
            </div>
        </div>

        <div class="mt-6 flex flex-col">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                        <table class="w-full min-w-full table-auto divide-y divide-gray-200 px-2 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-darkBg">
                                <tr>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Pembayar</span>
                                        </button>
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">NIK</span>
                                        </button>
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Pembayaran Bulan</span>
                                        </button>
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Pembayaran Tahun</span>
                                        </button>
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Jumlah Bayar</span>
                                        </button>
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 ps-5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 text-center dark:fill-gray-400">
                                            <span class="text-nowrap">Tanggal Bayar</span>
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-darkBg">
                                @foreach ($iuranInstances as $iuran)
                                    <tr>
                                        <td class="px-4 py-4 text-sm font-medium">
                                            <div>
                                                <h2
                                                    class="inline gap-x-2 text-nowrap rounded-full bg-emerald-100/60 px-3 py-1 text-sm font-normal text-emerald-500 dark:bg-gray-800">
                                                    {{ $iuran->getNamaPembayar() }}
                                                </h2>
                                            </div>
                                        </td>

                                        <td class="px-4 py-4 align-middle text-sm">
                                            <h4 class="mx-1 text-gray-700 dark:text-gray-200">
                                                {{ $iuran->getNikPembayar() }}
                                            </h4>
                                        </td>

                                        <td class="px-4 py-4 text-sm">
                                            <p class="mx-1 text-nowrap text-sm text-gray-700 dark:text-gray-200">
                                                {{ $iuran->getBulan() }}
                                            </p>
                                        </td>

                                        <td class="px-4 py-4 text-sm">
                                            <p class="mx-1 text-nowrap text-sm text-gray-700 dark:text-gray-200">
                                                {{ $iuran->getTahun() }}
                                            </p>
                                        </td>

                                        <td class="px-4 py-4 text-sm">
                                            <p class="mx-1 text-nowrap text-sm text-green-600">
                                                Rp. {{ $iuran->getJumlahBayar() }}
                                            </p>
                                        </td>

                                        <td class="px-4 py-4 text-sm">
                                            <p
                                                class="inline gap-x-2 rounded-full dark:bg-gray-600/30 px-3 py-1 text-sm dark:text-gray-100 bg-gray-200/50 text-gray-500/70">
                                                {{ date('F, j-Y ', strtotime($iuran->getTanggalBayar())) }}
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{ $iuranInstances->links('elements.pagination') }}
    </section>
@endsection

@push('scripts')
    <script type="module">
        $(document).ready(() => {
            let reg = new RegExp('[?&]q=([^&#]*)', 'i');
            let queryString = reg.exec(document.location);
            if (queryString != null) {
                let search = decodeURIComponent(queryString[1].replace(/\+/g, ' '));
                $('#search input').val(search);
            }
        });
    </script>
@endpush
