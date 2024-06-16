@extends(request()->user()->getSidebarView())
@section('content')
    <section class="container relative mx-auto mb-8 mt-7 px-4">
        <div class="sm:flex sm:items-center sm:justify-between border-b pb-2">
            <div class="header">
                <div class="flex items-center gap-x-3">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white">Perhitungan</h2>
                    <span
                        class="rounded-full bg-gray-200/50 px-3 py-1 text-xs text-gray-400 dark:bg-gray-600/30 dark:text-gray-100">
                        MFEP
                    </span>
                </div>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                    Berikut merupakan hasil perhitungan menggunakan metode MFEP.
                </p>
            </div>
            <form id="exportCSVForm" method="get" action="{{ route('rw.manage.bansos.exportMfep') }}"
                class="flex items-center justify-center">
                @csrf
                <label for="exportCSV"
                    class="flex items-center justify-center gap-x-2 rounded-lg border bg-white px-5 py-2 text-sm text-gray-700 transition-colors duration-200 hover:bg-gray-100 dark:border-gray-700 dark:bg-darkBg dark:text-gray-200 dark:hover:bg-gray-800 sm:w-auto">
                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242M12 12v9m-4-4l4 4l4-4" />
                    </svg>Export XLSX
                </label>
                <input id="exportCSV" name="exportCSV" type="submit" class="hidden"
                    onclick="document.querySelector('#exportCSVForm').submit()">
            </form>
        </div>

        <div class="kriteria">
            <div class="mt-4 md:flex md:items-center md:justify-between">
                <div class="header-kriteria mb-3">
                    <div class="text-wrap text-gray-800 dark:text-gray-200">
                        <h1 class="text-lg leading-snug">Kriteria</h1>
                        <p class="text-xs dark:text-gray-400">Berikut merupakan kriteria dari metode MFEP</p>
                    </div>
                </div>
            </div>
            <div class="body-kriteria grid grid-cols-6 gap-3 mb-4 ">
                @php
                    $colorRing = [
                        'ring-green-800/30 dark:ring-green-100/30 border-green-800/80 dark:border-green-100/70',
                        'ring-green-700/30 dark:ring-green-200/30 border-green-700/80 dark:border-green-200/70',
                        'ring-green-600/30 dark:ring-green-300/30 border-green-600/80 dark:border-green-300/70',
                        'ring-green-500/30 dark:ring-green-400/30 border-green-500/80 dark:border-green-400/70',
                        'ring-green-400/30 dark:ring-green-500/30 border-green-400/80 dark:border-green-500/70',
                        'ring-green-300/30 dark:ring-green-600/30 border-green-300/80 dark:border-green-600/70',
                    ];
                @endphp
                @foreach ($criteriaWeights as $key => $value)
                    <div
                        class="card border-l dark:text-gray-200 dark:bg-darkBg/60 ring rounded-md px-3 py-2 h-full {{ $colorRing[$loop->index] }}">
                        <div class="flex flex-col justify-between h-full">
                            <h5 class="text-sm dark:text-gray-300">{{ $key }}</h5>
                            <div class="flex justify-between mt-2 items-center">
                                <h1 class="text-2xl dark:text-gray-50">{{ $value }}</h1>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="wrap-body">
            <nav class="relative mb-2 px-2 py-1 pt-0">
                <ul x-ref="parent" class="flex gap-1 text-sm dark:text-gray-100" x-data="{
                    activeClass: 'rounded-t-md text-green-500 dark:text-green-400 border-green-500 border-b-2',
                    setActivePanel(panel) {
                        $($refs.parent).find('li').removeClass(this.activeClass);
                        $(panel).addClass(this.activeClass);
                    }
                }"
                    x-effect="setActivePanel($refs.dataAwal)">
                    <li class="px-4 py-2" x-ref="dataAwal">
                        <button @click="(function(){appendRawData();setActivePanel($refs.dataAwal)})()"
                            ariaLabel="Data_Awal">
                            Data Awal
                        </button>
                    </li>
                    <li x-ref="konversi" class="px-4 py-2">
                        <button @click="(function(){appendFactoredData();setActivePanel($refs.konversi)})()"
                            ariaLabel="Konversi">
                            Faktor
                        </button>
                    </li>
                    <li x-ref="norm" class="px-4 py-2">
                        <button @click="(function(){appendWeightData();setActivePanel($refs.norm)})()" ariaLabel="Konversi">
                            Normalisasi
                        </button>
                    </li>
                    <li x-ref="rank" class="px-4 py-2">
                        <button @click="(function(){appendRankData();setActivePanel($refs.rank)})()" ariaLabel="Konversi">
                            Ranking
                        </button>
                    </li>
                </ul>
                <hr />
            </nav>
            <div class="body-profile ms-2" x-data="{}">
                <div class="container flex pb-10" id="panel" x-effect="appendRawData()">
                    <!-- append elemet go here -->
                    <div class="mt-1 flex flex-col">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                    <table
                                        class="w-full min-w-full table-auto divide-y divide-gray-200 px-2 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-darkBg " id="table-head">

                                        </thead>
                                        <tbody id="table-body"
                                            class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-darkBg">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@push('scripts')
    <script>
        function titleTable(titleFirst) {
            return element = /*html*/ `
            <tr>
                <th class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                            <span class="text-nowrap">${titleFirst}</span>
                        </button>
                    </th>
                @foreach ($criteriaWeights as $key => $value)
                    <th class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                            <span class="text-nowrap">{{ $key }}</span>
                        </button>
                    </th>
                @endforeach
            </tr>
            `
        }

        function elementRaw() {
            return element = /*html*/ `
                    @foreach ($raw as $key => $value)
                        <tr>
                            <td class="px-4 py-4 text-sm font-medium">
                                <div>
                                    <h2 class="text-nowrap rounded-full w-fit bg-emerald-100/60 w-fit px-3 py-1 text-sm font-normal text-emerald-500 dark:bg-emerald-950">
                                        {{ $key }}
                                    </h2>
                                </div>
                            </td>
                            @foreach ($value as $key2 => $value2)
                            <td class="px-4 py-4 text-sm font-medium">
                                <div class="">
                                    <h2 class="font-medium text-nowrap text-center text-gray-800 dark:text-white">
                                        {{ $value2 }}
                                    </h2>
                                </div>
                            </td>
                            @endforeach
                        </tr>
                    @endforeach
            `
        }

        function elementFactored() {
            return element = /*html*/ `
            @foreach ($factored as $key => $value)
                <tr>
                    <td class="px-4 py-4 text-sm font-medium"> 
                        <div>
                            <h2 class="text-nowrap rounded-full bg-emerald-100/60 w-fit px-3 py-1 text-sm font-normal text-emerald-500 dark:bg-emerald-950">
                                {{ $key }}
                            </h2>
                        </div>
                    </td>
                    @foreach ($value as $key2 => $value2)
                        <td class="px-4 py-4 text-sm font-medium"> 
                            <div>
                                <h2 class="font-medium text-center text-gray-800 dark:text-white">
                                    {{ $value2 }}
                                </h2>
                            </div>
                        </td>
                    @endforeach
                </tr>
            @endforeach
            `
        }

        function elementBobot() {
            return element = /*html*/ `
            @foreach ($weighted as $key => $value)
                <tr>
                    <td class="px-4 py-4 text-sm font-medium"> 
                        <div>
                            <h2 class="text-nowrap rounded-full bg-emerald-100/60 w-fit px-3 py-1 text-sm font-normal text-emerald-500 dark:bg-emerald-950">
                                {{ $key }}
                            </h2>
                        </div>
                    </td>
                    @foreach ($value as $key2 => $value2)
                        <td class="px-4 py-4 text-sm font-medium"> 
                            <div>
                                <h2 class="font-medium text-center text-gray-800 dark:text-white">
                                    {{ $value2 }}
                                </h2>
                            </div>
                        </td>
                    @endforeach
                </tr>
            @endforeach
            `
        }

        function elementRank() {
            return element = /*html*/ `
            @foreach ($results as $key => $value)
                <tr>
                    <td class="px-4 py-4 text-sm font-medium"> 
                        <div>
                            <h2 class="font-medium text-center text-gray-800 dark:text-white">
                                {{ $key + 1 }}
                            </h2>
                        </div>
                    </td>
                    <td class="px-4 py-4 text-sm font-medium"> 
                        <div>
                            <h2 class="text-nowrap rounded-full bg-emerald-100/60 w-fit px-3 py-1 text-sm font-normal text-emerald-500 dark:bg-emerald-950">
                                {{ $value['instance']->getNkk() }}
                            </h2>
                        </div>
                    </td>
                    <td class="px-4 py-4 text-sm font-medium"> 
                        <div>
                            <h2 class="font-medium text-gray-800 dark:text-white">
                                {{ $value['preference'] }}
                            </h2>
                        </div>
                    </td>
                </tr>
            @endforeach
            `
        }

        function customHeader(title) {
            elemen = ''
            elemen += /*html*/ `<tr>`
            title.forEach(element => {
                elemen += /*html*/ `
                <th class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                            <span class="text-nowrap">${element}</span>
                        </button>
                    </th>
                `
            });
            elemen += /*html*/ `</tr>`
            return elemen
        }




        function appendDataToTable(label, data) {
            $("#panel").fadeOut(300, () => {
                $('#table-head').html(label)
                $('#table-body').html(data)
            })

            $("#panel").fadeIn(300, () => {
                $('#table-head').html(label)
                $('#table-body').html(data)
            })
        }

        function appendRawData() {
            appendDataToTable(titleTable('Alt/Kriteria'), elementRaw())
        }

        function appendFactoredData() {
            appendDataToTable(titleTable('Alt/Faktor'), elementFactored())
        }

        function appendWeightData() {
            appendDataToTable(titleTable('Alt/Bobot'), elementBobot())
        }

        function appendRankData() {
            appendDataToTable(customHeader(['Ranking', 'Alternatif', 'Nilai']), elementRank())
        }
    </script>
@endpush
