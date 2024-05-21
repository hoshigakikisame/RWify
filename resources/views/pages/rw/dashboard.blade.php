@extends('layouts.sidebar.rw-sidebar')
@section('content')
    <section class="relativ container mx-auto mb-8 mt-7 px-4">
        <div class="greeting mb-5">
            <h6 class="font-Inter">Hi {{ auth()->user()->nama_depan }},</h6>
            <h1 class="text-4xl font-semibold leading-relaxed">Selamat Datang di RWify</h1>
        </div>
        <div class="working flex gap-4">
            <div class="left">
                <div class="info mb-3 flex gap-5">
                    @php
                        $list = ['Pengajuan Dokumen', 'Pengaduan Warga', 'UMKM'];
                    @endphp

                    @foreach ($list as $name)
                        <div class="info-element inline-flex flex-col gap-1 rounded-md border-2 px-4 py-2">
                            <h2 class="text-md tracking-wide">{{ $name }}</h2>
                            <div class="info-body mx-2 mb-2 flex justify-between">
                                <h1 class="ms-4 font-Montserrat text-4xl font-medium">9</h1>
                                <img src="" alt="grafik" />
                            </div>
                            <p class="text-xs italic">Terakhir diperbarui 10 Apr 2024</p>
                        </div>
                    @endforeach
                </div>
                <div class="statistic mb-3 rounded-lg border-2 px-8 py-4">
                    <div class="statistic-body flex">
                        <div class="text">
                            <h1 class="mb-4 text-3xl font-semibold leading-relaxed tracking-wide">Statistik Warga</h1>
                            <div class="desc flex flex-col gap-4">
                                @php
                                    $elemenChart = ['Lansia' => '#F0F9D9', 'Dewasa' => '#265073', 'Balita' => '#277F80', 'Remaja' => '#9AD0C2', 'Anak-Anak' => '#A8EEE2'];
                                @endphp

                                @foreach ($elemenChart as $desc => $color)
                                    <div class="mark flex items-center gap-4">
                                        <div class="color h-6 w-10 rounded-md bg-[{{ $color }}]"></div>
                                        <h1>{{ $desc }}</h1>
                                    </div>
                                @endforeach()
                            </div>
                        </div>
                        <div class="chart">
                            <div class="">
                                <canvas width="300" id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="leaderboard">
                    <h1>Leaderboard Iuran</h1>
                </div>
            </div>
            <div class="right flex flex-col">
                <div class="calendar">
                    <div class="w-full max-w-sm rounded-lg border-2">
                        <div class="rounded-t bg-white p-5 dark:bg-gray-800 md:p-8">
                            <div class="flex items-center justify-between px-4">
                                <span
                                    id="calenderMonthYearTitle"
                                    tabindex="0"
                                    class="text-base font-bold text-gray-800 focus:outline-none dark:text-gray-100"
                                >
                                    October 2020
                                </span>
                                <div class="flex items-center">
                                    <button
                                        aria-label="calendar backward"
                                        class="text-gray-800 hover:text-gray-400 focus:text-gray-400 dark:text-gray-100"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-chevron-left"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <polyline points="15 6 9 12 15 18" />
                                        </svg>
                                    </button>
                                    <button
                                        aria-label="calendar forward"
                                        class="ml-3 text-gray-800 hover:text-gray-400 focus:text-gray-400 dark:text-gray-100"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-chevron-right"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <polyline points="9 6 15 12 9 18" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="flex items-center justify-between overflow-x-auto pt-12">
                                <table class="w-full" id="calendar">
                                    <thead id="calendar-header">
                                        <!-- header day -->
                                    </thead>
                                    <tbody id="calendar-body">
                                        <tr>
                                            <td class="">
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2"></div>
                                            </td>
                                            <td class="">
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2"></div>
                                            </td>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p
                                                        class="text-base font-medium text-gray-500 dark:text-gray-100"
                                                    ></p>
                                                </div>
                                            </td>
                                            <td class="">
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base font-medium text-gray-500 dark:text-gray-100">
                                                        1
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="">
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base font-medium text-gray-500 dark:text-gray-100">
                                                        2
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="">
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base text-gray-500 dark:text-gray-100">3</p>
                                                </div>
                                            </td>
                                            <td class="">
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base text-gray-500 dark:text-gray-100">4</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base font-medium text-gray-500 dark:text-gray-100">
                                                        5
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base font-medium text-gray-500 dark:text-gray-100">
                                                        6
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base font-medium text-gray-500 dark:text-gray-100">
                                                        7
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="h-full w-full">
                                                    <div
                                                        class="flex w-full cursor-pointer items-center justify-center rounded-full"
                                                    >
                                                        <a
                                                            role="link"
                                                            tabindex="0"
                                                            class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-700 text-base font-medium text-white hover:bg-indigo-500 focus:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-700 focus:ring-offset-2"
                                                        >
                                                            8
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base font-medium text-gray-500 dark:text-gray-100">
                                                        9
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base text-gray-500 dark:text-gray-100">10</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base text-gray-500 dark:text-gray-100">11</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base font-medium text-gray-500 dark:text-gray-100">
                                                        12
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base font-medium text-gray-500 dark:text-gray-100">
                                                        13
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base font-medium text-gray-500 dark:text-gray-100">
                                                        14
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base font-medium text-gray-500 dark:text-gray-100">
                                                        15
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base font-medium text-gray-500 dark:text-gray-100">
                                                        16
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base text-gray-500 dark:text-gray-100">17</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base text-gray-500 dark:text-gray-100">18</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base font-medium text-gray-500 dark:text-gray-100">
                                                        19
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base font-medium text-gray-500 dark:text-gray-100">
                                                        20
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base font-medium text-gray-500 dark:text-gray-100">
                                                        21
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base font-medium text-gray-500 dark:text-gray-100">
                                                        22
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base font-medium text-gray-500 dark:text-gray-100">
                                                        23
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base text-gray-500 dark:text-gray-100">24</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base text-gray-500 dark:text-gray-100">25</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base font-medium text-gray-500 dark:text-gray-100">
                                                        26
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base font-medium text-gray-500 dark:text-gray-100">
                                                        27
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base font-medium text-gray-500 dark:text-gray-100">
                                                        28
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base font-medium text-gray-500 dark:text-gray-100">
                                                        29
                                                    </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex w-full cursor-pointer justify-center px-2 py-2">
                                                    <p class="text-base font-medium text-gray-500 dark:text-gray-100">
                                                        30
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="graph">
                    <h1>Graph</h1>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    @vite('resources/js/statisticChart.js')
    <script type="module">
        const calendarCanvas = document.getElementById('calendar');
        const listDay = ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'];

        function elementWeekDay(weekDay) {
            return /*template*/ `
        <th>
        <div class="w-full flex justify-center">
        <p class="text-base font-medium text-center text-gray-800 dark:text-gray-100">
        ${weekDay}</p>
        </div>
        </th>
        `;
        }

        function elementDay(day) {
            return /*html*/ `
    <td class="pt-6">
     <div class="px-2 py-2 cursor-pointer flex w-full justify-center">
         <p class="text-base text-gray-500 dark:text-gray-100 font-medium">${day}</p>
     </div>
    </td>
        `;
        }

        function eventElementDay(day) {
            return /*template */ `
    <td>
     <div class="w-full h-full">
         <div class="flex items-center justify-center w-full rounded-full cursor-pointer">
             <a role="link" tabindex="0"
                 class="focus:outline-none  focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 focus:bg-indigo-500 hover:bg-indigo-500 text-base w-8 h-8 flex items-center justify-center font-medium text-white bg-indigo-700 rounded-full">${day}</a>
         </div>
     </div>
    </td>
        `;
        }

        let tr = document.createElement('tr');

        $(calendarCanvas).find('#calendar-header').append(tr);

        listDay.forEach((e) => {
            $(calendarCanvas).find('#calendar-header').find('tr').append(elementWeekDay(e));
        });

        function showCalender(month, year) {}
    </script>
@endpush
