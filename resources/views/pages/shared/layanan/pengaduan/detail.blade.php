{{-- extend to layouts/app --}}
@extends(request()->user()->getSidebarView())

{{-- content --}}
@php
$status = \App\Enums\Pengaduan\PengaduanStatusEnum::getValues();

@endphp
@section('content')
<section class="relative flex justify-between h-full">
    <div class="body px-6 md:px-12 mt-7 mb-7">
        <div class="mb-8 flex flex-col sm:flex sm:justify-between gap-x-3">
            <h2 class=" text-2xl font-medium text-gray-900 dark:text-gray-100 font-Poppins">{{ $pengaduanInstance->judul }}</h2>
        </div>

        <div class="flex flex-col">
            <div class="profile flex gap-2">
                <div class="mr-3">
                    <img src="{{ $pengaduanInstance->user->image_url }}" alt="Profile" class="w-20 h-20 rounded-full">
                </div>
                <div class="flex flex-col justify-center">
                    <h2 class="text-lg font-medium font-Poppins text-gray-800 dark:text-gray-200 leading-5">
                        {{ $pengaduanInstance->getNamaPengadu() }}
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">{{ $pengaduanInstance->getNikPengadu() }}</p>
                    <p class="text-[11px] text-blue-500 dark:text-blue-500 bg-blue-100 dark:bg-blue-950 px-3 rounded-full">Reported at
                        {{date('d-m-y H:i', strtotime($pengaduanInstance->getDibuatPada()));}}
                    </p>
                </div>
            </div>
        </div>


        <div class="content mt-8">
            <h2 class="leading-8 font-medium text-gray-800 dark:text-white font-Poppins">Deskripsi Pengaduan</h2>
            <p class="text-gray-700 dark:text-gray-300 font-Inter">{{ $pengaduanInstance->getIsi() }}</p>
        </div>

        <div class="px-4 sm:block sm:p-0 mt-8">
            <h2 class="leading-8 font-medium text-gray-800 dark:text-white font-Poppins">Lampiran</h2>
            <div>
                <img src="{{ $pengaduanInstance->getImageUrl()}}" class="w-110 h-96">
            </div>
        </div>

        <div class="flex items-center h-32">
            <h2 class="leading-8 font-medium text-gray-800 dark:text-white font-Poppins">Status Terkini</h2>
            <div class="w-fit">

                <span class="inline-flex items-center justify-center mx-1 px-3 py-1.5 rounded-full ml-2 @php 
                $statusStyle = [
                    'baru' => 'bg-blue-50 dark:bg-blue-950 text-blue-700 dark:text-blue-200 ring-blue-700/10', 
                    'diproses' => 'bg-yellow-50 dark:bg-yellow-950 dark:text-yellow-200 text-yellow-800 ring-yellow-600/20', 
                    'invalid' => 'bg-red-50 dark:bg-red-950 text-red-700 dark:text-red-300 ring-red-600/10', 
                    'selesai' => 'bg-green-50 dark:bg-green-950 text-green-700 dark:text-green-300 ring-green-600/20'
                ]; 
                $dotStyle=[
                    'baru' => 'bg-blue-500 dark:bg-blue-300', 
                    'diproses' => 'bg-yellow-500 dark:bg-yellow-300',
                    'invalid' => 'bg-red-500 dark:bg-red-300', 
                    'selesai' => 'bg-green-500 dark:bg-green-300'
                ];
                @endphp
                    @if($pengaduanInstance->getStatus())
                        {{ $statusStyle[$pengaduanInstance->getStatus()] }}
                    @else
                        bg-gray-50 text-gray-600 ring-gray-500/10 
                    @endif
                    ">
                    <span class="me-1 p-[5px] rounded-full inline-block
                    @if ($pengaduanInstance->getStatus()) 
                        {{ $dotStyle[$pengaduanInstance->getStatus()] }}
                    @else 
                        bg-gray-50
                    @endif
                        "></span>
                    <span class="text-sm">
                        {{ $pengaduanInstance->getStatus() }}
                    </span>
                </span>
            </div>
        </div>
    </div>
    <aside class="pt-6 px-5 rounded-bl-lg" x-ref="sideContainer" x-data=" { sideAction: false }">
        <div class="inline-flex gap-2">
            <button id="actionButton" class="fill-gray-900 dark:fill-gray-100 transition-all duration-300 ease-in-out" @click="sideAction= !sideAction; $($refs.sideContainer).toggleClass('bg-gray-50 dark:bg-gray-800 shadow-md')">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4 " x-show="!sideAction">
                    <path d="M12 24a1 1 0 0 1-.71-.29l-8.17-8.17a5 5 0 0 1 0-7.08L11.29.29a1 1 0 1 1 1.42 1.42L4.54 9.88a3 3 0 0 0 0 4.24l8.17 8.17a1 1 0 0 1 0 1.42A1 1 0 0 1 12 24" />
                    <path d="M22 24a1 1 0 0 1-.71-.29l-9.58-9.59a3 3 0 0 1 0-4.24L21.29.29a1 1 0 1 1 1.42 1.42l-9.59 9.58a1 1 0 0 0 0 1.42l9.59 9.58a1 1 0 0 1 0 1.42A1 1 0 0 1 22 24" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4 " x-show="sideAction">
                    <path d="M11.83 24a1 1 0 0 1-.71-.29 1 1 0 0 1 0-1.42l8.17-8.17a3 3 0 0 0 0-4.24l-8.17-8.17A1 1 0 1 1 12.54.29l8.17 8.17a5 5 0 0 1 0 7.08l-8.17 8.17a1 1 0 0 1-.71.29" />
                    <path d="M1.83 24a1 1 0 0 1-.71-.29 1 1 0 0 1 0-1.42l9.59-9.58a1 1 0 0 0 0-1.42L1.12 1.71A1 1 0 0 1 2.54.29l9.58 9.59a3 3 0 0 1 0 4.24l-9.58 9.59a1 1 0 0 1-.71.29" />
                </svg>
            </button>
            <div class="header" style="display: none;" x-show="sideAction" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <h1 class="leading-8 font-medium font-Poppins text-gray-900 dark:text-gray-100 ml-3"> Rubah Status Pengaduan</h1>
            </div>
        </div>
        <div id="updateStatus" class="mb-8 me-5 sidebar-action px-4 ms-6 w-72 transition-all" x-show="sideAction" style="display: none;" @click.away="sideAction = false; $($refs.sideContainer).removeClass('bg-gray-50 dark:bg-gray-800 shadow-md')" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 ">
            <form id="updateForm" onclick="request(`{{ route('rw.manage.pengaduan.update') }}`, '#updateStatus', '#updateForm')">
                @csrf
                <input type="text" name="id_pengaduan" key="id_pengaduan" value="{{$pengaduanInstance->id_pengaduan}}" hidden >
                <x-form.selectinputform  title="Status" key="status" :options="$status" placeholder="Pilih Status Pengaduan" selected="{{$pengaduanInstance->getStatus()}}" />
                    <div class="heading">
                        <p class="mt-3 text-xs text-wrap max-w-60 text-gray-950 dark:text-gray-500">Note: Pastikan pengaduan sudah benar benar tervalidasi sebelum merubah status pengaduan</p>
                    </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-500 rounded-md dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700 hover:bg-blue-600 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50" >
                        Save Pengaduan
                    </button>
                </div>
            </form>
        </div>
    </aside>
</section>
@endsection
@push('scripts')
<script>
    function request(url, selectorParent, selectorForm) {
        $(selectorParent).ready((e) => {
            $(selectorForm).on('submit', function(e) {
                e.preventDefault()
                $.ajax({
                    url: url,
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        $.ajax({
                            url: document.location,
                            type: "GET",
                            success: function(response) {
                                let parser = new DOMParser();
                                let doc = parser.parseFromString(response,
                                    'text/html');
                                $('body').html(doc.body.innerHTML)
                                setTimeout(function() {
                                    $(".flash-message").remove()
                                }, 5000)
                            }
                        })


                    },
                    error: function(res) {
                        $.each(res.responseJSON.errors, (key, value) => {
                            value.forEach(element => {
                                $(e.currentTarget).find('#' + key).siblings(
                                    '#error').append(
                                    `<li>${element}</li>`)
                            });

                            setTimeout(element => {
                                $(e.currentTarget).find('#' + key).siblings(
                                    '#error').fadeOut("slow", () => {
                                    $(e.currentTarget).find('#' +
                                            key).siblings('#error')
                                        .empty()
                                })
                            }, 8000)
                        })

                    }
                })


            })
        })
    }
</script>
@endpush
