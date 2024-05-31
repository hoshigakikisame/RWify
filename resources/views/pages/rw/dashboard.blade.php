@extends('layouts.sidebar.rw-sidebar')
@php
    // dd($reservasiJadwalTemuInstances);
@endphp
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
                        $list = [
                            [
                                'name' => 'Properti',
                                'count' => $propertiCount,
                                'lastAddedAt' => $propertiLastAddedAt,
                            ],
                            [
                                'name' => 'Pengaduan Warga',
                                'count' => $pengaduanCount,
                                'lastAddedAt' => $pengaduanLastAddedAt,
                            ],
                            [
                                'name' => 'UMKM',
                                'count' => $umkmCount,
                                'lastAddedAt' => $umkmLastAddedAt,
                            ],
                        ];
                    @endphp
                    @foreach ($list as $item)
                        <div class="info-element inline-flex flex-col gap-1 rounded-md border-2 px-4 py-2">
                            <h2 class="text-md tracking-wide">{{ $item['name'] }}</h2>
                            <div class="info-body mx-2 mb-2 flex justify-between">
                                <h1 class="ms-4 font-Montserrat text-4xl font-medium">{{ $item['count'] }}</h1>
                                <img src="" alt="grafik" />
                            </div>
                            <p class="text-xs italic">Terakhir ditambah {{ $item['lastAddedAt'] }} lalu</p>
                        </div>
                    @endforeach
                </div>
                <div class="statistic mb-3 rounded-lg border-2 px-8 py-4">
                    <div class="statistic-body flex">
                        <div class="text">
                            <h1 class="mb-4 text-3xl font-semibold leading-relaxed tracking-wide">Statistik Warga</h1>
                            <div class="desc flex flex-col gap-4">
                                @php
                                    $elemenChart = [
                                        'Lansia' => 'bg-[#F0F9D9]',
                                        'Dewasa' => 'bg-[#265073]',
                                        'Balita' => 'bg-[#277F80]',
                                        'Remaja' => 'bg-[#9AD0C2]',
                                        'Anak-Anak' => 'bg-[#A8EEE2]',
                                    ];
                                @endphp

                                @foreach ($elemenChart as $desc => $color)
                                    <div class="mark flex items-center gap-4">
                                        <div class="color {{ $color }} h-6 w-10 rounded-md"></div>
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
                <div class="calendar" x-data="{ eventShow: false }">
                    <div class="w-full max-w-sm rounded-lg border-2">
                        <div class="rounded-t bg-white p-5 dark:bg-gray-800 md:p-8">
                            <div class="flex items-center justify-between px-4">
                                <span id="calenderMonthYearTitle" tabindex="0"
                                    class="text-base font-bold text-gray-800 focus:outline-none dark:text-gray-100">
                                    October 2020
                                </span>
                                <div class="flex items-center">
                                    <button id="prev-calendar" aria-label="calendar backward"
                                        class="text-gray-800 hover:text-gray-400 focus:text-gray-400 dark:text-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <polyline points="15 6 9 12 15 18" />
                                        </svg>
                                    </button>
                                    <button id="next-calendar" aria-label="calendar forward"
                                        class="ml-3 text-gray-800 hover:text-gray-400 focus:text-gray-400 dark:text-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-chevron-right" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
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
                                        {{-- body day --}}
                                    </tbody>
                                </table>
                            </div>
                            <div class="action-event flex justify-end mt-4">
                                <button class="flex gap-1" @click="(()=>{displayReminders();eventShow = !eventShow})()">
                                    <div class="icon w-4 h-4 fill-indigo-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" x-show='!eventShow' data-name="Layer 1"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M19 2h-1V1a1 1 0 1 0-2 0v1H8V1a1 1 0 1 0-2 0v1H5C2.243 2 0 4.243 0 7v12c0 2.757 2.243 5 5 5h14c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5M5 4h14c1.654 0 3 1.346 3 3v1H2V7c0-1.654 1.346-3 3-3m14 18H5c-1.654 0-3-1.346-3-3v-9h20v9c0 1.654-1.346 3-3 3m-3.293-5.895a1 1 0 0 1 0 1.414l-1.613 1.613c-.577.577-1.336.866-2.094.866s-1.517-.289-2.094-.866l-1.613-1.613a.999.999 0 1 1 1.414-1.414L11 17.398V13a1 1 0 1 1 2 0v4.398l1.293-1.293a1 1 0 0 1 1.414 0" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" x-show='eventShow' data-name="Layer 1"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M19 2h-1V1a1 1 0 1 0-2 0v1H8V1a1 1 0 1 0-2 0v1H5C2.243 2 0 4.243 0 7v12c0 2.757 2.243 5 5 5h14c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5M5 4h14c1.654 0 3 1.346 3 3v1H2V7c0-1.654 1.346-3 3-3m14 18H5c-1.654 0-3-1.346-3-3v-9h20v9c0 1.654-1.346 3-3 3m-3.293-7.52a.999.999 0 1 1-1.414 1.414L13 14.601v4.398a1 1 0 1 1-2 0v-4.398l-1.293 1.293a.999.999 0 1 1-1.414-1.414l1.613-1.613a2.966 2.966 0 0 1 4.188 0z" />
                                        </svg>
                                    </div>

                                    <h1 class="text-xs underline text-indigo-300">Show All Event </h1>
                                </button>
                            </div>
                        </div>
                        <div class="">
                            <div id="event-desc" x-show="eventShow"
                                class="rounded-b bg-gray-50 px-5 py-5 dark:bg-gray-700 md:px-16 md:py-8">
                                <div class="px-4 flex flex-col gap-4" id="body-event-desc">
                                    {{-- body desc --}}
                                </div>
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
    {{-- @vite('resources/js/statisticChart.js') --}}
    <script type="module">
        import ageChartStatistic from '{{ Vite::asset('resources/js/statisticChart.js') }}';
        ageChartStatistic({{ $lansiaCount }}, {{ $dewasaCount }}, {{ $remajaCount }}, {{ $anakCount }},
            {{ $balitaCount }});
    </script>
    <script></script>
    <script>
        const calendarCanvas = document.getElementById('calendar');
        const calendarNextButton = document.getElementById('next-calendar');
        const calendarPrevButton = document.getElementById('prev-calendar');
        const listDay = ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'];

        let urlsHoliday = 'https://dayoffapi.vercel.app/api';

        let events = [
            @foreach ($reservasiJadwalTemuInstances as $item)
                {
                    id: {{ $item->getIdReservasiJadwalTemu() }},
                    date: "{{ $item->getJadwalTemu() }}",
                    title: "{{ $item->getSubjek() }}",
                    description: "{{ $item->getPesan() }}"
                },
            @endforeach
        ];
        let holiday = [];
        let today = new Date();
        let currentMonth = today.getMonth();
        let currentYear = today.getFullYear();

        // Counter to generate unique event IDs
        let eventIdCounter = 1;

        // Function to add events
        function addEvent(date, title, description) {

            if (date && title) {
                let eventId = eventIdCounter++;

                events.push({
                    id: eventId,
                    date: date,
                    title: title,
                    description: description,
                });

                showCalendar(currentMonth, currentYear);
                displayReminders();
            }
        }


        function displayRemindersByDay(day, month, year) {
            let bodyDesc = document.getElementById('body-event-desc');
            let element = ''

            for (let i = 0; i < events.length; i++) {
                let event = events[i];
                let eventDate = new Date(event.date);
                if (hasEventDay(day, month, year)) {
                    element += elementEventDesc(eventDate.getDate(), eventDate.getMonth(), eventDate.getFullYear());
                }
                $(bodyDesc).html(element);
            }

            let event = events[day];
            let eventDate = new Date(event.date);
            element += elementEventDesc(eventDate.getDate(), eventDate.getMonth(), eventDate.getFullYear());
            $(bodyDesc).html(element);
        }

        function displayReminders() {
            let bodyDesc = document.getElementById('body-event-desc');
            let element = ''

            for (let i = 0; i < events.length; i++) {
                let event = events[i];
                let eventDate = new Date(event.date);
                if (eventDate.getMonth() ===
                    currentMonth &&
                    eventDate.getFullYear() ===
                    currentYear) {
                    element += elementEventDesc(eventDate.getDate(), eventDate.getMonth(), eventDate.getFullYear());
                    $(bodyDesc).html(element);
                }
            }
        }

        fetch(urlsHoliday)
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then((responseData) => {
                // Process the retrieved user data
                responseData.map((e, i) => {
                    let data = {
                        id: i,
                        date: e['tanggal'],
                        title: e['keterangan'],
                        description: 'Hari Libur'
                    };
                    holiday.push(data);
                });
                console.log(holiday, events)
                showCalender(currentMonth, currentYear);
            })
            .catch((error) => {
                console.error('Error:', error);
            });

        // function to return element of week day name
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
            <td class="">
             <div class="px-2 py-2 cursor-pointer flex w-full justify-center">
                 <p class="text-base text-gray-500 dark:text-gray-100 font-medium">${day}</p>
             </div>
            </td>
                `;
        }

        function elementEventDay(day) {
            return /*html*/ `
            <td class="" @click='eventShow = !eventShow'>
             <div class="px-2 py-2 cursor-pointer flex w-full justify-center">
                 <p class="text-base text-indigo-500 dark:text-indigo-100 font-medium">${day}</p>
             </div>
            </td>
                `
        }

        function thisElementDay(day) {
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

        function elementRedDay(day) {
            return /*template*/ `
            <td class="">
             <div class="px-2 py-2 cursor-pointer flex w-full justify-center">
                 <p class="text-base text-red-500 dark:text-red-100 font-medium">${day}</p>
             </div>
            </td>
            `;
        }

        function elementEventDesc(date, month, year) {
            let element = '';
            let eventsOnDate = getEventDayOnDate(date, month, year);
            console.log(eventsOnDate, date, month, year)
            for (let i = 0; i < eventsOnDate.length; i++) {
                let event = eventsOnDate[i]
                console.log(event)
                let eventDate = new Date(event.date);
                element += /*html*/ ` 
            <div class="border-b border-dashed border-gray-400 pb-4" x-effect="eventShow">
    <p class="text-xs font-light leading-3 text-gray-500 dark:text-gray-300">${event.date}</p>
    <a tabindex="0" class="mt-2 text-lg font-medium leading-5 text-gray-800 focus:outline-none dark:text-gray-100">
        ${event.title}
    </a>
    <p class="pt-2 text-sm leading-4 leading-none text-gray-600 dark:text-gray-300">
        ${event.description}
    </p>
