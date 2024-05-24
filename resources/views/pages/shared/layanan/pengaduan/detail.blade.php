{{-- extend to layouts/app --}}
@extends(request()->user()->getSidebarView())

{{-- content --}}
@php
    $status = \App\Enums\Pengaduan\PengaduanStatusEnum::getValues();
@endphp

@section("content")
    <section class="relative flex h-full justify-between">
        <div class="body mb-7 mt-7 px-6 md:px-12">
            <div class="mb-8 flex flex-col gap-x-3 sm:flex sm:justify-between">
                <h2 class="font-Poppins text-2xl font-medium text-gray-900 dark:text-gray-100">
                    {{ $pengaduanInstance->judul }}
                </h2>
            </div>

            <div class="flex flex-col">
                <div class="profile flex gap-2">
                    <div
                        class="mr-3 h-20 w-20 rounded-full bg-white bg-cover bg-center dark:bg-gray-900"
                        style="background-image: url('{{ $pengaduanInstance->user->image_url }}')"
                    ></div>
                    <div class="flex flex-col justify-center">
                        <h2 class="font-Poppins text-lg font-medium leading-5 text-gray-800 dark:text-gray-200">
                            {{ $pengaduanInstance->getNamaPengadu() }}
                        </h2>
                        <p class="mb-1 text-sm text-gray-500 dark:text-gray-400">
                            {{ $pengaduanInstance->getNikPengadu() }}
                        </p>
                        <p
                            class="rounded-full bg-blue-100 px-3 text-[11px] text-blue-500 dark:bg-blue-950 dark:text-blue-500"
                        >
                            Reported at
                            {{ date("d-m-y H:i", strtotime($pengaduanInstance->getDibuatPada())) }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="content mt-8">
                <h2 class="font-Poppins font-medium leading-8 text-gray-800 dark:text-white">Deskripsi Pengaduan</h2>
                <p class="font-Inter text-gray-700 dark:text-gray-300">{{ $pengaduanInstance->getIsi() }}</p>
            </div>

            <div class="mt-8 px-4 sm:block sm:p-0">
                <h2 class="font-Poppins font-medium leading-8 text-gray-800 dark:text-white">Lampiran</h2>
                <div>
                    <img src="{{ $pengaduanInstance->getImageUrl() }}" class="w-110 h-96" />
                </div>
            </div>

            <div class="flex h-32 items-center">
                <h2 class="font-Poppins font-medium leading-8 text-gray-800 dark:text-white">Status Terkini</h2>
                <div class="w-fit">
                    <span
                        class="@php
                        $statusStyle = [
                            "baru" => "bg-blue-50 text-blue-700 ring-blue-700/10 dark:bg-blue-950 dark:text-blue-200",
                            "diproses" => "bg-yellow-50 text-yellow-800 ring-yellow-600/20 dark:bg-yellow-950 dark:text-yellow-200",
                            "invalid" => "bg-red-50 text-red-700 ring-red-600/10 dark:bg-red-950 dark:text-red-300",
                            "selesai" => "bg-green-50 text-green-700 ring-green-600/20 dark:bg-green-950 dark:text-green-300",
                        ];
                        $dotStyle = [
                            "baru" => "bg-blue-500 dark:bg-blue-300",
                            "diproses" => "bg-yellow-500 dark:bg-yellow-300",
                            "invalid" => "bg-red-500 dark:bg-red-300",
                            "selesai" => "bg-green-500 dark:bg-green-300",
                        ];

 @endphp @if ($pengaduanInstance->getStatus())
                            {{ $statusStyle[$pengaduanInstance->getStatus()] }}
                        @else
                            bg-gray-50
                            text-gray-600
                            ring-gray-500/10
                        @endif mx-1 ml-2 inline-flex items-center justify-center rounded-full px-3 py-1.5"
                    >
                        <span
                            class="@if ($pengaduanInstance->getStatus())
                                {{ $dotStyle[$pengaduanInstance->getStatus()] }}
                            @else
                                bg-gray-50
                            @endif me-1 inline-block rounded-full p-[5px]"
                        ></span>
                        <span class="text-sm">
                            {{ $pengaduanInstance->getStatus() }}
                        </span>
                    </span>
                </div>
            </div>
        </div>
        @if (request()->user()->getRole() != \App\Enums\User\UserRoleEnum::WARGA->value && request()->user()->getRole() != \App\Enums\User\UserRoleEnum::KETUA_RUKUN_TETANGGA->value))
            <aside class="rounded-bl-lg px-5 pt-6" x-ref="sideContainer" x-data="{ sideAction: false }">
                <div class="inline-flex gap-2">
                    <button
                        id="actionButton"
                        class="fill-gray-900 transition-all duration-300 ease-in-out dark:fill-gray-100"
                        @click="sideAction= !sideAction; $($refs.sideContainer).toggleClass('bg-gray-50 dark:bg-gray-800 shadow-md')"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4" x-show="!sideAction">
                            <path
                                d="M12 24a1 1 0 0 1-.71-.29l-8.17-8.17a5 5 0 0 1 0-7.08L11.29.29a1 1 0 1 1 1.42 1.42L4.54 9.88a3 3 0 0 0 0 4.24l8.17 8.17a1 1 0 0 1 0 1.42A1 1 0 0 1 12 24"
                            />
                            <path
                                d="M22 24a1 1 0 0 1-.71-.29l-9.58-9.59a3 3 0 0 1 0-4.24L21.29.29a1 1 0 1 1 1.42 1.42l-9.59 9.58a1 1 0 0 0 0 1.42l9.59 9.58a1 1 0 0 1 0 1.42A1 1 0 0 1 22 24"
                            />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4" x-show="sideAction">
                            <path
                                d="M11.83 24a1 1 0 0 1-.71-.29 1 1 0 0 1 0-1.42l8.17-8.17a3 3 0 0 0 0-4.24l-8.17-8.17A1 1 0 1 1 12.54.29l8.17 8.17a5 5 0 0 1 0 7.08l-8.17 8.17a1 1 0 0 1-.71.29"
                            />
                            <path
                                d="M1.83 24a1 1 0 0 1-.71-.29 1 1 0 0 1 0-1.42l9.59-9.58a1 1 0 0 0 0-1.42L1.12 1.71A1 1 0 0 1 2.54.29l9.58 9.59a3 3 0 0 1 0 4.24l-9.58 9.59a1 1 0 0 1-.71.29"
                            />
                        </svg>
                    </button>
                    <div
                        class="header"
                        style="display: none"
                        x-show="sideAction"
                        x-transition:enter="duration-300 ease-out"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transform transition duration-200 ease-in"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                    >
                        <h1 class="ml-3 font-Poppins font-medium leading-8 text-gray-900 dark:text-gray-100">
                            Rubah Status Pengaduan
                        </h1>
                    </div>
                </div>
                <div
                    id="updateStatus"
                    class="sidebar-action mb-8 me-5 ms-6 w-72 px-4 transition-all"
                    x-show="sideAction"
                    style="display: none"
                    @click.away="sideAction = false; $($refs.sideContainer).removeClass('bg-gray-50 dark:bg-gray-800 shadow-md')"
                    x-transition:enter="duration-300 ease-out"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transform transition duration-200 ease-in"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0 "
                >
                    <form
                        id="updateForm"
                        onclick="window.utils.Request.actionRequest(`{{ route("rw.manage.pengaduan.update") }}`, '#updateStatus', '#updateForm')"
                    >
                        @csrf
                        <input
                            type="text"
                            name="id_pengaduan"
                            key="id_pengaduan"
                            value="{{ $pengaduanInstance->id_pengaduan }}"
                            hidden
                        />
                        <x-form.select-input-form
                            title="Status"
                            key="status"
                            :options="$status"
                            placeholder="Pilih Status Pengaduan"
                            selected="{{$pengaduanInstance->getStatus()}}"
                        />
                        <div class="heading">
                            <p class="mt-3 max-w-60 text-wrap text-xs text-gray-950 dark:text-gray-500">
                                Note: Pastikan pengaduan sudah benar benar tervalidasi sebelum merubah status pengaduan
                            </p>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <button
                                type="submit"
                                class="transform rounded-md bg-blue-500 px-3 py-2 text-sm capitalize tracking-wide text-white transition-colors duration-200 hover:bg-blue-600 focus:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700"
                            >
                                Save Pengaduan
                            </button>
                        </div>
                    </form>
                </div>
            </aside>
        @endif
    </section>
