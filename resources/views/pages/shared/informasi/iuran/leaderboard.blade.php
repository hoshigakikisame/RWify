{{-- extend to layouts/app --}}
@extends(request()->user()->getSidebarView())

@php
    $imageDummy = Vite::asset('resources/assets/images/avatar.jpg');
    $medalImage = [
        Vite::asset('resources/assets/elements/first-medal.svg'),
        Vite::asset('resources/assets/elements/second-medal.svg'),
        Vite::asset('resources/assets/elements/third-medal.svg'),
    ];
@endphp

{{-- content --}}
@section('content')
    <section class="container relative mx-auto mb-8 mt-7 px-4">
        <div class="sm:flex sm:items-center sm:justify-between pb-1">
            <div>
                <div class="flex items-center gap-x-3">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white">
                        Leaderboard Iuran
                    </h2>
                </div>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                    Informasi Mengenai Pembayaran Iuran Warga
                </p>
            </div>
        </div>
        <div class="mt-2 md:flex md:items-center md:justify-between">
            <div
                class="inline-flex divide-x overflow-hidden rounded-lg border bg-white dark:divide-gray-700 dark:border-gray-700 dark:bg-darkBg rtl:flex-row-reverse">
                <button id="filter-desc" onclick="window.utils.Request.filterRequest({'desc': 1})"
                    x-effect="
                        let params = new URLSearchParams(window.location.search)
                        ;(params.has('filters[desc]') && params.get('filters[desc]') == '1')
                            ? $('#filter-desc').addClass('!text-blue-400')
                            : $('#filter-desc').removeClass('!text-blue-400')
                    "
                    class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 sm:text-sm !text-blue-400">
                    Terajin
                </button>
                <button id="filter-asc" onclick="window.utils.Request.filterRequest({'desc': 0})"
                    x-effect="
                    let params = new URLSearchParams(window.location.search)
                    ;(params.has('filters[desc]') && params.get('filters[desc]') == '0')
                        ? $('#filter-asc').addClass('!text-blue-400')
                        : $('#filter-asc').removeClass('!text-blue-400')
                "
                    class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 sm:text-sm">
                    Termalas
                </button>

            </div>
        </div>
        <div class="rangking-body p-5 w-5/6 flex justify-evenly">
            @foreach ($top3LeaderboardUsers as $user)
                @php
                    $isUserOwnedPosition = $user->getNik() == request()->user()->getNik();
                @endphp
                <div
                    class="card w-52 border border-gray-300 dark:border-gray-500 rounded-xl relative {{ $isUserOwnedPosition ? 'bg-blue-50 dark:bg-blue-800' : '' }}">
                    <div class="medal absolute -right-6 w-16 -top-5">
                        <img class="" src="{{ $medalImage[$loop->index] }}" alt="">
                    </div>
                    <div class="card-body py-5 text-center">
                        <div class="imgRangkin inline-flex justify-center">
                            <div class="image w-24 h-24 rounded-full"
                                style="background: url({{ $user->getImageUrl() }});background-size:cover;">

                            </div>
                        </div>
                        <div class="text dark:text-gray-200">
                            <h1 class="text-lg font-medium ">{{ $user->getNamaLengkap() }}</h1>
                            <h6 class="text-xs font-Inter font-light mb-16 text-gray-700 dark:text-gray-400">
                                {{ $user->getNik() }}</h6>
                            <div class="status-pembayaran text-gray-600 dark:text-gray-400">
                                <h1 class="font-normal text-xs">Jumlah Bulan Pelunasan</h1>
                                <h6 class="font-Inter text-xs font-light dark:text-gray-300 text-gray-700">
                                    {{ $user->getVerifiedIuranCount() }} Bulan
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="tables mt-5">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                        <table class="w-full min-w-full table-auto divide-y divide-gray-200 px-2 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-darkBg">
                                <tr>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">No</span>
                                        </button>
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Nama</span>
                                        </button>
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Jumlah Bulan Pelunasan</span>
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-darkBg">
                                @foreach ($leaderboardUsers as $user)
                                    @php
                                        $isUserOwnedPosition = $user->getNik() == request()->user()->getNik();
                                    @endphp
                                    <tr class="{{ $isUserOwnedPosition ? 'bg-blue-50 dark:bg-blue-800' : '' }}">
                                        <td class="px-4 py-4 text-sm font-medium">
                                            <div>
                                                <h2 class="text-nowrap font-medium text-gray-800 dark:text-white">
                                                    {{ $loop->iteration + 3 }}
                                                </h2>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-sm">
                                            <div>
                                                <h4 class="text-gray-700 dark:text-gray-200">
                                                    {{ $user->getNamaLengkap() }}
                                                </h4>
                                            </div>
                                        </td>

                                        <td class="px-4 py-4 text-sm">
                                            <div>
                                                <h4 class="text-gray-700 dark:text-gray-200">
                                                    {{ $user->getVerifiedIuranCount() }} Bulan
                                                </h4>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