</div>`
            }
            return element;
        }

        // Function to navigate to the next month
        function next() {
            currentYear = currentMonth === 11 ? currentYear + 1 : currentYear;
            currentMonth = (currentMonth + 1) % 12;
            showCalender(currentMonth, currentYear);
        }

        // Function to navigate to the previous month
        function previous() {
            currentYear = currentMonth === 0 ? currentYear - 1 : currentYear;
            currentMonth = currentMonth === 0 ? 11 : currentMonth - 1;
            showCalender(currentMonth, currentYear);
        }

        // Function to jump to a specific month and year
        function jump() {
            currentYear = parseInt(selectYear.value);
            currentMonth = parseInt(selectMonth.value);
            showCalender(currentMonth, currentYear);
        }

        // Function to display the calendar
        function showCalender(month, year) {
            let thisDate = new Date(year, month);
            let firstDay = thisDate.getDay();
            let calendarBody = document.querySelector('#calendar-body');
            let calendarHTML = '';
            let date = 1;

            $('#calenderMonthYearTitle').text(`${thisDate.toLocaleString('default', { month: 'long' })} ${year}`);

            for (let i = 0; i < 6; i++) {
                let row = '<tr>';
                let endRow = '</tr>';
                for (let j = 0; j < 7; j++) {
                    if (i === 0 && j < firstDay - 1) {
                        row += elementDay('');
                    } else if (date > daysInMonth(month, year)) {
                        break;
                    } else {
                        if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                            row += thisElementDay(date);
                        } else if (hasEventDay(date, month, year)) {
                            row += elementEventDay(date);
                        } else if (j > 4) {
                            row += elementRedDay(date);
                        } else if (hasRedDay(date, month, year)) {
                            row += elementRedDay(date);
                        } else {
                            row += elementDay(date);
                        }

                        date++;
                    }
                }
                row += endRow;
                calendarHTML += row;
            }
            $(calendarBody).html(calendarHTML);
        }

        function getEventDayOnDate(date, month, year) {
            return events.filter(function(event) {
                let eventsDate = new Date(event.date);
                return (
                    eventsDate.getDate() === date && eventsDate.getMonth() === month && eventsDate
                    .getFullYear() === year
                );
            });
        }

        function hasEventDay(date, month, year) {
            return getEventDayOnDate(date, month, year).length > 0;
        }


        function getRedDayOnDate(date, month, year) {
            return holiday.filter(function(event) {
                let holidayDate = new Date(event.date);
                return (
                    holidayDate.getDate() === date && holidayDate.getMonth() === month && holidayDate
                    .getFullYear() === year
                );
            });
        }

        function hasRedDay(date, month, year) {
            return getRedDayOnDate(date, month, year).length > 0;
        }

        function daysInMonth(iMonth, iYear) {
            return 32 - new Date(iYear, iMonth, 32).getDate();
        }

        $(calendarCanvas).find('#calendar-header').append('<tr></tr>');

        $(document).ready(() => {
            $('#prev-calendar').on('click', () => {
                previous();
            });
            $('#next-calendar').on('click', () => {
                next();
            });
        });

        listDay.forEach((e) => {
            $(calendarCanvas).find('#calendar-header').find('tr').append(elementWeekDay(e));
        });
    </script>
@endpush
