@extends(request()->user()->getSidebarView())
@section('content')
    <section class="relative container mx-auto mb-3 mt-7 px-4 dark:text-gray-300">
        <div class="greeting mb-2 border-b pb-3 flex justify-between items-center">
            <div class="text-wrap">
                <h6 class="font-Inter text-ColorWhiteSidebar dark:text-ColorButton">Hi {{ auth()->user()->nama_depan }},</h6>
                <h1 class="text-4xl font-semibold text-gray-900 dark:text-gray-300">Selamat Datang di RWify</h1>
            </div>
            <x-etc.notification-widget :notifications="$unreadNotifications" />
        </div>
        <div class="working grid grid-cols-5 gap-4">
            <div class="left col-span-3">
                <div class="datavisual">
                    <div class="header-wrap mb-4">
                        <h1 class="font-Montserrat text-lg text-gray-600 dark:text-gray-300 font-medium">Total data</h1>
                        <p class="text-xs text-gray-400 dark:text-gray-500">Berikut merupakan kalkulasi dari seluruh data
                            yang
                            ada</p>
                    </div>
                    <div class="wrap-card px-2 mb-3 grid grid-cols-3 gap-4">
                        @php
                            $list = [
                                [
                                    'name' => 'Total Pengaduan',
                                    'count' => $pengaduanCount,
                                    'lastAddedAt' => $lastUpdatedPengaduan,
                                    'wrapClass' =>
                                        'ring-green-200/30 border-green-500/70 dark:border-green-400/70 dark:ring-green-800/30',
                                    'iconColor' => 'fill-green-700 dark:fill-green-400',
                                    'updateColor' => 'text-green-600',
                                ],
                                [
                                    'name' => 'Iuran',
                                    'count' => "Rp. $iuranSum",
                                    'lastAddedAt' => $lastUpdatedIuran,
                                    'wrapClass' =>
                                        'ring-green-200/30 border-green-500/70 dark:border-green-400/70 dark:ring-green-800/30',
                                    'iconColor' => 'fill-green-700 dark:fill-green-400',
                                    'updateColor' => 'text-green-600',
                                ],
                                [
                                    'name' => 'Jumlah Properti',
                                    'count' => $ownedPropertiCount,
                                    'lastAddedAt' => $lastUpdatedProperti,
                                    'wrapClass' =>
                                        'ring-green-200/30 border-green-500/70 dark:border-green-400/70 dark:ring-green-800/30',
                                    'iconColor' => 'fill-green-700 dark:fill-green-400',
                                    'updateColor' => 'text-green-600',
                                ],
                            ];
                        @endphp
                        @foreach ($list as $item)
                            <div
                                class="card bg-white/80 text-gray-600 dark:text-gray-100 ring border dark:bg-darkBg/30 px-5 py-4 rounded-lg {{ $item['wrapClass'] }}">
                                <div class="card-header mb-0.5 flex justify-between">
                                    <h1 class="text-xs font-medium tracking-wide">{{ $item['name'] }}</h1>
                                    <div class="icon {{ $item['iconColor'] }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" data-name="Isolation Mode"
                                            viewBox="0 0 24 24" class="w-5 h-5 backdrop-filter drop-shadow-md">
                                            <path
                                                d="M12 0a12 12 0 1 0 12 12A12.013 12.013 0 0 0 12 0m8.941 11h-3.478a18.4 18.4 0 0 0-2.289-7.411A9.01 9.01 0 0 1 20.941 11M9.685 14h4.63A17 17 0 0 1 12 19.9 16.9 16.9 0 0 1 9.685 14m-.132-3A16.25 16.25 0 0 1 12 4.1a16.24 16.24 0 0 1 2.447 6.9Zm-.727-7.411A18.4 18.4 0 0 0 6.537 11H3.059a9.01 9.01 0 0 1 5.767-7.411M3.232 14h3.409a18.9 18.9 0 0 0 2.185 6.411A9.02 9.02 0 0 1 3.232 14m11.942 6.411A18.9 18.9 0 0 0 17.359 14h3.409a9.02 9.02 0 0 1-5.594 6.411" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="card-body mb-2">
                                    <h3
                                        class="text-xl font-Montserrat font-semibold tracking-wider text-gray-950 dark:text-gray-50">
                                        {{ $item['count'] }}
                                    </h3>
                                </div>
                                <div class="card-footer">
                                    <p class="text-[9px] tracking-wide font-Montserrat">Terakhir diupdate <span
                                            class="{{ $item['updateColor'] }}">{{ $item['lastAddedAt'] }}</span></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="lastPembayaran">
                    <div class="header-wrap mb-4">
                        <h1 class="font-Montserrat text-lg text-gray-600 dark:text-gray-300 font-medium">Data Iuran
                            Terakhir</h1>
                        <p class="text-xs text-gray-400 dark:text-gray-500">Berikut merupakan data iuran terakhir yang
                            dilakukan
                        </p>
                    </div>
                    <div
                        class="w-full ring ring-gray-200/30 dark:ring-gray-700/30 border-gray-300  rounded-lg border dark:border-gray-400 overflow-hidden">
                        <div class="warp-riwayat py-5 px-6">
                            <div class="header flex justify-between items-center">
                                <p class="text-xs"><span class="text-green-500">3</span> data iuran terakhir anda</p>
                                <div class="icon fill-green-800 dark:fill-green-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24"
                                        class="w-5 h-5">
                                        <path
                                            d="M19 0H5C2.24 0 0 2.24 0 5v10c0 2.76 2.24 5 5 5h1.92l3.75 3.16c.38.34.86.51 1.34.51s.93-.16 1.29-.48l3.85-3.18H19c2.76 0 5-2.24 5-5V5c0-2.76-2.24-5-5-5m-5.62 15H13c0 .55-.45 1-1 1s-1-.45-1-1h-.27c-1.07 0-2.06-.57-2.6-1.5-.28-.48-.11-1.09.36-1.37.48-.28 1.09-.11 1.37.36.18.31.51.5.87.5h2.64a.623.623 0 0 0 .1-1.24l-3.29-.55a2.61 2.61 0 0 1-2.19-2.59c0-1.45 1.18-2.62 2.62-2.62h.38c0-.55.45-1 1-1s1 .45 1 1h.27c1.07 0 2.06.57 2.6 1.5.28.48.11 1.09-.36 1.37-.48.28-1.09.11-1.37-.36-.18-.31-.51-.5-.87-.5h-2.64a.623.623 0 0 0-.1 1.24l3.28.55c1.27.21 2.19 1.3 2.19 2.59 0 1.45-1.18 2.62-2.62 2.62Z" />
                                    </svg>
                                </div>
                            </div>
                            @foreach ($lastIuranPaidInstances as $iuran)
                            <div
                                class="wrap-card mt-5 border-l-8 rounded-lg overflow-hidden border-green-600/80 dark:border-green-500/80 bg-green-200/50 dark:bg-green-900/50 mb-5">
                                <div class="wrap px-4 py-3 ">
                                    <div class="wrap-body grow text-green-950 dark:text-green-50">
                                        <p class="text-sm">Pembayaran bulan {{ $iuran->getBulan() }}, {{ $iuran->getTahun() }}</p>
                                        <div class="footer flex justify-between">
                                            <a href="{{ route('warga.layanan.pembayaranIuran.iuran') }}" class="text-xs">Detail</a>
                                            <p class="text-xs">{{ $iuran->getDibuatPada()->diffForHumans() }}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="right col-span-2">
                <div class="header-wrap mb-4 w-fit">
                    <h1 class="font-Montserrat text-lg text-gray-600 dark:text-gray-300 font-medium">Kalender</h1>
                    <p class="text-xs text-gray-400 dark:text-gray-600 text-wrap">Check pertemuan anda di kalender ini</p>
                </div>

                <div class="calendar w-full" x-data="{ eventShow: false }">
                    <div
                        class="w-full ring ring-gray-200/30 dark:ring-gray-700/30 border-gray-300 dark:bg-darkBg/30 rounded-lg border dark:border-gray-400 overflow-hidden">
                        <div class="rounded-t py-5 px-6">
                            <div class="flex items-center justify-between">
                                <div class="month-year flex gap-2">

                                    <h1 id="calenderMonthYearTitle" tabindex="0"
                                        class="text-base font-semibold text-gray-800 focus:outline-none dark:text-gray-100">
                                        October 2020
                                    </h1>
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24"
                                            class="w-4 h-4 drop-shadow-md fill-green-700">
                                            <path
                                                d="M11.206 14.656c-.246 1.557-.756 3.155-1.257 4.66a1.001 1.001 0 0 1-1.897-.633c.238-.715.479-1.45.687-2.184a1.01 1.01 0 0 1-.852-.445 1 1 0 0 1 .277-1.387l1.5-1a1 1 0 0 1 1.542.988Zm6.792-4.209c0 4.144-.977 8.042-1.798 10.579a4.29 4.29 0 0 1-4.1 2.975H3.322a3.46 3.46 0 0 1-2.837-1.52c-.581-.864-.695-1.895-.314-2.825.823-2.012 2.356-5.757 2.406-9.17a1 1 0 0 1 .353-.748c.491-.408 1.237-.736 1.839-.739a2.67 2.67 0 0 1 1.724.616 1.63 1.63 0 0 0 2.087 0 2.68 2.68 0 0 1 3.418 0 1.63 1.63 0 0 0 2.087 0 2.67 2.67 0 0 1 1.735-.616c.598.006 1.281.277 1.769.682a1 1 0 0 1 .409.766m-2.004.583a.69.69 0 0 0-.631.125c-1.313 1.091-3.326 1.091-4.641 0a.68.68 0 0 0-.864 0c-1.315 1.091-3.327 1.091-4.642 0a.69.69 0 0 0-.657-.116c-.158 3.163-1.308 6.369-2.539 9.375-.17.415.005.775.124.953.262.391.713.634 1.177.634h8.778c1.007 0 1.89-.639 2.197-1.59.741-2.29 1.618-5.733 1.697-9.381ZM24 4.001v14c0 2.206-1.794 4-4 4h-1a1 1 0 1 1 0-2h1c1.103 0 2-.897 2-2V7c-.614 0-1.179-.23-1.63-.616a1.59 1.59 0 0 0-2.074 0c-.451.386-1.016.616-1.63.616s-1.179-.23-1.63-.616a1.59 1.59 0 0 0-2.074 0c-.451.386-1.016.616-1.63.616s-1.179-.23-1.63-.616a1.59 1.59 0 0 0-2.074 0l-.014.012c-.637.539-1.616.068-1.616-.767V4A4.007 4.007 0 0 1 10 0h10c2.206 0 4 1.794 4 4Zm-2 0c0-1.103-.897-2-2-2H10c-1.103 0-2 .897-2 2v.056a4 4 0 0 1 .667-.056c.856 0 1.687.307 2.338.865q.157.134.328.135c.171.001.224-.045.328-.135a3.596 3.596 0 0 1 4.676 0q.157.134.328.135c.171.001.224-.045.328-.135a3.596 3.596 0 0 1 4.676 0 .5.5 0 0 0 .328.135v-1Z" />
                                        </svg>
                                    </div>
                                </div>
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
                            <div class="flex flex-col relative items-center justify-between overflow-x-auto pt-6">
                                <div id="loader-element"
                                    class="w-60 h-60 relative rounded-lg flex justify-center items-center">
                                    <svg class="animate-spin h-5 w-5 text-whit" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25  stroke-blue-800" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75 fill-blue-800" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </div>
                                <table class="w-full" id="calendar">
                                    <thead id="calendar-header">
                                        <!-- header day -->
                                    </thead>
                                    <tbody id="calendar-body" class="min-h-60">
                                        {{-- body day --}}

                                    </tbody>
                                </table>
                            </div>
                            <div class="action-event flex justify-end mt-4">
                                <button class="flex gap-1" id="showAll" @click="eventShow = !eventShow">
                                    <div class="icon w-4 h-4 dark:fill-green-400 fill-green-700">
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

                                    <h1 class="text-xs underline dark:text-green-400 text-green-700">Show All Event </h1>
                                </button>
                            </div>
                        </div>
                        <div id="event-desc" x-show="eventShow"
                            class="rounded-b bg-gray-50 px-5 py-5 dark:bg-gray-700 md:px-4 md:py-8">
                            <div class="px-4 flex flex-col gap-4" id="body-event-desc">
                                {{-- body desc --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@push('scripts')
    <script type="module">
        $('#showAll').on('click', () => {
            displayReminders(events, holiday);
        });


        $(document).ready(() => {
            $('#prev-calendar').on('click', () => {
                previous();
            });
            $('#next-calendar').on('click', () => {
                next();
            });
        });
    </script>
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
                    description: `{{ $item->getPesan() }}`,
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
            }
        }


        function displayRemindersByDay(day, month, year) {
            let bodyDesc = document.getElementById('body-event-desc');
            let element = ''

            arrayOfEvent = events.concat(holiday);


            for (let i = 0; i < arrayOfEvent.length; i++) {
                let event = arrayOfEvent[i];

                let eventDate = new Date(event.date);
                if (hasEventDay(day, month, year, arrayOfEvent) && eventDate.getDate() === day && eventDate
                    .getMonth() ===
                    month &&
                    eventDate.getFullYear() === year) {
                    element += elementEventDesc(eventDate.getDate(), eventDate.getMonth(), eventDate
                        .getFullYear(), event);
                }
            }
            $(bodyDesc).html(element);
        }

        function displayReminders(...args) {
            let bodyDesc = document.getElementById('body-event-desc');
            let element = ''


            args.forEach(array => {
                for (let i = 0; i < array.length; i++) {
                    let event = array[i];
                    let eventDate = new Date(event.date);
                    if (eventDate.getMonth() === currentMonth && eventDate.getFullYear() === currentYear) {
                        element += elementEventDesc(eventDate.getDate(), eventDate.getMonth(), eventDate
                            .getFullYear(), event);
                    }
                }
            });


            $(bodyDesc).html(element);
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
                $('#loader-element').addClass('hidden');

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

        function elementEventDay(day, month, year) {

            return /*html*/ `
        <td class="" @click='(function(){displayRemindersByDay(${day},${month},${year});if(!eventShow == true){ eventShow = !eventShow } })()'>
         <div class="px-2 py-2 cursor-pointer flex w-full justify-center">
             <p class="text-base text-green-500 dark:text-green-500 font-medium">${day}</p>
         </div>
        </td>
            `
        }

        function thisElementDay(day, month, year) {
            return /*template */ `
        <td @click='(function(){displayRemindersByDay(${day},${month},${year});if(!eventShow == true){ eventShow = !eventShow } })()'>
         <div class="w-full h-full">
             <div class="flex items-center justify-center w-full rounded-full cursor-pointer">
                 <a role="link" tabindex="0"
                     class="focus:outline-none  focus:ring-2 focus:ring-offset-2 focus:ring-green-700 focus:bg-green-500 hover:bg-green-500 text-base w-8 h-8 flex items-center justify-center font-medium text-white bg-green-700 rounded-full">${day}</a>
             </div>
         </div>
        </td>
            `;
        }

        function elementRedDay(day, month, year) {
            return /*template*/ `
        <td class="" @click='(function(){displayRemindersByDay(${day},${month},${year});if(!eventShow == true){ eventShow = !eventShow } })()'>
         <div class="px-2 py-2 cursor-pointer flex w-full justify-center">
             <p class="text-base text-red-500 dark:text-red-500 font-medium">${day}</p>
         </div>
        </td>
        `;
        }

        function elementEventDesc(date, month, year, event) {
            let element = '';
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

            if ($(calendarCanvas).find('#calendar-header').find('tr').length == 0) {

                $(calendarCanvas).find('#calendar-header').append('<tr></tr>');

                listDay.forEach((e) => {
                    $(calendarCanvas).find('#calendar-header').find('tr').append(elementWeekDay(e));
                });
            }


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
                            row += thisElementDay(date, month, year);
                        } else if (hasEventDay(date, month, year, events)) {
                            row += elementEventDay(date, month, year);
                        } else if (hasEventDay(date, month, year, holiday)) {
                            row += elementRedDay(date, month, year);
                        } else if (j > 4) {
                            row += elementRedDay(date, month, year);
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

        function getEventDayOnDate(date, month, year, arrayOfEvent) {
            return arrayOfEvent.filter(function(event) {
                let eventsDate = new Date(event.date);
                return (
                    eventsDate.getDate() === date && eventsDate.getMonth() === month && eventsDate
                    .getFullYear() === year
                );
            });
        }

        function hasEventDay(date, month, year, arrayOfEvent) {
            return getEventDayOnDate(date, month, year, arrayOfEvent).length > 0;
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
    </script>
@endpush
