{{-- extend to layouts/app --}}
@extends(request()->user()->getSidebarView())

{{-- content --}}
@php
$status = \App\Models\PengaduanModel::getStatusOption();

@endphp
@section('content')
    <section class="container px-6 md:px-12 mt-7 mx-auto relative " x-data="{ modalOpen: false }">
        <div class="mb-8 flex flex-col sm:flex sm:justify-between gap-x-3">
            <h2 class=" text-2xl font-medium text-gray-800 dark:text-white">{{ $pengaduanInstance->judul }}</h2>
        </div>

        <div class="flex flex-col">
                <div class="profile flex ">
                    <div class="col mr-3">
                        <img src="{{ $pengaduanInstance->user->image_url }}" alt="Profile" class="w-24 h-24 rounded-full">
                    </div>
                    <div class="col flex flex-col justify-center">
                        <h2 class="text-lg font-medium text-gray-800 dark:text-white">
                            {{ $pengaduanInstance->getNamaPengadu() }}</h2>
                        <p class=" text-sm text-gray-500 dark:text-gray-300 mb-2">{{ $pengaduanInstance->getNikPengadu() }}</p>
                        <p class="mt-2 text-sm text-blue-600 dark:text-blue-600">Dibuat Pada :
                            {{ $pengaduanInstance->getDibuatPada() }}</p>
                    </div>
                </div>
        </div>                    


        <div class="content mt-8">
            <h2 class="text-lg font-medium text-gray-800 dark:text-white">Deskripsi:</h2>
            <p class="mt-1 text-md text-gray-700 dark:text-gray-300">{{ $pengaduanInstance->getIsi() }}</p>
        </div>

        <div class="px-4 sm:block sm:p-0 mt-5">
                <h2 class="text-lg font-medium text-gray-800 dark:text-white">Lampiran:</h2>
            <div>
                <img src="{{ $pengaduanInstance->image_url }}" class="w-110 h-96">
            </div>
        </div>

        <div class="flex mt-6 mb-6">
            <h2 class="text-lg font-medium text-gray-800 dark:text-white">Status Terkini :</h2>
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
    </section>
@endsection