@endsection

@push("scripts")
    <script>
        function request(url, selectorParent, selectorForm) {
            $(selectorParent).ready((e) => {
                $(selectorForm).on('submit', function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: url,
                        type: 'POST',
                        beforeSend: window.Loading.showLoading,
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        success: function (res) {
                            $.ajax({
                                url: document.location,
                                type: 'GET',
                                success: function (response) {
                                    let parser = new DOMParser();
                                    let doc = parser.parseFromString(response, 'text/html');
                                    $('body').html(doc.body.innerHTML);
                                    setTimeout(function () {
                                        $('.flash-message').remove();
                                    }, 5000);
                                },
                            });
                        },
                        error: function (res) {
                            $.each(res.responseJSON.errors, (key, value) => {
                                value.forEach((element) => {
                                    $(e.currentTarget)
                                        .find('#' + key)
                                        .siblings('#error')
                                        .append(`<li>${element}</li>`);
                                });

                                setTimeout((element) => {
                                    $(e.currentTarget)
                                        .find('#' + key)
                                        .siblings('#error')
                                        .fadeOut('slow', () => {
                                            $(e.currentTarget)
                                                .find('#' + key)
                                                .siblings('#error')
                                                .empty();
                                        });
                                }, 8000);
                            });
                        },
                    });
                });
            });
        }
    </script>
@endpush
