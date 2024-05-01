@php
$image = Vite::asset('resources/assets/images/crowdedCity.jpg');
@endphp


<div class="card-container px-3 py-4 ">
    <div class="card-wrap rounded-xl overflow-hidden border dark:border-gray-700">
        <div class="card-img bg-cover bg-center w-full h-[275px]" style="background-image: url({{$image}});">
            <div class="w-full h-full dark:backdrop-brightness-75 backdrop-brightness-50"></div>
        </div>
        <div class="card-body mx-6 my-5 flex flex-col gap-2">
            <h5 class="text-xs dark:text-gray-600">2 hari yang lalu</h5>
            <h2 class="text-lg font-medium leading-6">Senam Rutin Bulanan Diundur Karena Cuaca Buruk</h2>
            <p class="dark:text-gray-500">Dikarenakan cuaca di Malang yang akhir-akhir ini tidak menentu, secara terpaksa senam rutin bulanan yang awalnya akan dilaksanakan pada</p>
            <div class="action-button">
                <button class="flex items-center justify-center dark:fill-slate-400">
                    <span class="py-2 text-xs dark:text-gray-400">Selengkapnya</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 pt-1 fill-inherit">
                        <path d="M18 12a2 2 0 0 0-.59-1.4l-4.29-4.3a1 1 0 0 0-1.41 0 1 1 0 0 0 0 1.42L15 11H5a1 1 0 0 0 0 2h10l-3.29 3.29a1 1 0 0 0 1.41 1.42l4.29-4.3A2 2 0 0 0 18 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>