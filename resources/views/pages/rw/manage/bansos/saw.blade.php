@extends(request()->user()->getSidebarView())
@section('content')
    <section class="container relative mx-auto mb-8 mt-7 px-4">
        <div class="header border-b pb-2">
            <div class="flex items-center gap-x-3">
                <h2 class="text-lg font-medium text-gray-800 dark:text-white">Perhitungan</h2>
                <span class="rounded-full bg-blue-100 px-3 py-1 text-xs text-blue-600 dark:bg-gray-800 dark:text-blue-400">
                    SAW
                </span>
            </div>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                Berikut merupakan hasil perhitungan menggunakan metode SAW.
            </p>
        </div>
        <div class="kriteria">
            <div class="mt-4 md:flex md:items-center md:justify-between">
                <div class="header-kriteria mb-3">
                    <div class="text-wrap text-gray-800 dark:text-gray-200">
                        <h1 class="text-lg leading-snug">Kriteria</h1>
                        <p class="text-xs dark:text-gray-400">Berikut merupakan kriteria dari metode SAW</p>
                    </div>
                </div>
            </div>
            <div class="body-kriteria grid grid-cols-6 gap-3 mb-4 ">
                @php
                    $colorRing = [
                        'ring-blue-800/30 dark:ring-blue-100/30 border-blue-800/80 dark:border-blue-100/70',
                        'ring-blue-700/30 dark:ring-blue-200/30 border-blue-700/80 dark:border-blue-200/70',
                        'ring-blue-600/30 dark:ring-blue-300/30 border-blue-600/80 dark:border-blue-300/70',
                        'ring-blue-500/30 dark:ring-blue-400/30 border-blue-500/80 dark:border-blue-400/70',
                        'ring-blue-400/30 dark:ring-blue-500/30 border-blue-400/80 dark:border-blue-500/70',
                        'ring-blue-300/30 dark:ring-blue-600/30 border-blue-300/80 dark:border-blue-600/70',
                    ];
                @endphp
                @foreach ($criteriaWeights as $key => $value)
                <div class="card border-l dark:text-gray-200 dark:bg-gray-800/60 ring rounded-md px-3 py-2 h-full {{ $colorRing[$loop->index] }}">
                    <div class="flex flex-col justify-between h-full">
                        <h5 class="text-sm dark:text-gray-300">{{ $key }}</h5>
                        <div class="flex justify-between mt-2 items-center">
                            <h1 class="text-2xl dark:text-gray-50">{{ $value['weight'] }}</h1>
                            <p class="text-xs px-3 py-1 rounded-full items-center h-fit w-fit {{ $value['type'] == 'benefit' ? 'text-green-700 dark:text-green-300 bg-green-200 dark:bg-green-800' : 'text-red-700 dark:text-red-300 bg-red-200 dark:bg-red-800/60' }}">
                                {{ $value['type'] }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach 
            </div>
        </div>
        <div class="wrap-body">
            <nav class="relative mb-2 px-2 py-1 pt-0">
                <ul x-ref="parent" class="flex gap-1 text-sm dark:text-gray-100" x-data="{
                    activeClass: 'rounded-t-md text-blue-500 dark:text-blue-400 border-blue-500 border-b-2',
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
                    <li x-ref="norm" class="px-4 py-2">
                        <button @click="(function(){appendNormData();setActivePanel($refs.norm)})()" ariaLabel="Konversi">
                            Normalisasi
                        </button>
                    </li>
                    <li x-ref="rank" class="px-4 py-2">
                        <button @click="(function(){appendRankData();setActivePanel($refs.rank)})()" ariaLabel="Konversi">
                            Rangking
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
                                        <thead class="bg-gray-50 dark:bg-gray-800 " id="table-head">

                                        </thead>
                                        <tbody id="table-body"
                                            class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900">
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
                                    <h2 class="text-nowrap rounded-full bg-emerald-100/60 px-3 py-1 text-sm font-normal text-emerald-500 dark:bg-gray-800">
                                        {{ $key }}
                                    </h2>
                                </div>
                            </td>
                            @foreach ($value as $key2 => $value2)
                            <td class="px-4 py-4 text-sm text-center font-medium">
                                <div>
                                    <h2 class="font-medium text-gray-800 dark:text-white">
                                        {{ round($value2, 4) }}
                                    </h2>
                                </div>
                            </td>
                            @endforeach
                        </tr>
                    @endforeach
            `
        }

        function elementNorm() {
            return element = /*html*/ `
            @foreach ($normalized as $key => $value)
                <tr>
                    <td class="px-4 py-4 text-sm font-medium"> 
                        <div>
                            <h2 class="text-nowrap rounded-full bg-emerald-100/60 px-3 py-1 text-sm font-normal text-emerald-500 dark:bg-gray-800">
                                {{ $key }}
                            </h2>
                        </div>
                    </td>
                    @foreach ($value as $key2 => $value2)
                        <td class="px-4 py-4 text-sm font-medium text-center"> 
                            <div>
                                <h2 class="font-medium text-gray-800 dark:text-white">
                                    {{ round($value2, 4) }}
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
                                <h2 class="text-nowrap rounded-full bg-emerald-100/60 px-3 py-1 text-sm font-normal text-emerald-500 dark:bg-gray-800">
                                    {{ $value['instance']->getNkk() }}
                                </h2>
                            </div>
                        </td>
                <td class="px-4 py-4 text-sm font-medium"> 
                    <div>
                        <h2 class="font-medium text-gray-800 dark:text-white">
                            {{ round($value['preference'], 4) }}
                        </h2>
                    </div>
                </td>
            </tr>
            @endforeach
            `
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

        function appendNormData() {
            appendDataToTable(titleTable('Alt/Kriteria'), elementNorm())
        }

        function appendRankData() {
            appendDataToTable(customHeader(['Rangking', 'Alternatif', 'Nilai']), elementRank())
        }
    </script>
@endpush
