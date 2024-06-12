{{-- extend to layouts/app --}}
@extends(request()->user()->getSidebarView())

{{-- content --}}
@section('content')
    <section class="container relative mx-auto mb-8 mt-7 px-4" x-data="{ modalOpen: false }">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <div class="flex items-center gap-x-3">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white">Warga</h2>
                    <span
                        class="rounded-full dark:bg-gray-600/30 px-3 py-1 text-xs dark:text-gray-100 bg-gray-200/50 text-gray-400">
                        {{ $count }} Warga
                    </span>
                </div>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-300">
                    Data ini terakhir diupdate
                    {{ $users->sortByDesc('dibuat_pada')->first()?->getDibuatPada()->diffForHumans(null, true) }}
                    yang lalu
                </p>
            </div>
        </div>

        <div class="mt-6 md:flex md:items-center md:justify-between">
            <div
                class="inline-flex divide-x overflow-hidden rounded-lg border bg-white dark:divide-gray-700 dark:border-gray-700 dark:bg-darkBg rtl:flex-row-reverse">
                <button id="filter-all" onclick="window.utils.Request.filterRequest({'role': ''})"
                    x-effect="
                        let params = new URLSearchParams(window.location.search)
                        ;(params.has('filters[role]') && params.get('filters[role]') == '') ||
                        ! params.has('filters[role]')
                            ? $('#filter-all').addClass('!text-ColorButton')
                            : $('#filter-all').removeClass('!text-ColorButton')
                    "
                    class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 sm:text-sm">
                    Semua Warga
                </button>

                @foreach (\App\Enums\User\UserRoleEnum::getValues() as $key => $value)
                    @if ($value == \App\Enums\User\UserRoleEnum::WARGA->value)
                        @continue
                    @endif

                    <button id="filter-{{ $key }}"
                        onclick="window.utils.Request.filterRequest({'role': '{{ $value }}'})"
                        x-effect="let params = new URLSearchParams(window.location.search); params.has('filters[role]') && params.get('filters[role]') == '{{ $value }}' ? $('#filter-{{ $key }}').addClass('!text-ColorButton') : $('#filter-{{ $key }}').removeClass('!text-ColorButton')"
                        class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800 sm:text-sm">
                        {{ $value }}
                    </button>
                @endforeach
            </div>

            <div class="w-1/3">
                <x-form.search-input placeholder="Tekan Enter Untuk Mencari Warga ...">

                </x-form.search-input>
            </div>
            {{-- <div id="search" class="relative mt-4 flex items-center md:mt-0" x-data="{ search: '' }">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="mx-3 h-5 w-5 text-gray-400 dark:text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </span>

                <input x-model="search" @keyup.enter="window.utils.Request.searchRequest(search,event)" type="text"
                    placeholder="Search"
                    class="block rounded-lg border border-gray-200 bg-white py-1.5 pl-11 pr-5 text-gray-700 placeholder-gray-400/70 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-darkBg dark:text-gray-300 dark:focus:border-blue-300 md:w-80 lg:w-full rtl:pl-5 rtl:pr-11" />
            </div> --}}
        </div>

        <div class="mt-6 flex flex-col">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                        <table class="w-full min-w-full table-auto divide-y divide-gray-200 px-2 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-darkBg">
                                <tr class="dark:bg-gray-900">
                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">NIK</span>
                                        </button>
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">NKK</span>
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
                                            <span class="text-nowrap">Tempat Tanggal Lahir</span>
                                        </button>
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-left text-sm font-normal text-gray-500 dark:text-gray-400 rtl:text-right">
                                        <button class="flex items-center gap-x-2 dark:fill-gray-400">
                                            <span class="text-nowrap">Alamat</span>
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-darkBg">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-4 py-4 text-sm font-medium">
                                            <div>
                                                <h2 class="font-medium text-gray-800 dark:text-white">
                                                    {{ $user->getNIK() }}
                                                </h2>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-sm font-medium">
                                            <div
                                                class="inline gap-x-2 rounded-full bg-emerald-100/60 px-3 py-1 text-sm font-normal text-emerald-500 dark:bg-gray-800">
                                                {{ $user->getNKK() }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-sm">
                                            <div>
                                                <h4 class="text-gray-700 dark:text-gray-200">
                                                    {{ $user->getNamaDepan() . ' ' . $user->getNamaBelakang() }}
                                                </h4>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-sm">
                                            <p class="mx-1 text-xs text-green-600">
                                                {{ $user->getTempatLahir() . ', ' . $user->getTanggalLahir() }}
                                            </p>
                                        </td>

                                        <td class="px-4 py-4 text-sm">
                                            <p class=".. w-52 truncate dark:text-gray-200 2xl:w-full">
                                                {{ $user->getAlamat() }}
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

        {{ $users->onEachSide(0)->links('elements.pagination') }}
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
